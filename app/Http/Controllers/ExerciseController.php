<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Question;
use App\Response;
use Illuminate\Support\Facades\Auth;
use ConsoleTVs\Charts\Charts;


class ExerciseController extends Controller
{

    public function exercise($exercise_id)
    {

        $questions = Question::with('answers')->where('exercise_id', $exercise_id)->get();

        //did this person already take this exercise?
//        $already_taken = $questions->first()
//            ->answers()->first()
//            ->responses()->where('user_id', Auth::user()->id);
//
//        if($already_taken){
//            //normally we do not want people to retake exercises, but for debug this is fine
//        }

        return view('exercise.exercise', [
            'questions' => $questions,
        ]);
    }

    public function submit(Request $request){

        $user = Auth::user();

        if(!isset($user)){
            $user_id = 1;
        }
        else{
            $user_id = $user->id;
        }

        //get all the user's answers, then loop through them, and create entries for each
        foreach($request->except(['_token', 'quiz_id']) as $question_answer => $value){
            $response = Response::create(['user_id' => $user_id , 'answer_id' => $value]);
        }

        if(isset($response)){
            return redirect('/results');
        }
        else{
            return Redirect::back()->withErrors(['msg', 'Your exercise did not get saved, please try again.']);
        }


    }

    public function test(){

        $user_id = 0;

        $questions = Question::with( ['answers.responses' => function($query) use($user_id){
            if($user_id != 0){$query->where('user_id', '=', $user_id);}
        }])->where('exercise_id', 1)
            ->get();

        dd($questions);
    }

    public function results($exercise_id = 1, $user_id = 0){

        //rather than using route paramaters I should instead made it a get request so I
        // can have either $user_id without having exercise id as well

        $questions = Question::with( ['answers.responses' => function($query) use($user_id){
            if($user_id != 0){$query->where('user_id', '=', $user_id);}
        }])->where('exercise_id', $exercise_id)->get();

        $question_chart = collect();

        foreach($questions as $question){
            $question_text = $question->body;

            $answer_text = collect();
            $response_count = collect();
            foreach($question->answers as $answer){
                $answer_text->push($answer->body);
                $response_count->push($answer->responses->count());
            }

            $question_chart->push(Charts::create('bar', 'highcharts')
                ->setTitle($question_text)
                ->setLabels($answer_text)
                ->setValues($response_count)
                ->setElementLabel("Answers Chosen")
                ->setDimensions(1000,500)
                ->setResponsive(false));

        }

        return view('exercise.results', ['charts' => $question_chart]);
    }
}
