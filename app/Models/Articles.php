<?php

namespace App\Models;

use App\Contracts\CommentableLink;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
class Articles extends Model implements CommentableLink
{
    protected $guarded = ['id'];

    protected $casts = [
        'tags' => 'array',
    ];

    public function getCommentLink($limit = 20): string
    {
        return "<a href='". route('blog.article', ['slug' => $this->slug]) ."'>
                    ". Str::limit($this->title, $limit) ."
                </a>";
    }

    protected function tags(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }
    public function author(){
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comments::class, 'commentable');
    }
}
