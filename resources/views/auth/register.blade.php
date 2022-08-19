@extends('auth.layouts.app')
@section('title','Beyond Case - Register')
@section('card-text','To become a member, fill out the form and click the subscribe button.')

@section('card-footer')
    Already have an account?
    <a href="{{route('login.index')}}" class="text-info text-gradient font-weight-bold">Sign in</a>
@endsection

@section('content')
    <form role="form" method="post" action="{{route('register.store')}}">
        @csrf
        <label>Name</label>
        <div class="form-group mb-1">
            <input type="text" name="name" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="email-addon" value="{{old('name')}}">
        </div>
        @error('name')
            <div class="invalid-feedback d-block text-small">{{$message}}</div>
        @enderror
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
        <label>Password Confirmation</label>
        <div class="form-group mb-1">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" aria-label="Password Confirmation"
                   aria-describedby="password-confirmation-addon">
        </div>
        @error('password_confirmation')
        <div class="invalid-feedback d-block text-small">{{$message}}</div>
        @enderror
        <div class="text-center">
            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign up</button>
        </div>
    </form>
@endsection
