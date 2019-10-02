@if($action === 'create')
    <form method="POST" action="{{ route('employers.jobs.store') }}" enctype="multipart/form-data" class="form-ad">
@else
    <form method="POST" action="{{ route('employers.jobs.update', ['job' => $job]) }}" enctype="multipart/form-data" class="form-ad">
    @method('PUT')
@endif
    @csrf

    {{-- Job title --}}
    <div class="form-group">
        <label class="control-label required">Job Title<span class="ml-2" style="color:red">*</span></label>
        <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title', isset($job) ? $job->title : null) }}" required autofocus>
        @if ($errors->has('title'))
            <span class="invalid-feedback d-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
    {{-- City --}}
    <div class="form-group">
        <label class="control-label required">City<span class="ml-2" style="color:red">*</span></label>

        <input type="text" name="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : ''}}" value="{{ old('city', isset($job) ? $job->city : null) }}" required autofocus>
    </div>

    {{-- Location --}}
    <div class="form-group">
        <label class="control-label required">Location (Optional)</label>

        <input type="text" name="suburb" class="form-control" value="{{ old('suburb', isset($job) ? $job->suburb : null) }}" autofocus>
        <small>Your can enter suburb name, street name or detailed address</small>
    </div>

    {{-- Type --}}
    <div class="form-group">
        <label class="control-label required">Type<span class="ml-2" style="color:red">*</span></label>
            <select class="custom-select" name="type_id">
                @foreach ($types as $type)
                    <option value="{{ isset($job) ? $job->type->id : $type->id }}" 
                        {{ (old("type_id") == $type->id) || (isset($job) && $type->id === $job->type->id) ? 'selected' : '' }}
                        required autofocus>{{ $type->name }}</option>
                @endforeach
            </select>
    </div>

    {{-- Classification --}}
    <div class="form-group">
        <label class="control-label required">Classification<span class="ml-2" style="color:red">*</span></label>

        {{-- Assume a job only has one classification. TODO: one to many classification --}}
        <select class="custom-select" name="classification">
            @foreach ($classifications as $classification)
                <option value="{{ $classification->id }}" 
                    {{ (old("classification") == $classification->id) || (isset($job) && $classification->id === $job->classifications->first()->id) ? 'selected' : '' }}
                    required autofocus>{{ $classification->name }}</option>
            @endforeach
        </select>
    </div>


    {{-- Salary --}}
    <div class="form-group" id="salary">
        <salary-form 
            errors_salary="{{ $errors->has('salary') }}" 
            errors_period="{{ $errors->has('payment_period')}}"
            job="{{ isset($job) ? $job : null }}"
            ></salary-form>
        @if ($errors->has('salary') || $errors->has('payment_period'))
            <span class="invalid-feedback d-block">
                <strong>{{ $errors->first('salary') }}</strong>
                <strong>{{ $errors->first('payment_period') }}</strong>
            </span>
        @endif
    </div>

    {{-- Description --}}
    <div class="form-group">
        <label class="control-label required">Description</label>
        <textarea name="description" rows="10" class="form-control">{{old('description', isset($job) ? $job->description : "")}}</textarea>
    </div>

    <div class="clearfix"></div>

    {{-- Closing Date --}}
    <div class="form-group mt-2">
        <label class="control-label required">Closing Date (Optional)</label>
        <div class="col-md-4 pl-0">
            <input type="text" id="closeDate" name="closing_date" class="form-control datepicker"
                value="{{ old('closing_date', isset($job) ? $job->closing_date : null) }}" data-toggle="datepicker" placeholder="yyyy-mm-dd" >
        </div>
        @if ($errors->has('closing_date'))
            <span class="invalid-feedback d-block">
                <strong>{{ $errors->first('closing_date') }}</strong>
            </span>
        @endif
    </div>

    <button type="submit" class="btn btn-primary float-left">Submit</button>
</form>

@push('scripts')
    <script src="{{ asset('js/employer-salary-form.js') }}"></script>
@endpush
