@extends('layouts.app')

@section('header')
    @component('components.breadcrumb')
        @slot('title','Answered')
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="row mt-4 justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="d-flex flex-column h-100">
                                    <p class="mb-1 pt-2 text-bold">Build by Uğur Tosun</p>
                                    <h5 class="font-weight-bolder">Beyond Case</h5>
                                    <p class="mb-5">
                                        We only accept 1 registration per account. To send new records, you can become a member by clicking <a href="{{route('register.index')}}">here</a>.
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                                <div class="bg-gradient-primary border-radius-lg h-100" style="background:transparent !important;">
                                    <div class="position-relative d-flex align-items-center justify-content-center h-100">
                                        <img class="w-100 position-relative z-index-2 pt-4" src="{{asset('assets/img/sad.jpg')}}" alt="rocket">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
