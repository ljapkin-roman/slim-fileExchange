<?php

namespace Summit\classes;
use Illuminate\Database\Eloquent\Model as Eloquent;
class Comment extends Eloquent
{
    protected $fillable = [
        'text'
    ];

}