@extends('main')
@section('title',"| $post->title ")

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <img src="{{asset('images/'.$post->image)}}" height="400" width="800" alt="">
            <h1>{{$post->title}}</h1>
            <p>{{$post->body}}</p>
            <hr>
            <p>Posted In: {{$post->category->name}}</p> 

        </div>
    </div>

    {{-- <div class="row">
        <div id="comment-form" class="col-md-8 col-md-offset-2" style="margin-top:50px;">
            {{ Form::open(['url'=>['comments/'.$post->id]]) }}
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::label('name',"Name") }}
                        {{ Form::text('name',null,['class'=>'form-control']) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('email','Email') }}
                        {{ Form::text('email',null,['class'=>'form-control']) }}

                    </div>
                    <div class="col-md-12">
                        {{ Form::label('comment','Comment') }}
                        {{ Form::textarea('comment',null,['class'=>'form-control','rows'=>'5']) }}

                        {{ Form::submit('Add Comment',['class'=>'btn btn-success','style'=>'margin-top:20px;']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div> --}}

@endsection