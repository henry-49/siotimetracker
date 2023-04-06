@extends('admin.admin_master')

@section('admin')
<div class="page-content">

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Time Log') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('timelog.store') }}">
                        @csrf

                        <div class="form-group row mb-2">
                            <label for="project_id" class="col-md-4 col-form-label text-md-right">{{ __('Project') }}</label>

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

                          <div class="form-group row mb-2">
                            <label for="project_id" class="col-md-4 col-form-label text-md-right">{{ __('Task') }}</label>

                            <div class="col-md-6">
                                <select id="task_id" class="form-control @error('task_id') is-invalid @enderror" name="project_id" required>
                                    <option value="project->tasks->id">-- Select Task --</option>
                                    @foreach($project->tasks as $task)
                                    <option value="{{ $task->id }}" {{ old('task->id') == $task->id ? 'selected' : '' }}>{{ task->id }}</option>
                                    @endforeach
                                </select>

                                @error('task_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="start_time" class="col-md-4 col-form-label text-md-right">{{ __('Start Time') }}</label>

                            <div class="col-md-6">
                                <input id="start_time" type="datetime-local" class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{ old('start_time') }}" required>

                                @error('start_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="end_time" class="col-md-4 col-form-label text-md-right">{{ __('End Time') }}</label>

                            <div class="col-md-6">
                                <input id="end_time" type="datetime-local" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="{{ old('end_time') }}" required>

                                @error('end_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{ route('timelog.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
@endsection
