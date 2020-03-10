<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // For create
    protected $fillable = [
        'title',
        'content'
    ];
}
