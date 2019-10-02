@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $job->title }}</h4>
                    </div>
                    <div class="card-body">
                        <p>{{ $job->description }}</p>
                    </div>

                </div>
            </div>
            <div class="col">
                <div class="card">   
                    <div class="card-header text-primary" style="font-size:16px">
                        Job Details
                    </div>
                    @include('jobs.components.job-detail')
                    @if(Auth::check() && !Auth::user()->is_employer)
                        <div class="card-footer text-muted">
                            @if (!Auth::user()->employee->hasAppliedJobs($job))
                                <a type="button" class="btn btn-apply" 
                                    href="{{ route('employees.applications.create', ['job' => $job]) }}" style="width:110px">
                                    <i class="fa fa-paper-plane"></i>Apply</a>
                            @else
                                <a type="button" class="btn btn-secondary disabled" href="{{ route('employees.applications.create', ['job' => $job]) }}" style="width:110px">
                                    <i class="fa fa-paper-plane"></i>Applied</a>
                            @endif
                            @if(!Auth::user()->hasSavedJobs($job))
                                <button type="button" class="btn btn-save save-job-btn" data-job-id="{{ $job->id }}">
                                    <i class="far fa-star"></i>Save
                                </button>
                            @else
                                <button type="button" class="btn btn-save save-job-btn" data-job-id="{{ $job->id }}">
                                <i class="fa fa-star"></i>Saved</button>
                            @endif
                            @if (Auth::user()->linkedin_id)
                                <form action="{{ route('jobs.share', ['job' => $job->id]) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="btn btn-share px-3">
                                        <i class="fas fa-share"></i>Share
                                    </button>
                                </form>
                            @endif
                        </div>
                
                    @endif
                </div>
            </div> 
        </div>
    </div>

    
@endsection
@push('scripts')
    <script src="{{ asset('js/save-job.js') }}"></script>
@endpush