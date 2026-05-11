<?php

namespace App\Services;

use App\Events\Dashboard\AdminActions;
use App\Events\Dashboard\CreateArticle;
use App\Models\Articles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Services\Contracts\FileServiceInterface;
use App\Services\Contracts\ArticleServiceInterface;

class ArticleService implements ArticleServiceInterface{
    public function __construct(private FileServiceInterface $fileService){}

    public function getDatatable(){
        $articles = Articles::orderByDesc("updated_at")->with('author')->withCount('comments');
        return DataTables::of($articles)
            ->editColumn("thumbnail", function ($articles){
                return "<img src='". asset('storage/articles/' . $articles->thumbnail) ."' width='80' height='80' style='border-radius: 15px;'>";
            })
            ->editColumn("author_id", function ($articles){
                return $articles->author->name . " " . $articles->author->family;
            })
            ->addColumn("comments", function ($articles){
                return $articles->comments_count;
            })
            ->addColumn("actions", function ($articles){
                return '<a href="' . route('dashboard.articles.destroy' , ['article' => $articles->id]) .'">
                            <button type="button" class="btn btn-icon btn-danger">
                            <span class="tf-icons bx bx-trash-alt"></span>
                            </button>
                        </a>
                        <a href="' . route('dashboard.articles.edit' , ['article' => $articles->id]) .'">
                            <button type="button" class="btn btn-icon btn-primary">
                            <span class="tf-icons bx bx-edit-alt"></span>
                            </button>
                        </a>';
            })
            ->rawColumns(['actions','thumbnail'])
            ->make(true);
    }

    public function store(array $data){
        $tags = $data["tags"];
        $tags = json_decode($tags,true);
        $tags = array_column($tags,"value");
        $tags = json_encode($tags, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $data['tags'] = $tags;
        $data['small_text'] = Str::limit(strip_tags($data['text']), 150);
        $data['author_id'] = auth()->user()->id;
        $data['views'] = 0;
        return DB::transaction( function () use ($data){
            if (isset($data['thumbnail'])){
                $data['thumbnail'] = $this->fileService->upload($data['thumbnail'], 'articles');
            }
            event(new CreateArticle(['title' => $data['title'], 'content' => $data['small_text'], 'link' => route('blog.article', ['slug' => $data['slug']])]));
            $createArticle = Articles::create($data);
            event(new AdminActions(['causer' => auth()->user(), 'model' => $createArticle], 'create', 'article'));
            return $createArticle;
        });
    }

    public function update(array $data, Articles $article){
        $tags = $data['tags'];
        $tags = json_decode($tags,true);
        $tags = array_column($tags,"value");
        $data['tags'] = $tags;
        $smallText = html_entity_decode($data['text'], ENT_QUOTES | ENT_HTML5,'UTF-8');
        $smallText = strip_tags($smallText);
        $smallText = preg_replace('/[\x{200C}]/u', '', $smallText);
        $data['small_text'] = Str::limit($smallText, 150,false);
        return DB::transaction(function () use ($data, $article){
            if (isset($data['thumbnail'])){
                $this->fileService->delete('articles', $article->thumbnail);
                $data['thumbnail'] = $this->fileService->upload($data['thumbnail'], 'articles');
            }
            $updateArticle = $article->update($data);
            event(new AdminActions(['causer' => auth()->user(), 'model' => $article], 'update', 'article'));
            return $updateArticle;
        });
    }

    public function delete(Articles $article){
        return DB::transaction( function () use ($article){
            $this->fileService->delete('articles', $article->thumbnail);
            $deleteArticle = $article->delete();
            event(new AdminActions(['causer' => auth()->user(), 'model' => $article], 'delete', 'article'));
            return $deleteArticle;
        });
    }

    public function multiDelete(array $ids){
        return DB::transaction(function () use ($ids) {

            $articles = Articles::whereIn('id', $ids)->get();

            foreach ($articles as $article) {
                $this->fileService->delete('articles', $article->thumbnail);
                event(new AdminActions(['causer' => auth()->user(), 'model' => $article], 'delete', 'article'));
            }

            return Articles::whereIn('id', $ids)->delete();
        });
    }
}