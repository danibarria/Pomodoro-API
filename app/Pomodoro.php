<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'seconds', 'date',
    ];

    /**
     * Get the User that owns the pomodoro
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * The tags on the pomodoro
     */
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
