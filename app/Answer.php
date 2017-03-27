<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'question_id', 'body',
    ];

    public function question(){
        return $this->belongsTo('App\Question');
    }

    public function responses(){
        return $this->hasMany('App\Response');
    }
}
