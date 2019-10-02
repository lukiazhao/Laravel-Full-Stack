@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Apply for {{ $job->title }}</h4>
                    </div>
                    <div class="card-body">
                        @include('employees.applications.form', ['action' => 'create'])
                    </div>

                </div>
            </div>
            <div class="col">
                <div class="card">   
                    <div class="card-header text-primary" style="font-size:16px">
                        Job Details
                    </div>

                    @include('jobs.components.job-detail')
                </div> 
            </div>
        </div>
    </div>
@endsection
