<?php

namespace App\Contracts;

interface CommentableLink
{
    public function getCommentLink(): string;
}