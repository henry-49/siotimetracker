@extends('admin.admin_master')

@section('admin')
<div class="page-content">
    <div class="container-fluid">

<div class="container">
    <div class="card mb-3">
        <div class="card-header">
            <h3>Projects</h3>
            <a href="{{ route('project.create') }}" class="btn btn-primary float-right">Create Project</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                    <tr>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->description }}</td>
                           <td>
                            <div class="d-flex">
                                <a href="#" class="btn btn-success mr-2">View</a>
                                <a href="{{ route('project.edit', $project->id) }}" class="btn btn-primary mr-2">Edit</a>
                                <form action="{{ route('project.delete', $project->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">No projects found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection