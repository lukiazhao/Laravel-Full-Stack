@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Apply for {{ $application->job->title }}</h4>
                    </div>
                    <div class="card-body">
                        @include('employees.applications.form', ['action' => 'edit'])
                        <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#deleteApplicationModal">Delete</button>
                    </div>

                </div>
            </div>
            <div class="col">
                <div class="card">   
                    <div class="card-header text-primary" style="font-size:16px">
                        Job Details
                    </div>
                    @include('jobs.components.job-detail', ['job' => $application->job])

                    <div class="modal fade" id="deleteApplicationModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete {{ $application->job->title }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this job?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <form id="deleteApplication" method="POST" action="{{ route('employees.applications.delete', ['application' => $application]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div> 
            </div>
        </div>
    </div>
@endsection