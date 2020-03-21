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

    # Retrieving Intermediate Table Columns
    /**
     * The roles that belong to the user.
     */
    public function roles() {
        return $this->belongsToMany('App\Role')->withPivot('created_at');

        // To customize tables name and columns follow the format below
        // ### Remark: belongsToMany($model, $table, $foriegnPivotKey, $relatedPivotKey);
        // return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }

    # Polymorphic relation [Many To Many]
    // One post can share many photos
    /**
     * Get all of the user's photos
     */
    public function photos() {
        return $this->morphMany('App\Photo', 'imageable');
    }

    # Accessor can get DB column value, and manipulate data by using get the name of the DB column
    /**
     * Get the user's name.
     */
    public function getNameAttribute($value){
        return ucfirst($value); //第一個字大寫
    }

    /**
     * Get the user's email.
     */
    public function getEmailAttribute($value){
        return strtoupper($value); //全部變成大寫
    }

    # Mutator can receive and manipulate attribute value on the Eloquent model's internal $attributes property
    /**
     * Set the user's first name.
     */
    public function setNameAttribute($value){
        $this->attributes['name'] = strtoupper($value);
    }
}
