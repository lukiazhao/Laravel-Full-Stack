@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center my-4">
        <div class="col-md-8 col-xs-12">
            <div class="card borderless card-shadow">
                <div class="card-header"><h4 class="mb-0">Edit Job</h4></div>
                <div class="card-body">
                    @include('employers.jobs.form', ['action' => 'edit'])

                    <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#deleteGameModal">Delete</button>
                </div>
            </div>

            <div class="modal fade" id="deleteGameModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete {{ $job->title }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this job?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <form id="deleteGame" method="POST" action="{{ route('employers.jobs.delete', ['job' => $job]) }}">
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
@endsection
