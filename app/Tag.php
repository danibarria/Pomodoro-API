<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
    protected $with = ['user'];

    /**
     * Get the User that owns the tag
     */
    public function user(){
        return $this->belongsToMany('App\User', 'user_tag');
    }

    /**
     * The pomodoros where the tag is present
     */
    public function pomodoros() {
        return $this->belongsToMany('App\Pomodoro');
    }
}
