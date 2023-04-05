@extends('admin.admin_master')

@section('admin')
<div class="page-content">
    <div class="container-fluid">
        
<div class="container">
    <div class="card mb-3">
        <div class="card-header">
            <h3>Edit Task</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('projects.tasks.update', [$project, $task]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $task->name) }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $task->description) }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="start_time">Start Time</label>
                    <input type="datetime-local" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time', $task->start_time ? $task->start_time->format('Y-m-d\TH:i') : '') }}">
                    @error('start_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="end_time">End Time</label>
                    <input type="datetime-local" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ old('end_time', $task->end_time ? $task->end_time->format('Y-m-d\TH:i') : '') }}">
                    @error('end_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Task</button>
            </form>
        </div>
    </div>
</div>
@endsection