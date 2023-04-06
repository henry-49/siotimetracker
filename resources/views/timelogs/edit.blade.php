@extends('admin.admin_master')

@section('admin')
<div class="page-content">
    <div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Time Log</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('timelog.update', $timelog->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row mb-2">
                                <label for="start_time" class="col-md-4 col-form-label text-md-right">Project Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled value="{{ $timelog->project->name }}">

                                    @error('start_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                             <div class="form-group row mb-2">
                                <label for="start_time" class="col-md-4 col-form-label text-md-right">Start Time</label>

                                <div class="col-md-6">
                                    <input id="start_time" type="datetime-local" class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{ Carbon\Carbon::parse($timelog->start_time)->format('Y-m-d\TH:i:s') }}" required autofocus>

                                    @error('start_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-2">
                                <label for="end_time" class="col-md-4 col-form-label text-md-right">End Time</label>

                                <div class="col-md-6">
                                    <input id="end_time" type="datetime-local" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="{{ Carbon\Carbon::parse($timelog->end_time)->format('Y-m-d\TH:i:s') }}" required>

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
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection