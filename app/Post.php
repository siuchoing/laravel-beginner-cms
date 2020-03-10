<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    // Defining a specific table name for CRUD actions
    protected $table = 'posts';

    protected $dates = ['deleted_at'];

    // For create
    protected $fillable = [
        'title',
        'content'
    ];
}
