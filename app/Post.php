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

    // One post is posted by one user
    public function user() {
        return $this->belongsTo('App\User');
    }

    # Polymorphic relation [Many To Many]
    // One post can share many photos
    /**
     * Get all of the post's photos.
     */
    public function photos() {
        return $this->morphMany('App\Photo', 'imageable');
    }

    // One post can mark down to many tags
    /**
     * Get all of the tags for the post.
     */
    public function tags() {
        return $this->morphToMany('App\Tag', 'taggable');
    }

}
