<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // One user can post one each time
    public function post() {
        return $this->hasOne('App\Post');       // By default, hasOne('App\Post', 'user_id');
    }

    // One user can post many posts
    public function posts() {
        return $this->hasMany('App\Post');
    }

    // One user is authorized by many roles
    public function roles() {
        return $this->belongsToMany('App\Role')->withPivot('created_at');

        // To customize tables name and columns follow the format below
        // ### Remark: belongsToMany($model, $table, $foriegnPivotKey, $relatedPivotKey);
        // return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }

    # Polymorphic relation [Many To Many]
    // One post can share many photos
    public function photos() {
        return $this->morphMany('App\Photo', 'imageable');
    }
}
