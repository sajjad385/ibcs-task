@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="card bg-default mt-3">
            <div class="card-header">Employee Attendance</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <p class="h3"> Attendances list</p>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-primary float-end m-1" href="{{ route('attendances.export') }}">Export</a>
                        <a class="btn btn-danger float-end m-1" href="{{ route('attendances.create') }}">Import</a>
                    </div>
                </div>
                <form action="{{route('attendances.index')}}">
                    <div class="row">
                        <div class="col-4">
                            <label for="in_time">Select IN Time <small class="text-danger">(Ex:
                                    09:00:AM)</small></label>
                            <input type="time" name="in_time" class="form-inline" placeholder="Select IN time">
                            <br>
                            <br>
                        </div>
                        <div class="col-4">
                            <label for="in_time">Select Out Time <small class="text-danger">(Ex:
                                    06:00:PM)</small></label>
                            <input type="time" name="out_time" class="form-inline" placeholder="select IN time">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="employee">Search by ID</label>
                            <input type="text" name="employee" class="form-inline" placeholder="Search By ID">
                        </div>
                        <div class="col-2">
                            <br>
                            <button type="submit" class="btn btn-success">submit</button>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered mt-3">
                    <tr>
                        <th>SL</th>
                        <th>Month</th>
                        <th>Date</th>
                        <th>Day</th>
                        <th>ID</th>
                        <th>Employee Name</th>
                        <th>Department</th>
                        <th>First-In-Time</th>
                        <th>Last-Out-Time</th>
                        <th>Hours of Work</th>

                    </tr>
                    @foreach($reports as $report)
                        <tr>
                            <td>{{ $report->id }}</td>
                            <td>{{ $report->month }}</td>
                            <td>{{ $report->date}}</td>
                            <td>{{ $report->day}}</td>
                            <td>{{ $report->employee_id}}</td>
                            <td>{{ $report->employee_name}}</td>
                            <td>{{ $report->department}}</td>
                            @if($report->in_time)
                                @if($report->in_time < $report->first_in_time)
                                    <td class="bg-danger">{{ $report->first_in_time}}</td>
                                @else
                                    <td>{{ $report->first_in_time}}</td>
                                @endif
                            @else
                                <td>{{ $report->first_in_time}}</td>
                            @endif

                            @if($report->out_time)
                                @if($report->out_time > $report->last_out_time)
                                    <td style="background-color: yellow">{{ $report->last_out_time}}</td>
                                @else
                                    <td>{{ $report->last_out_time}}</td>
                                @endif
                            @else
                                <td>{{ $report->last_out_time}}</td>
                            @endif
                            <td>{{ $report->hours_of_work}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
