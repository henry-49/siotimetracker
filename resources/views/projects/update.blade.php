@extends('admin.admin_master')

@section('admin')

<div class="page-content">

<div class="container-fluid">

    <h1>Edit Project</h1>

    <form method="POST" action="{{ route('project.update', $project->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $project->name) }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $project->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="client">Client</label>
            <input type="text" class="form-control" id="client" name="client" value="{{ old('client', $project->client) }}">
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
</div>
@endsection