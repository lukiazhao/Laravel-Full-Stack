<div class="container shadow-sm p-4 mb-4 bg-white rounded">
    <h5 class="font-weight-bold">Type:</h5>
    <p>
        <a class="btn btn-outline-info {{ isset($selectedType) ? '' : 'active' }}"
        style="border:none;width:auto"  
        href=" {{ route('jobs.index', ['selectedType' => null, 'selectedClassification' => $selectedClassification, 'keyword' => $keyword]) }}">All</a>
        @forelse ($types as $type)
        <a class="btn btn-outline-info {{ isset($selectedType) && $selectedType === $type->id ? 'active' : '' }}" 
        style="border:none;width:auto" href="{{ route('jobs.index', [
                'selectedType' => $type,
                'selectedClassification' => $selectedClassification,
                'keyword' => $keyword,
            ]) }}">
                {{ $type->name }}
            </a>
        @empty
            <p>no available classifications</p>
        @endforelse
    </p>
</div>