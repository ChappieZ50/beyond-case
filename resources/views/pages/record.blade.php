@extends('layouts.app')

@section('header')
    @component('components.breadcrumb')
        @slot('title','Send Record')
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <form action="{{route('record.store')}}" method="post" id="recordForm" enctype="multipart/form-data">
            <div role="alert" class="alert alert-warning text-white mt-3" id="recordError"
                 style="display:none;background-image: none;background-color: #fc7c5f;padding: 1rem 1.5rem;border: 0;font-size: .875rem;border-radius: 0.25rem;">
                <strong>Error!</strong> <span id="recordErrorText"></span>
            </div>
            @csrf
            <input type="hidden" name="duration" value="0" id="duration">
            <div class="row col-12">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="message">
                            Most about your job
                            What are the 3 details you love? <span class="text-danger">(*)</span>
                        </label>
                        <textarea name="message" id="message" class="form-control" placeholder="What are your 3 favorite details about your job?">{{old('message')}}</textarea>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <label>Take Record</label>
                    <div class="form-group">
                        <button type="button" id="startRecord" class="btn btn-sm btn-outline-primary">Start Recording</button>
                        <button type="button" id="stopRecord" class="btn btn-sm btn-outline-danger" style="display: none">Stop Recording</button>
                    </div>
                </div>
            </div>
            <div class="row col-12">
                <div class="col-lg-6 col-sm-12">
                    <label>Your Camera</label>
                    <div class="form-group">
                        <video id="preview" autoplay muted></video>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <label>Video Record</label>
                    <div class="form-group">
                        <video id="recording" controls></video>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="button" id="saveRecord" class="col-3 btn  btn-outline-success">Save</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{asset('assets/js/record.js')}}"></script>
@endpush
