@extends('layouts.admin')

@section('content-header')
    Specialists
@endsection
@section('breadcrumb-items')
    <li class="breadcrumb-item active">Specialists</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <a class="text-light" href="{{route('specialists.create')}}"><button type="button" class="btn btn-block btn-dark">Create</button></a>
                </div>
            </div>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date Birth</th>
                    <th>Speciality</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($specialists as $specialist)
                        <tr>
                            <td>{{$specialist->id}}</td>
                            <td>{{$specialist->name}}</td>
                            <td>{{$specialist->dateBirth}}</td>
                            <td>{{$specialist->speciality}}</td>
                            <td>
                                <div class="w-75 d-flex justify-content-around">
                                    <div class="col-2 p-0">
                                        <a class="btn" href="{{route('specialists.edit',$specialist->id)}}">
                                            <i class="fa fa-sharp fa-solid fa-pen" style="color: #00b44e"></i>
                                        </a>
                                    </div>
                                    <div class="col-2 p-0">

                                        <form action="{{route('specialists.destroy',$specialist->id)}}"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn" type="submit"><i
                                                    class="fa fa-sharp fa-solid fa-trash" style="color: red"></i>
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection
