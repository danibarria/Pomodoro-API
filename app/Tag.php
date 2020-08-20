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
        'name'
    ];

    /**
     * The pomodoros where the tag is present
     */
    public function pomodoros() {
        return $this->belongsToMany('App\Pomodoro');
    }
}
