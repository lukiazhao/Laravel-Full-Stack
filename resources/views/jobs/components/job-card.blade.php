
<div class="card job-card" style="margin-bottom:20px">   
    <div class="card-header">
        <div class="row">
            <div class="col">
                 <a style="font-size:18px;" href="{{ route('jobs.show', ['id' => $job->id]) }}">{{ $job->title }}</a>
            </div>
            <div class="col text-right">  
                <small>{{ $job->created_at->diffForHumans() }}</small>
            </div>
        </div>

        @if(!$job->classifications->isEmpty())
            <p class="mt-2" style="font-style:italic">
                @foreach($job->classifications as $classification)
                    <a href="{{ route('jobs.index', [ 'selectedClassification' => $classification ]) }}" class="mr-2 classification-link">{{ $classification->name }}</a>
                @endforeach
            </p>
        @endif

        <h6 style="margin:5px 0 5px"><i class="fas fa-tags" ></i>Type : 
            <span class="badge badge-info mr-1">{{ $job->type->name }}</span>
        </h6>
    </div>

    <div class="card-body">
        <p><i class="fas fa-building"></i>{{ $job->employer->business_name}}</p>
        <p><i class="fas fa-map-marker-alt"></i>{{ $job->city }} | {{ $job->suburb }}</p>
        @if(isset($job->company_size)) 
            <p><i class="fas fa-user-friends"></i>{{ $job->company_size }} people</p>
        @endif
       
    </div>
    
    @if(Auth::check())
        <div class="card-footer">
            <div class="d-flex justify-content-end">
                @if(!Auth::user()->hasSavedJobs($job))
                    <button type="button" class="btn btn-save save-job-btn" data-job-id="{{ $job->id }}">
                        <i class="far fa-star"></i>Save
                    </button>
                @else
                    <button type="button" class="btn btn-save save-job-btn" data-job-id="{{ $job->id }}">
                    <i class="fa fa-star"></i>Saved</button>
                @endif
            </div>
        </div>
    @endif
    
</div>
