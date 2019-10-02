<form action="{{ route('jobs.index') }}" method="GET">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Keywords</span>
        </div>
        <input type="text" class="form-control" name="keyword" placeholder="Title / Company Name"  value="{{ isset($keyword) ? $keyword : "" }}">
        <input type="hidden" name="selectedClassification" value="{{ $selectedClassification }}">
        <input type="hidden" name="selectedType" value="{{ $selectedType }}">

        <div class="input-group-prepend">
            <span class="input-group-text">City</span>
        </div>
        
        {{-- todo: --}}
        <select class="custom-select">
            <option selected>Choose...</option>
        </select>
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </div>

</form>
