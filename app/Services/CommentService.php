<?php

namespace App\Services;

use App\Events\Dashboard\AdminActions;
use App\Models\CommentReplies;
use App\Models\Comments;
use App\Services\Contracts\CommentServiceInterface;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;
use Str;
use Yajra\DataTables\DataTables;

class CommentService implements CommentServiceInterface{
    
    public function getDatatable(){
        $comments = Comments::query()
        ->select('comments.id as id', 
        'comments.text as text', 
        'comments.verified as verified', 
        'comments.commentable_type as commentable_type', 
        'comments.commentable_id as commentable_id', 
        'comments.user_id as user_id', 
        'comments.created_at as created_at', 
        DB::raw("'comment' as type"));
        $replies = CommentReplies::query()->
        select('comment_replies.id as id', 
        'comment_replies.text as text', 
        'comment_replies.verified as verified', 
        'comment_replies.comment_id as commentable_id', 
        'comment_replies.updated_at as commentable_type',
        'comment_replies.user_id as user_id', 
        'comment_replies.created_at as created_at', 
        DB::raw("'reply' as type"),
        );
        $combinedQuery = $comments->unionAll($replies);
        return DataTables::of($combinedQuery->orderByDesc('created_at'))
            ->editColumn('text', function ($comments){
                return Str::limit($comments->text,50);
            })
            ->editColumn('created_at', function ($comments){
                return Jalalian::forge($comments->created_at)->format('%A, %d %B %Y | H:i:s');
            })
            ->editColumn('verified', function ($comments){
                if ($comments->verified == 1){
                    return '<span class="badge bg-label-success">منتشر شده</span>';
                } else {
                    return '<span class="badge bg-label-danger">در انتظار تایید</span>';
                }
            })
            ->editColumn('user_id', function ($comments){
                if ($comments->user_id != null){
                    return "<a href='". route('dashboard.users.edit', ['user' => $comments->user->id]) ."'>". $comments->user->name . " " . $comments->user->family ."</a>";
                } else {
                    return $comments->name;
                }
            })
            ->addColumn('link', function ($comments){
                if ($comments->commentable_type == 'App\Models\Articles'){
                    return "<a href='". route('blog.article', ['slug' => $comments->commentable->slug]) ."'>" . Str::limit($comments->commentable->title, 50) . "</a>";
                } elseif($comments->commentable_type == 'App\Models\Movies') {
                    return "<a href='". route('index.movie', ['slug' => $comments->commentable->slug]) ."'>" . Str::limit($comments->commentable->title[0], 50) . "</a>";
                } else {
                    return "پاسخ به نظر";
                }
            })
            ->addColumn('actions', function ($comments){
                $actions =  '<a href="'. route('dashboard.comments.destroy', ['comment' => $comments->id]) .'">
                                <button type="button" class="btn btn-icon btn-danger">
                                <span class="tf-icons bx bx-trash-alt"></span>
                                </button>
                            </a>';
                if ($comments->type == "comment"){
                    $actions =  
                            '<a href="'. route('dashboard.comments.show', ['comment' => $comments->id ]) .'">
                                <button type="button" class="btn btn-icon btn-warning">
                                <span class="tf-icons bx bx-glasses"></span>
                                </button>
                            </a>'.$actions;
                } else {
                    $actions =  '<a href="'. route('dashboard.comments.destroy', ['comment' => $comments->id, 'reply' => $comments->id]) .'">
                                <button type="button" class="btn btn-icon btn-danger">
                                <span class="tf-icons bx bx-trash-alt"></span>
                                </button>
                            </a>';
                }
                if ($comments->verified == 0){
                    if ($comments->type == "reply"){
                        $actions = '<a href="'. route('dashboard.comments.verify', ['comment' => $comments->id, 'reply' => $comments->id]) .'">
                                <button type="button" class="btn btn-icon btn-success">
                                <span class="tf-icons bx bx-check"></span>
                                </button>
                            </a>' . $actions;
                    } else {
                        $actions = '<a href="'. route('dashboard.comments.verify', ['comment' => $comments->id]) .'">
                                <button type="button" class="btn btn-icon btn-success">
                                <span class="tf-icons bx bx-check"></span>
                                </button>
                            </a>' . $actions;
                    }
                }
                return $actions;
            })
            ->rawColumns(['user_id', 'link', 'actions', 'verified'])
            ->make(true);
    }

    public function delete(Comments $comment){
        return DB::transaction( function () use ($comment){
            $deleteComment = $comment->delete();
            event(new AdminActions(['causer' => auth()->user(), 'model' => $comment], 'delete', 'comment'));
            return $deleteComment;
        });
    }

    public function deleteReply($comment, $reply){
        $reply = CommentReplies::where('id', $reply)->firstOrFail();
        return DB::transaction( function () use ($comment, $reply){
            $deleteReply = $reply->delete();
            event(new AdminActions(['causer' => auth()->user(), 'model' => $comment], 'delete', 'comment'));
            return $deleteReply;
        });
    }

    public function verifyReply($replyId){
        $replyModel = CommentReplies::where('id', $replyId)->firstOrFail();
        event(new AdminActions(['causer' => auth()->user(), 'model' => $replyModel], 'update', 'comment'));
        return $replyModel->update(['verified' => 1]);
    }

    public function verify(Comments $comment){
        $verifyComment = $comment->update(['verified' => 1]);
        event(new AdminActions(['causer' => auth()->user(), 'model' => $comment], 'update', 'comment'));
        return $verifyComment;
    }
}