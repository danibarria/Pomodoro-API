<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /** The attributes that are mass assignable. */
    protected $fillable = [
        'name', 'email', 'password', 'profile_hash'
    ];

    /** The attributes excluded from the model's JSON form. */
    protected $hidden = [
        'password',
    ];

    /** Get the pomodoros from the User */
    public function pomodoros() {
        return $this->hasMany('App\Pomodoro');
    }

    /** Get the tags from the User */
    public function tags() {
        return $this->belongsToMany('App\Tag', 'user_tag');
    }
}
