<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'title'
    ];

    protected $with = [
        'questions'
    ];

    public function questions(){
        return $this->hasMany('App\Question');
    }
}
