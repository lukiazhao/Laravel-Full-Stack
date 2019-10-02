@forelse ($jobs as $job) 
    @include('jobs.components.job-card', ['job' => $job ])
@empty
    <div class="col-md-12">
        <div class="alert alert-warning text-center">
            <p class="mb-0">No jobs</p>
        </div>
    </div>
@endforelse