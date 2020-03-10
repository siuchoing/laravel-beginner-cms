<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    // Defining a specific table name for CRUD actions
    protected $table = 'posts';

    // Defining Primary Keys for CRUD actions
    //protected $primaryKey = 'post_id';

    protected $dates = ['deleted_at'];

    // For create
    protected $fillable = [
        'title',
        'content'
    ];
}
