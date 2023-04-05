@extends('admin.admin_master')

@section('admin')
<div class="page-content">
    <div class="container-fluid">
     <h2>Time Logs</h2>
        <a href="{{ route('timelog.create') }}" class="btn btn-primary mb-3">Add Time Log</a>
        @if (count($timelogs) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Total Time</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($timelogs as $timelog)
                        <tr>
                            <td>{{ $timelog->project->name }}</td>
                            <td>{{ Carbon\Carbon::parse($timelog->date)->format('d/m/Y') }}</td>
                            <td>{{ Carbon\Carbon::parse($timelog->start_time)->format('H:i') }}</td>
                            <td>{{ Carbon\Carbon::parse($timelog->end_time)->format('H:i') }}</td>
                            <td>{{ $timelog->total_time }}</td>
                            <td>
                                <a href="{{ route('timelog.edit', $timelog->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('timelog.destroy', $timelog->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No time logs found.</p>
        @endif
    </div>

</div>
<!-- End Page-content -->

@endsection