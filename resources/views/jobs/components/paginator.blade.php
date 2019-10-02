<div class="mt-2 d-flex justify-content-center">
    {{ $jobs->appends([
        'selectedClassification' => $selectedClassification,
        'selectedType' => $selectedType,
        'keyword' => $keyword,
        ])->links() }}
</div>