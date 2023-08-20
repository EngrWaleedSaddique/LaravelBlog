@extends('main')
@section('title','| Registration')
@section('content')

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h4>Registration</h4>
        <hr>
        <form action="{{route('register-user')}}" method="post">
            @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" placeholder="Enter Full Name" name="name" value="{{old('name')}}" />
                <!-- <span class="text-danger">@error('name'){{$message}} @enderror</span> -->
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" placeholder="Enter Email" name="email" value="{{old('email')}}" />
                <!-- <span class="text-danger">@error('email'){{$message}} @enderror</span> -->
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" placeholder="Enter Password" name="password" value="{{old('password')}}" />
                <!-- <span class="text-danger">@error('password'){{$message}} @enderror</span> -->
            </div>
            <div class="form-group">
                <button class="btn btn-block btn-primary" type="submit">Register</button>
            </div>
            <br>
            <a href="login">Already Registered !! Login Here</a>
        </form>

    </div>
</div>

@endsection