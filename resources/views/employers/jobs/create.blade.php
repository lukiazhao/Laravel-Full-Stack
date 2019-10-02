@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center my-4">
        <div class="col-md-8 col-xs-12">
            <div class="card borderless card-shadow">
                <div class="card-header"><h4 class="mb-0">Post Job</h4></div>
                <div class="card-body">
                    @include('employers.jobs.form', ['action' => 'create'])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection