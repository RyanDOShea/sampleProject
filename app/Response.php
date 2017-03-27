<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
        'answer_id', 'user_id',
    ];

    public function answer(){
        return $this->belongsTo('App\Answer');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
