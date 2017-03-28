@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    @foreach($charts as $chart)
                    {!! $chart->render()  !!}
                        <hr />
                        <br />
                        <br />


                        @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
