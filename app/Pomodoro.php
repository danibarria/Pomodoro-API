<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pomodoro extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'seconds'
    ];
    /** The relationships that should always be loaded.  */
    protected $with = ['user', 'tags'];

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
