<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Defining Custom Intermediate Table Models
    public function users() {
        return $this->belongsToMany('App\User');       // By default, hasOne('App\Post', 'user_id');
    }
}
