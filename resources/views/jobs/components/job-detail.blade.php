<div class="card-body">                            
    <p><i class="fas fa-clock"></i>Posted: {{ $job->created_at }}</p>
    <p><i class="fas fa-city"></i>City: {{ $job->city }}</p>
    <p><i class="fas fa-calendar"></i>Close At:</p>
    <p><i class="fas fa-map-marker-alt"></i>Location: {{ $job->suburb }}</p>
    <p><i class="fas fa-money-bill-wave-alt"></i>Salary: </p>
    <p><i class="far fa-hourglass"></i>Classification:                                         
        @if(!$job->classifications->isEmpty())
            @foreach($job->classifications as $classification)
                <a href="{{ route('jobs.index', [ 'selectedClassification' => $classification ]) }}" class="mr-2 classification-link">{{ $classification->name }}</a>
            @endforeach
        @endif
    </p>
    <p style="margin:5px 0 5px"><i class="fas fa-tags" ></i>Type : 
        <span class="badge badge-info mr-1">{{ $job->type->name }}</span>
    </p>
</div>
