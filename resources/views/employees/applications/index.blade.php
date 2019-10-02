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
                        @if($applications->count() > 0)
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Classification</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Closing Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applications as $application)
                                        <tr>
                                            <th scope="row">
                                                <a href="{{ route('jobs.show', $application->job) }}">{{ $application->job->title }}</a><br>
                                                <small><i class="fas fa-map-marker-alt mr-0"></i>{{ $application->job->city }}</small>
                                            </th>
                                            @if(!$application->job->classifications->isEmpty())
                                                <td>
                                                    @foreach($application->job->classifications as $classification)
                                                        <p class="mr-2">{{ $classification->name }}</p>
                                                    @endforeach
                                                </td>
                                            @else 
                                                <td>--</td>
                                            @endif
                                            <td><span class="badge badge-info">{{ $application->job->type->name }}</span></td>
                                            @if ($application->job->closing_date)
                                                <td>{{ $application->job->closing_date }}</td>
                                            @else
                                                <td>--</td>
                                            @endif
                                            <td><a href="{{ route('employees.applications.edit', ['application' => $application]) }}">Edit</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-warning text-center">
                                <p class="mb-0">You haven't created any jobs.</p>
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
