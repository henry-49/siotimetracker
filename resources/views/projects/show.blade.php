@extends('admin.admin_master')

@section('admin')
<div class="page-content">
    <div class="container-fluid">
        
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>{{ $project->name }}</h3>
        </div>
        <div class="card-body">
            <p>{{ $project->description }}</p>
            <hr>
            <h4>Tasks</h4>
            <ul>
                @forelse($project->tasks as $task)
                <li>{{ $task->name }} - {{ $task->description }}</li>
                @empty
                <li>No tasks found.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection