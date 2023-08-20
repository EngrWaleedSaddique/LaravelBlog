@extends('main')
@section('title','| Registration')
@section('content')

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h4>Reset Password</h4>
        <hr>
        <form action="{{route('reset.password')}}" method="post">
            @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
            @csrf
            <input type="hidden" name="token" value="{{$token}}">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" placeholder="Enter Email" name="email" value="{{$email ?? old('email')}}" />
                <!-- <span class="text-danger">@error('email'){{$message}} @enderror</span> -->
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" placeholder="Enter Password" name="password" value="{{old('password')}}" />
                <!-- <span class="text-danger">@error('password'){{$message}} @enderror</span> -->
            </div>
            <div class="form-group">
                <label for="password">Confirm Password</label>
                <input type="password" class="form-control" placeholder="Enter Password" name="password_confirmation" value="{{old('password_confirmation')}}" />
                <!-- <span class="text-danger">@error('password'){{$message}} @enderror</span> -->
            </div>
            
            <div class="form-group">
                <button class="btn btn-block btn-primary" type="submit">Reset Password</button>
            </div>
            <br>
            <a href="login">Login Here</a>
        </form>

    </div>
</div>

@endsection