
<form method="POST" action="{{ route('employers.homepage.update', ['employer'=> $employer ]) }}" enctype="multipart/form-data" class="form-ad">
    @csrf

    {{-- Business Name --}}
    <div class="form-group">
        <label class="control-label required">Business Name<span class="ml-2" style="color:red">*</span></label>
        <input type="text" name="business_name" class="form-control" value="{{ old('business_name', isset($employer) ? $employer->business_name : null) }}" required autofocus>
    </div>

    {{-- Introduction --}}
    <div class="form-group">
        <label class="control-label required">Introduction</label>
        <textarea name="introduction" rows="5" class="form-control">{{old('introduction', isset($employer) ? $employer->introduction : "")}}</textarea>
    </div>

    {{-- Classification --}}
    <div class="form-group">
        <label class="control-label required">Classification<span class="ml-2" style="color:red">*</span></label>

        <select class="custom-select" name="classification" required>
            <option value="">-- Choose --</option>
            @foreach ($classifications as $classification)
                <option value="{{ $classification->id }}" 
                    {{ isset($employer) && isset($employer->classification_id) && $classification->id === $employer->classification_id ? 'selected' : '' }}
                    required autofocus>{{ $classification->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Company Size --}}
    <div class="form-group">
        <label class="control-label required">Company Size<span class="ml-2" style="color:red">*</span></label>
        <select class="custom-select" name="company_size" required>
            <option value="">-- Choose --</option>
            @for ($i = 0; $i < 100; $i+=10)
                <option value="{{ $i }}" {{ isset($employer) && isset($employer->company_size) && ($employer->company_size == $i) ? 'selected' : '' }}>{{ $i }} - {{ $i + 10 }} people</option>
            @endfor
            <option value=">100 people">>100 people</option>
        </select>
    </div>
   

    {{-- City --}}
    <div class="form-group">
        <label class="control-label required">City<span class="ml-2" style="color:red">*</span></label>
        <input type="text" name="city" class="form-control" value="{{ old('city', isset($employer) ? $employer->city : null) }}" required autofocus>
    </div>

    {{-- Detailed Address --}}
    <div class="form-group">
        <label class="control-label required">Detailed Address</label>
        <input type="text" name="detailed_address" class="form-control" value="{{ old('detailed_address', isset($employer) ? $employer->detailed_address : null) }}" autofocus>
    </div>

    {{-- Website --}}
    <div class="form-group">
        <label class="control-label required">Detailed Address</label>
        <input type="text" name="website" class="form-control" value="{{ old('website', isset($employer) ? $employer->website : null) }}" autofocus>
    </div>

    {{-- Phone Number --}}
    <div class="form-group">
        <label class="control-label required">Phone Number</label>
        <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', isset($employer) ? $employer->phone_number : null) }}" autofocus>
    </div>

    {{-- Logo --}}
    <div class="form-group" id="logoInput"> 
        <logo-input></logo-input>
    </div>

    <button type="submit" class="btn btn-primary float-left">Submit</button>
</form>

@push('scripts')
    <script>
        window.employer = @json($employer);  
    </script>
    <script src="{{ asset('js/employer-homepage.js') }}"></script>
@endpush