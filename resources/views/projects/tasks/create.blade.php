@extends('admin.admin_master')

@section('admin')
<div class="page-content">
    <div class="container-fluid">
<div class="container">
    <div class="card mb-3">
        <div class="card-header">

        <div class="col-md-6">
                <select id="project_id" class="form-control @error('project_id') is-invalid @enderror" name="project_id" required>
                    <option value="">-- Select Project --</option>
                    @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                    @endforeach
                </select>

                @error('project_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('projects.tasks.store', $project) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
             <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" class="form-control" name="due_date" id="due_date">
            </div>
                <button type="submit" class="btn btn-primary">Add Task</button>
            </form>
        </div>
    </div>
</div>
@endsection