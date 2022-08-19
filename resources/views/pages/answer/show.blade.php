@extends('layouts.app')

@section('header')
    @component('components.breadcrumb')
        @slot('content')
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{route('answer.index')}}">Answers</a></li>
        @endslot
        @slot('title','Showing Answer')
    @endcomponent
@endsection

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-6 col-md-6 col-12">
            <div class="row">
                <video controls>
                    <source src="{{$record}}" type="video/mp4">
                </video>
                <span class="text-center text-body p-3">
                    {{$answer->message}}
                </span>
            </div>

        </div>

    </div>
@endsection

