@extends('main')
@section('title','| Home Page')
@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron text-center" style="background:red;color:white;">
                    <h1>Welcome to our Blog.</h1>
                    <p class="lead">Thank you so much for visting.</p>
                    {{-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Posts</a></p> --}}
                </div>
            </div>
        </div>
    
    <div class="row">
        <div class="col-md-8">
          <!-- main content -->
            <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4">
                    <div class="post">
                        <img src="{{asset('images/'.$post->image)}}" class="img-responsive" alt="">
                        <h3>{{$post->title}}</h3>
                        <p>{{substr($post->body,0,300)}}{{strlen($post->title) > 300 ? "...": ""}}</p>
                        <p><a href="{{url('blog/'.$post->slug)}}" class="btn btn-lg" style="color:white;background:red;">Read more...</a></p>
                        <hr>
                    </div>
                </div>
            @endforeach
            </div>
            
        </div>
        <div class="col-md-3 col-md-offset-1">
            <h2>Advertisement</h2>
        </div>
    </div>
    @endsection
