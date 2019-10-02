@extends('layouts.app')

@section('content')
 <!-- Start Content -->
 <div id="content">
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-8 col-sm-8 col-xs-10">
                <div class="card borderless card-shadow">
                    <div class="card-header"><strong>Applicant Details</strong></div>
                    <div class="card-body">
                       {{-- <h6 class="text-secondary">Full Name : <span class="text-bold">{{ $applicant->user->name }}</span></h6> --}}
                        <div class="row my-3">
                            <div class="col">Full Name : </div>
                            <div class="col">{{ $applicant->user->name }}</div>
                        </div>
                        <div class="row my-3">
                            <div class="col">Email : </div>
                            <div class="col">{{ $applicant->user->email }}</div>
                        </div>
                        @if ($application->see_phone_number === 1)
                            <div class="row my-3">
                                <div class="col">Phone Number : </div>
                                <div class="col">{{ $applicant->phone_number }}</div>
                            </div>
                        @endif
                        <div class="row my-3">
                            <div class="col">Application Date : </div>
                            <div class="col">{{ $applicant->created_at }}</div>
                        </div>
                        <div class="row my-3">
                            <div class="col">Personal Summary : </div>
                            <div class="col">{{ $applicant->summary }}</div>
                        </div>
                        <div class="row my-3">
                            <div class="col">Working Experience : </div>
                            <div class="col">
                            @forelse ($applicant->workExperiences as $workExperience)
                                <div class="my-3">
                                    <p class="card-title"><strong>{{ $workExperience->position }} @ {{ $workExperience->company }}</strong> </p>
                                    <p class="card-subtitle">{{ isset($workExperience->startDate) ? $workExperience->startDate : "--" }} -
                                        {{ isset($workExperience->endDate) ? $workExperience->endDate : "Current" }}</p>
                                    <p>{{ $workExperience->job_duties }}</p>
                                    <hr>
                                </div>
                            @empty
                                <p>---</p>
                            @endforelse
                            </div>
                        </div>
                       
                        @if ($application->attach_resume)
                            <div class="row my-3">
                                <div class="col">Resume: </div>
                            </div>
                        
                            @if (substr($applicant->resume_path, -3) === 'pdf')
                                <embed src="{{ $applicant->resume_path }}" type="application/pdf" alt="{{ $applicant->resume_path }}" width="580px" height="800px" class="mb-2">
                            @else
                                <img src="{{ $applicant->resume_path }}" alt="{{ $applicant->resume_path }}" class="mb-2 img-fluid">
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">   
                    <div class="card-header text-primary" style="font-size:16px">
                        Job Details
                    </div>
                    @include('jobs.components.job-detail', ['job' => $application->job])
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
@endsection
