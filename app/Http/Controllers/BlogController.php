<?php

namespace App\Http\Controllers;

use App\Events\UserComment;
use App\Models\Articles;
use App\Models\CommentReplies;
use App\Models\Comments;
use App\Models\Movies;
use App\Models\Users;
use Auth;
use Illuminate\Http\Request;
use App\Models\Genres;
use App\Models\MovieList;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(){
        $topViews = Articles::select('id', 'title', 'slug', 'thumbnail', 'views')->orderByDesc('views')->limit(4)->get();
        $articles = Articles::select('id', 'title', 'slug', 'thumbnail', 'updated_at', 'small_text')->orderByDesc('updated_at')->paginate(18);
        $tags = Articles::select('id', 'tags')->inRandomOrder()->limit(5)->get();
        $tagSelected = [];
        foreach($tags as $tag){
            foreach($tag->tags as $key => $value){
                $tagSelected[] = $value;
            }
        }
        return view("blog", compact('articles', 'topViews', 'tagSelected'));
    }

    public function article($slug){
        $article = Articles::where('slug', $slug)->firstOrFail();
        if (Auth::check()){
            $comments = $article->comments()->with(['replies' => function ($query){
                $query->orderByDesc('updated_at')->where('verified', 1);
            }])->where('verified', 1)->withCount([
                        'reactions as likes_count' => function ($query) {
                            $query->where('reaction', 1);
                        },
                        'reactions as dislikes_count' => function ($query) {
                            $query->where('reaction', -1);
                        }
                    ])
                    ->addSelect([
                        'user_reaction' => DB::table('comment_reactions')
                            ->select('reaction')
                            ->whereColumn('comment_id', 'comments.id')
                            ->where('user_id', auth()->user()->id)
                            ->limit(1)
                    ])->paginate(20);
        } else {
            $comments = $article->comments()->with(['replies' => function ($query){
                $query->orderByDesc('updated_at')->where('verified', 1);
            }])->where('verified', 1)->withCount([
                        'reactions as likes_count' => function ($query) {
                            $query->where('reaction', 1);
                        },
                        'reactions as dislikes_count' => function ($query) {
                            $query->where('reaction', -1);
                        }
                    ])->paginate(20);
        }
        $ip = request()->ip();
        $key = "article_{$article->id}_viewed_{$ip}";
        $relatedArticles = Articles::where('id', '!=', $article->id)
            ->whereJsonContains('tags', $article->tags)
            ->limit(5)
            ->get();
        if (!Cache::has($key)) {
            $article->increment('views');
            Cache::forever($key, true);
        }
        return view('article', compact('article', 'relatedArticles', 'comments'));
    }

    public function sendComment(Request $request, $type, $id){
        $validate = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'text' => ['required', 'string']
        ]);
        if ($request->comment_id == 0){
            $commentData = $request->only('name', 'text', 'email');
            $model = match ($type) {
                'article' => Articles::class,
                'movie' => Movies::class,
                default => abort(404)
            };
            $commentable = $model::findOrFail($id);
            $commentData['user_id'] = auth()->user()->id;
            $commentable->comments()->create($commentData);
            if ($commentable){
                event(new UserComment(auth()->user(), $commentable->title, $type, $commentable));
                return redirect()->back()->with("success", "نظر شما با موفقیت ثبت شد");
            } else {
                return redirect()->back()->with("failed", "متاسفانه خطایی در ثبت نظر به وجود آمد");
            }
        } else {
            $commentData = $request->only('name', 'text', 'email', 'comment_id');
            $comment = Comments::where('id', $commentData['comment_id'])->with('commentable')->first();
            if ($comment->commentable instanceof Movies){
                $title = $comment->commentable->title[1];
            } else {
                $title = $comment->commentable->title;
            }
            $commentData['user_id'] = auth()->user()->id;
            $createComment = CommentReplies::create($commentData);
            if ($createComment){
                event(new UserComment(auth()->user(), $title, "reply", $createComment));
                return redirect()->back()->with("success", "پاسخ شما با موفقیت ثبت شد");
            } else {
                return redirect()->back()->with("failed", "متاسفانه خطایی در ثبت پاسخ به وجود آمد");
            }
        }
    }

    public function tag($tag){
        $articles = Articles::select('id', 'title', 'slug', 'thumbnail', 'updated_at', 'created_at','small_text')->orderByDesc('created_at')->whereJsonContains('tags', $tag)
        ->paginate(12);
        return view('tag', compact('articles'));
    }

    public function search(Request $request){
        $articles = Articles::select('id', 'title', 'slug', 'thumbnail', 'updated_at', 'created_at','small_text')->where('title', 'LIKE', '%' . $request->search . '%')->orderByDesc('created_at')->paginate(12);
        return view('tag', compact('articles'));
    }

    public function author(Users $user){
        $articles = Articles::select('id', 'title', 'slug', 'thumbnail', 'updated_at', 'created_at', 'small_text', 'author_id')->where('author_id', $user->id)->orderByDesc('created_at')->paginate(12);
        return view('tag', compact('articles'));
    }
}
