<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Question;
use App\Response;
use Illuminate\Support\Facades\Auth;


class ExerciseController extends Controller
{

    public function exercise($exercise_id)
    {

        //dd(Auth::user()->responses()->answer()->question());

        $questions = Question::with('answers')->where('exercise_id', $exercise_id)->get();

        $already_taken = $questions->first()->answers()->first()->responses()->where('user_id', Auth::user()->id);

        if($already_taken){
            dd('dog god');
        }

        return view('exercise.exercise', [
            'questions' => $questions,
        ]);
    }

    public function submit(Request $request){

        $user_id = Auth::user()->id;

        foreach($request->except(['_token', 'quiz_id']) as $question_answer => $value){
            $response = Response::create(['user_id' => $user_id , 'answer_id' => $value]);
        }

        return redirect('/results');

    }
}
