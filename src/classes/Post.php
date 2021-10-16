<?php

namespace Summit\classes;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Summit\classes\Comment;
class Post extends Eloquent
{
    protected $fillable = [
        'text'
    ];
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}