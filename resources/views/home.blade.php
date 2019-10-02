@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="alert alert-info text-center">
            <p class="mb-0">Latest jobs</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-9">
            @include('jobs.components.job-list')
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/save-job.js') }}"></script>
@endpush