@extends('main')
@section('title','| All Categories')
@section('content')


<div class="row">
    <div class="col-md-8">
        <h1>Categories</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                </tr>
                <tbody>
                    @foreach($categories as $cateogry)
                    <tr>
                        <th>{{$cateogry->id}}</th>
                        <th>{{$cateogry->name}}</th>
                    </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>
    </div>
    <div class="col-md-3">
        <div class="well">
            {!! Form::open(['route'=>'categories.store','method'=>'POST']) !!}
                <h2>New Category</h2>

                {{ Form::label('name','Name:') }}
                {{ Form::text('name',null,['class'=>'form-control']) }}
                
                {{ Form::submit('Create New Category',['class'=>'btn btn-primary btn-block btn-spacing-top']) }}

            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection