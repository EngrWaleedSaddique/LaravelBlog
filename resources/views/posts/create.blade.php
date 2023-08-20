@extends('main')
@section('title','| Create New Posts')
@section('stylesheets')
    <!-- we laravel collective alias to add css library here -->
    {!! Html::style('css/parsely.css') !!}
    {!! Html::style('css/select2.min.css') !!}

@endsection


@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Create New Posts</h1>
            <hr>

            {!! Form::open(['url' => 'posts', 'data-parsley-validate'=> '','files'=>true]) !!}

                {{Form::label('title','Title:')}}
                {{Form::text('title',null,['class' => 'form-control', 'required'=>'','max-length'=>'255'])}}
                
                {{Form::label('slug','Slug')}}
                {{Form::text('slug',null,['class'=>'form-control','required'=>'','minlength'=>'5',
                    'maxlength'=>'255'])}}


                {{ Form::label('category_id','Category:')}}
                <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>

                {{ Form::label('tags','Tags')}}
                <select class="select2-multi form-control" name="tags[]" multiple>
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                    @endforeach
                </select>
                <br>
                {{ Form::label('featured_image','Upload feature Image') }}
                {{ Form::file('featured_image') }}


                {{Form::label('body','Post Body')}}
                {{Form::textarea ('body',null,['class' => 'form-control', 'required'=>'','maxlength'=>'500'])}}

                {{Form::submit('Create Post',['class' => 'btn btn-success btn-lg btn-block','style'=>'margin-top:20px;'])}}

            {!! Form::close() !!}
        </div>
    </div>


@endsection
@section('scripts')
    <!-- we laravel collective alias to add JS library here -->
    {!! Html::script('js/parsely.min.js') !!}
    {!! Html::script('js/select2.min.js') !!}
    
    <script type="text/javascript">
        $('.select2-multi').select2();
    </script>
@endsection