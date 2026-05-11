<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentReactions extends Model
{
    protected $guarded = ['id'];

    public $table = 'comment_reactions';
}
