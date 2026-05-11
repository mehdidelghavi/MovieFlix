<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Articles;
use App\Models\Comments;
use App\Services\Contracts\CommentServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class CommentsController extends Controller
{

    public function __construct(private CommentServiceInterface $commentService){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            return $this->commentService->getDatatable();
        }
        return view("Dashboard.Comments.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Comments $comment)
    {
        return view('Dashboard.Comments.show', compact('comment'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($comment, $reply)
    {
        if ($reply != null){
            $deleteComment = $this->commentService->deleteReply($comment, $reply);
        } else {
            $comment = Comments::where('id', $comment)->firstOrFail();
            $deleteComment = $this->commentService->delete($comment);
        }
        if ($deleteComment){
            return redirect()->route('dashboard.comments')->with('success', 'نظر با موفقیت حذف شد');
        } else {
            return redirect()->route('dashboard.comments')->with('failed', 'متاسفانه خطایی در حذف نظر به رخ داد');
        }
    }

    public function verify($comment, $reply = null){
        if ($reply != null){
            $verifyComment = $this->commentService->verifyReply($reply);
        } else {
            $comment = Comments::where('id', $comment)->firstOrFail();
            $verifyComment = $this->commentService->verify($comment);
        }
        if ($verifyComment){
            return redirect()->route('dashboard.comments')->with('success', 'نظر با موفقیت تایید و منتشر شد');
        } else {
            return redirect()->route('dashboard.comments')->with('failed', 'متاسفانه خطایی در تایید نظر رخ داد');
        }
    }
}
