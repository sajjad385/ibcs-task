@extends('layouts.master')
@push('css')
    <style>
        table, tr,th,td{
            border: 1px solid black;
            text-align: center;
        }
        tr,th,td{
            padding: 5px;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header" style="text-align: center; font-weight: bold">Employee Attendance Report</div>
        </div>
        <table>
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
@endsection
