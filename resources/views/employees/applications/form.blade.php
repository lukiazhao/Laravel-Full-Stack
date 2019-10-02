@if($action === 'create')
    <form method="POST" action="{{ route('employees.applications.store', ['job' => $job]) }}" enctype="multipart/form-data" class="form-ad">
@else
    <form method="POST" action="{{ route('employees.applications.update', ['application' => $application]) }}" enctype="multipart/form-data" class="form-ad">
    @method('PUT')
@endif
    @csrf

    <div>
        <small>Tips: you can upload resume and portfolio under "My Profile", and choose to send to employers when apply for jobs.</small>
    </div>

    <div class="form-group m-3">
        <div class="custom-control custom-checkbox m-3">
            <input type="checkbox" class="custom-control-input" id="customCheck1" name="see_phone_number" {{ isset($application) && ($application->see_phone_number === 1) ? 'checked' : '' }}>
            <label class="custom-control-label" for="customCheck1">Allow employer to see my phone number</label>
        </div>
        <div class="custom-control custom-checkbox m-3">
            <input type="checkbox" class="custom-control-input" id="customCheck2" name="attach_resume" {{ isset($application) && ($application->attach_resume === 1) ? 'checked' : '' }}>
            <label class="custom-control-label" for="customCheck2">Attach Resume</label>
        </div>
    </div>

    <div class="form-group mt-3">
        <label class="control-label required">Message</label>
        <textarea name="message" rows="10" class="form-control" placeholder="I will be really good at this job. Thank you.">{{ isset($application) ? $application->message : null }}</textarea>
    </div>

    <button type="submit" style="width:auto" class="btn btn-primary float-left">{{ isset($application) ? "Save Changes" : "Submit"}}</button>
</form>