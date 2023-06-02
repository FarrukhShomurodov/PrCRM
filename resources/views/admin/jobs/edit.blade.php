@extends('layouts.admin')

@section('content-header')
    Edit Jobs
@endsection
@section('breadcrumb-items')
    <li class="breadcrumb-item active">Edit Jobs</li>
@endsection

@section('content')
    <form action="{{route('jobs.update', $job->id)}}" method="post">
        @csrf
        @method('put')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{$job->name}}">
            </div>
            <div class="form-group">
                <label for="specialist_id">Specialist</label>
                <input type="number" name="specialist_id" class="form-control" id="specialist_id" placeholder="Specialist" value="{{$job->specialist_id}}">
            </div>
            <div class="form-group">
                <label for="spent_time">Spent Time</label>
                <input type="number" name="spent_time" class="form-control" id="spent_time" placeholder="Spent Time" value="{{$job->spent_time}}">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
