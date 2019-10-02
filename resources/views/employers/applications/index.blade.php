@extends('layouts.app')

@section('content')
 <!-- Start Content -->
 <div id="content">
    <div class="container">
        <div class="row mt-4">

            <div class="col-md-10 col-sm-10 col-xs-12">
                <div class="card borderless card-shadow">
                    <div class="card-header">Applications</div>
                    <div class="card-body">
                        @if($applications && $applications->count() > 0)
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Applicant</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Closing Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applications as $application)
                                        <tr>
                                            <td scope="row">
                                            <a href="{{ route('employers.applications.details', ['application' => $application]) }}">{{ $application->employee->user->name }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('jobs.show', $application->job) }}">{{ $application->job->title }}</a><br>
                                            </td>
                                            @if ($application->job->closing_date)
                                                <td>{{ $application->job->closing_date }}</td>
                                            @else
                                                <td>--</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-warning text-center">
                                <p class="mb-0">You haven't received any applications.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Start Pagination -->
                <div class="float-right mt-2">
                    {{ $applications->links() }}
                </div>
                <!-- End Pagination -->
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
@endsection
