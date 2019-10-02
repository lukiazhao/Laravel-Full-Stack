@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Saved Jobs</h4>
                    @if(count($jobs) > 0)
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
                                                <a href="{{ route('jobs.show', ['job' => $job->id]) }}">{{ $job->title }}</a> <br>
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
                        <p class="text-center">You don't save any jobs yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
