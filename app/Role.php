<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    // Defining Custom Intermediate Table Models
    /**
     * The users that belong to the role.
     */
    public function users() {
        return $this->belongsToMany('App\User');       // By default, hasOne('App\Post', 'user_id');
    }
}
