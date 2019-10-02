@extends('layouts.app')

@section('content')
<div class="container shadow-sm p-4 mb-4 bg-white rounded" >
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('partials.search_form')
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col pl-0 col-md-8">
            @include('jobs.components.job-list')
        </div>
        <div class="col pr-0">
            @include('jobs.components.classifications')

            @include('jobs.components.types')
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        @include('jobs.components.paginator')
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/save-job.js') }}"></script>
@endpush