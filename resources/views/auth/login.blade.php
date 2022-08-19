@extends('auth.layouts.app')
@section('title','Beyond Case - Login')

@section('card-footer')
    Don't have an account?
    <a href="{{route('register.index')}}" class="text-info text-gradient font-weight-bold">Sign up</a>
@endsection

@section('content')
    <form role="form" method="post" action="{{route('login.store')}}">
        @csrf
        <label>Email</label>
        <div class="form-group mb-1">
            <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" value="{{old('email')}}">
        </div>
        @error('email')
        <div class="invalid-feedback d-block text-small">{{$message}}</div>
        @enderror
        <label>Password</label>
        <div class="form-group mb-1">
            <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
        </div>
        @error('password')
        <div class="invalid-feedback d-block text-small">{{$message}}</div>
        @enderror

        @if($errors->first('incorrect_credentials'))
            <div role="alert" class="alert alert-warning text-white mt-3"
                 style="background-image: none;background-color: #fc7c5f;padding: 1rem 1.5rem;border: 0;font-size: .875rem;border-radius: 0.25rem;">
                <strong>Error!</strong> <span>{{$errors->first('incorrect_credentials')}}</span>
            </div>
        @endif
        <div class="text-center">
            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
        </div>
    </form>
@endsection
