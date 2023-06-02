@extends('layouts.admin')

@section('content-header')
    Jobs
@endsection
@section('breadcrumb-items')
    <li class="breadcrumb-item active">Jobs</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <a class="text-light" href="{{route('jobs.create')}}"><button type="button" class="btn btn-block btn-dark">Create</button></a>
                </div>
            </div>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Specialist</th>
                    <th>Spent Time</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                        <tr>
                            <td>{{$job->id}}</td>
                            <td>{{$job->name}}</td>
                            <td>
                                @foreach($specialists as $specialist)
                                    @if($specialist->id == $job->specialist_id)
                                        {{$specialist->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$job->spent_time}} hours</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection
