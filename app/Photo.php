<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $uploads = '/images/';

    protected $fillable = [
        'path',
    ];

    # Polymorphic relation [Many To Many]
    // One photos can be shared to many post
    /**
     * Get all of the owning imageable models.
     */
    public function imageable() {
        return $this->morphTo();            // MorphTo 欄位，可自動顯示可用資源的 [標題屬性]（＃title-attributes）
    }

    // Method 2: Passing photo path to DOM
    public function getPathAttribute($photo){
        return $this->uploads . $photo;
    }
}
