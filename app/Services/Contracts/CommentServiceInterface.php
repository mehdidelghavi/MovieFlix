<?php

namespace App\Services\Contracts;

use App\Models\Comments;

interface CommentServiceInterface{
    public function getDatatable();

    public function delete(Comments $comment);

    public function verifyReply($replyId);

    public function deleteReply($comment, $reply);

    public function verify(Comments $comment);
}