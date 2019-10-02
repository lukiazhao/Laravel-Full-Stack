@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="alert alert-light alert-dismissible fade show" role="alert">
            Complete profile can help employers know more about you.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div id="profile">
            {{-- phone number --}}     
            <div class="card shadow-sm p-2 rounded" id="edit_phone_number">
                <div class="card-body">
                    <h5 class="card-title">Phone Number</h5><hr>
                    <phone-input id="phoneInput" @phone-number-updated="updatePhoneNumber"></phone-input>
                </div>
            </div>

            {{-- Summary --}}
            <div class="card shadow-sm p-2 rounded my-3">
                <div class="card-body">
                    <h5 class="card-title">Summary</h5>
                    <hr>
                    <summary-input id="summaryInput" @sumary-updated="updateSummary"></summary-input>
                </div>
            </div>

            {{-- Experience --}}
            <div class="card shadow-sm p-2 rounded my-3">
                <div class="card-body">
                    <h5 class="card-title">Work Experience</h5>
                    <hr>
                    <work-input id="workInput"></work-input>
                </div>
            </div>

            {{-- Upload Resume --}}
            <div class="card shadow-sm p-2 rounded my-3">
                <div class="card-body">
                    <h5 class="card-title">Resume</h5>
                    <hr>
                    <resume-input id="resumeImage" @resume-updated="updateResume"></resume-input>
                </div>
            </div>
        </div>
       
    
@endsection

@push('scripts')
    <script>
        window.profile = @json($profile);  
        window.resume_path = @json($profile->resume_path);
    </script>
    <script src="{{ asset('js/employee-profile.js') }}"></script>
@endpush