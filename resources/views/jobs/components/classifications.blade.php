<div class="container shadow-sm p-4 mb-4 bg-white rounded font-weight-bold">
    <h5>Classification:</h5>
    <div style="line-height:35px;">
        <a class="btn btn-sm btn-outline-secondary {{ isset($selectedClassification) ? '' : 'active' }}" style="width:auto;border:none" 
        href="{{ route('jobs.index', [ 'selectedClassification' => null, 'selectedType' => $selectedType, 'keyword' => $keyword ]) }}">All</a>

        @forelse ($classifications as $classification)
            <a class="btn btn-sm btn-outline-secondary text-left {{ isset($selectedClassification) && $selectedClassification === $classification->id ? 'active' : '' }}" 
            style="width:auto;border:none;" href="{{ route('jobs.index', [ 'selectedClassification' => $classification, 'selectedType' => $selectedType, 'keyword' => $keyword, ]) }}">{{ $classification->name }}</a>
        @empty
            <p>no available classifications</p>
        @endforelse
    </div>
</div>