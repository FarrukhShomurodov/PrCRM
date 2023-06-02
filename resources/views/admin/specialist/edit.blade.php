@extends('layouts.admin')

@section('content-header')
    Edit Specialists
@endsection
@section('breadcrumb-items')
    <li class="breadcrumb-item active">Edit Specialists</li>
@endsection

@section('content')
    <form action="{{route('specialists.update', $specialist->id)}}" method="post">
        @csrf
        @method('put')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{$specialist->id}}">
            </div>
            <div class="form-group">
                <label for="DateBirth">DateBirth</label>
                <input type="date" name="dateBirth" class="form-control" id="DateBirth" placeholder="Date Birth" value="{{$specialist->dateBirth}}">
            </div>
            <div class="form-group">
                <label for="speciality">Speciality</label>
                <input type="text" name="speciality" class="form-control" id="speciality" placeholder="Speciality" value="{{$specialist->speciality}}">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
