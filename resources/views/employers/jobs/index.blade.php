@extends('layouts.app')

@section('content')
 <!-- Start Content -->
 <div id="content">
    <div class="container">
        <div class="row mt-4">

            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="card borderless card-shadow">
                    <div class="card-header">Jobs</div>
                    <div class="card-body">
                        @if($jobs->count() > 0)
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Classification</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Closing Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobs as $job)
                                        <tr>
                                            <th scope="row">
                                                <a href="{{ route('employers.jobs.edit', $job) }}">{{ $job->title }}</a> <br>
                                                <small><i class="fas fa-map-marker-alt mr-0"></i>{{ $job->city }}</small>
                                            </th>
                                            @if(!$job->classifications->isEmpty())
                                                <td>
                                                    @foreach($job->classifications as $classification)
                                                        <p class="mr-2">{{ $classification->name }}</p>
                                                    @endforeach
                                                </td>
                                            @else 
                                                <td>--</td>
                                            @endif
                                            <td><span class="badge badge-info">{{ $job->type->name }}</span></td>
                                            <td>{{ $job->created_at }}</td>
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
                    {{ $jobs->links() }}
                </div>
                <!-- End Pagination -->
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
@endsection
