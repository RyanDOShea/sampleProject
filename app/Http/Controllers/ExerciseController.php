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

    public function results($exercise_id){

        $data = Question::where('exercise_id', $exercise_id)
            ->join('answers', 'questions.id', '=', 'answers.question_id')
            ->join('responses', 'answers.id', '=' , 'responses.answer_id')
            ->select( 'questions.id as question_id', 'questions.body as question', 'responses.answer_id', 'answers.body')->get();

        $question_ids = $data->pluck('question_id')->unique();
        //dd($question_ids);

        //dd($data->where('question_id', "1")->pluck('answer_id'));

        foreach($question_ids as $id){
            $chart_data["$id"] = $data->where('question_id', $id)->groupBy('answer_id');
        }

        //dd($chart_data);

        $chart = Charts::create('line', 'highcharts')
            //->setView('custom.line.chart.view') // Use this if you want to use your own template
            ->setTitle('My nice chart')
            ->setLabels(['First', 'Second', 'Third'])
            ->setValues([5,10,20])
            ->setDimensions(1000,500)
            ->setResponsive(false);

//        $user_chart = Charts::database( $chart_data["$question_ids[0]"],'bar', 'highcharts')
//            ->setElementLabel("Answers Chosen")
//            ->setDimensions(1000, 500)
//            ->setResponsive(false)
//            ->groupBy('question_id');

//        $user_chart = Charts::multi('bar', 'highcharts')
//            ->setResponsive(false)
//            ->setDimensions(0, 500)
//            ->setColors(['#ff0000', '#00ff00', '#0000ff'])
//            ->setLabels(['Mood Question', 'How was your day?', 'How will your day be?'])
//            //->setDataset('Test 1', [1,2,3])
//            //->setDataset('Test 2', [0,6,0])
//            ->setDataset('Mood Question', [3,4,1]);

        $user_chart = collect();

        foreach($chart_data as $question_id => $collection_of_answers){
            $answer_count = collect();
            $answer_label = collect();
            $question = "";

            foreach($collection_of_answers as $answer_id => $answer){
                $answer_count->push($answer->count());
                $answer_label->push($answer->first()->body);
                $question = $answer->first()->question;
            }

            $user_chart->push(Charts::create('bar', 'highcharts')
                ->setTitle($question)
                ->setLabels($answer_label)
                ->setValues($answer_count)
                ->setElementLabel("Answers Chosen")
                ->setDimensions(1000,500)
                ->setResponsive(false));
        }



        return view('exercise.results', ['charts' => $user_chart]);
    }
}
