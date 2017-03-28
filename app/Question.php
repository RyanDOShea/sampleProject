<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    protected $fillable = [
        'title', 'body',
    ];

    public function answers(){
        return $this->hasMany('App\Answer');
    }


    //below here are various different ways to get the data, that was solved with eager loading

//    public function getChartFormattedResults($user_id = 0){
//        $answer_ids = $this->answers()->pluck('id');
//        dd($answer_ids);
//    }
//
//    public function scopejoinTest($query ,$exercise_id = 1){
//        $data = $query->where('exercise_id', $exercise_id)
//            ->join('answers', 'questions.id', '=', 'answers.question_id')
//            ->join('responses', 'answers.id', '=' , 'responses.answer_id')
//            ->select( 'questions.id as question_id', 'questions.body as question',
//                'responses.answer_id', 'answers.body' , DB::raw('COUNT(responses.answer_id) as total'))
//            ->groupBy('responses.answer_id')->get();
//
//
//        $question_ids = $data->pluck('question_id')->unique();
//
//        foreach($question_ids as $id){
//            //for each question id put it's answers in a separated array, and group by answer_id
//            $question_data["$id"] = $data->where('question_id', $id);
//        }
//        dd($question_data);
//    }

//    public function scopeQuestionChartData($query){
//
//        $question_text = $query->first()->body;
//
//        $query->first()->load(['answers' => function ($q) use ( &$answers ) {
//            $answers = $q->get()->unique();
//        }]);
//
//        $answer_text = $answers->pluck('body', 'id');
//
//        $answers->load(['responses' => function ($q) use ( &$responses ) {
//            $responses = $q->get()->unique();
//        }]);
//
//        $grouped_responses = $responses->groupBy('answer_id');
//
//        $response_count = [];
//        foreach($grouped_responses as $answer_id => $response){
//            $response_count["$answer_id"] = $response->count();
//        }
//
//        //package data up to be return as single object
//        $data['question_text'] = $question_text;
//        $data['answer_text'] = $answer_text;
//        $data['response_count'] = $response_count;
//
//        return $data;
//
//
//    }
}
