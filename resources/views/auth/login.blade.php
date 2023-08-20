@extends('main')
@section('title','| Registration')
@section('content')

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h4>Login</h4>
        <hr>
        <form action="{{route('login-user')}}" method="post">
            @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
            @csrf
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
            <a href="{{route('forgot.password.form')}}" style="margin-bottom:10px;">Forgot Password</a>
            
            <div class="form-group">
                <button class="btn btn-block btn-primary" type="submit">Login</button>
            </div>
            <br>
            <a href="registration">New Users !! Register Here.</a>
        </form>

    </div>
</div>

@endsection