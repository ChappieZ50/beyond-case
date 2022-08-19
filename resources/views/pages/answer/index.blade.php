@extends('layouts.app')

@section('header')
    @component('components.breadcrumb')
        @slot('title','Answers')
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Answers Table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        @component('components.answers-table')
                            @slot('answers',$answers)
                        @endcomponent
                    </div>
                </div>
            </div>
            {!! $answers->links(); !!}
        </div>
    </div>
@endsection
