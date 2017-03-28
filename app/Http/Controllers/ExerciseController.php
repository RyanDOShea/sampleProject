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
        $already_taken = $questions->first()->answers()->first()->responses()->where('user_id', Auth::user()->id);

        if($already_taken){
            //normally we do not want people to retake exercises, but for debug this is fine
        }

        return view('exercise.exercise', [
            'questions' => $questions,
        ]);
    }

    public function submit(Request $request){

        $user_id = Auth::user()->id;

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

    public function results($exercise_id = 1){

        //TODO move this logic to model, and refactor with a groupby for better performance
        // From each question where exercise_id is such, get question text, answer text, and a list of the responses
        $data = Question::where('exercise_id', $exercise_id)
            ->join('answers', 'questions.id', '=', 'answers.question_id')
            ->join('responses', 'answers.id', '=' , 'responses.answer_id')
            ->select( 'questions.id as question_id', 'questions.body as question',
                'responses.answer_id', 'answers.body')->get();

        //get the question ids so we can use them like keys, and loop through them
        $question_ids = $data->pluck('question_id')->unique();

        foreach($question_ids as $id){
            //for each question id put it's answers in a separated array, and group by answer_id
            $question_data["$id"] = $data->where('question_id', $id)->groupBy('answer_id');
        }

        //init this as a collection so we have access to collections functions
        $question_chart = collect();

        //loop through each question
        //right now the data looks like such
        // question_id[id] = [
        //  answer_id => [original data pull, original data pull]
        //  ]
        // so we have to go two levels deep to pull up that data, and we count and collect the data
        // for our chart system
        foreach($question_data as $question_id => $collection_of_answers){
            $answer_count = collect();
            $answer_label = collect();
            $question = "";

            foreach($collection_of_answers as $answer_id => $answer){
                $answer_count->push($answer->count());
                $answer_label->push($answer->first()->body);
                $question = $answer->first()->question;
            }

            $question_chart->push(Charts::create('bar', 'highcharts')
                ->setTitle($question)
                ->setLabels($answer_label)
                ->setValues($answer_count)
                ->setElementLabel("Answers Chosen")
                ->setDimensions(1000,500)
                ->setResponsive(false));
        }

        return view('exercise.results', ['charts' => $question_chart]);
    }
}
