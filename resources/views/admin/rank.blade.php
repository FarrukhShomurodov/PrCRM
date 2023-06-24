@extends('layouts.admin')

@section('content-header')
    Rank
@endsection
@section('breadcrumb-items')
    <li class="breadcrumb-item active">Rank</li>
@endsection

@section('content')
    <div class="card  w-50">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Hour</th>
                </tr>
                </thead>
                <tbody>
                @foreach($salaries as $salary)
                    <tr>
                        @foreach($specialists as $specialist)
                            @if($salary->specialist_id == $specialist->id)
                                <td>{{$specialist->name}}</td>
                            @endif
                        @endforeach
                        <td>{{$salary->amount_of_hours}} Hours</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection
