<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * Get all of the posts that are assigned this tag.
     */
    public function posts() {
        return $this->morphedByMany('App\Post', 'taggable');
    }
}
