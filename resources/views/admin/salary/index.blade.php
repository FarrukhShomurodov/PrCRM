@extends('layouts.admin')

@section('content-header')
    Salary
@endsection
@section('breadcrumb-items')
    <li class="breadcrumb-item active">Salary</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Specialist Id</th>
                    <th>Month</th>
                    <th>Amount Of Hours Finished a Month</th>
                    <th>year</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($salaries as $salary)
                    <tr>
                        <td>{{$salary->id}}</td>
                        @foreach($specialists as $specialist)
                            @if($specialist->id == $salary->specialist_id)
                                <td>{{$specialist->name}}</td>
                            @endif
                        @endforeach
                        <td>{{$salary->month}}</td>
                        <td>{{$salary->amount_of_hours}}</td>
                        <td>{{$salary->year}}</td>
                        <td>{{$salary->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection
