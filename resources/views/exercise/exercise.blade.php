@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if (count($questions) > 0)
                    <form action="{{url('/exerciseSubmit')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="quiz_id" value="1"><!-- hard coded for testing -->
                    @foreach($questions as $question)
                        <div class="panel panel-default">
                            <div class="panel-heading">{{$question->body}}</div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-md-1 control-label" for="radios"></label>
                                        <div class="col-md-4">
                            @foreach($question->answers as $index => $answer)

                                                <div class="radio">
                                                    <label for="radios-{{$index}}">
                                                        <input type="radio" name="question-{{$question->id}}"
                                                               id="radios-{{$index}}" value="{{$answer->id}}" required>
                                                        {{$answer->body}}
                                                    </label>
                                                </div>

                            @endforeach
                                        </div>
                                    </div>
                                </div>
                        </div>
                    @endforeach
                        <button type="submit" class="btn btn-default">
                            <i class="fa"></i> Submit
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

