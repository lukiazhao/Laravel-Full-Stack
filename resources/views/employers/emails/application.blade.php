@component('mail::message')
# New Application Received

### You have received a new application for job {{ $application->job->title }}, click the link below to view.

@component('mail::button', ['url' => $applicationLink])
View Application
@endcomponent
If the above button does not work please copy the url below and paste it into your browser.
<br>
{{ $applicationLink }}
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent