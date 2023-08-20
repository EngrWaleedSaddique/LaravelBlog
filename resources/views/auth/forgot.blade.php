@extends('main')
@section('title','| Registration')
@section('content')

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h4>Forgot Password</h4>
        <hr>
        <form action="{{route('forgot.password.link')}}" method="post">
            @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
            @csrf
            <p>Enter an email Address and we will send you a link to reset your password.</p>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" placeholder="Enter Email" name="email" value="{{old('email')}}" />
                <!-- <span class="text-danger">@error('email'){{$message}} @enderror</span> -->
            </div>
            
            <div class="form-group">
                <button class="btn btn-block btn-primary" type="submit">Send Reset Password Link</button>
            </div>
            <br>
            <a href="login">Already Registered !! Login Here</a>
        </form>

    </div>
</div>

@endsection