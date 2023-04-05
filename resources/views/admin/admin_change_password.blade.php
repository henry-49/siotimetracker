@extends('admin.admin_master')

@section('admin')

<div class="page-content">
    <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Change Password Page</h4> <br> <br>

                            @if(count($errors))
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger alert-dismissable fade show">{{ $error }}</p>
                                @endforeach
                            @endif

                                <form  method="POST" action="{{ route('update.password') }}">

                                    @csrf

                                    <div class="row mb-3">
                                        <label for="old_password" class="col-sm-2 col-form-label">Old Password*</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="old_password" type="password"  id="old_password">
                                        </div>
                                    </div>
                                    <!-- end row -->

                                      <div class="row mb-3">
                                        <label for="new_password" class="col-sm-2 col-form-label">New Password*</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="new_password" type="password"  id="new_password">
                                        </div>
                                    </div>
                                    <!-- end row -->

                                      <div class="row mb-3">
                                        <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password*</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="confirm_password" type="password"  id="confirm_password">
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Change Password"/>

                                    <a class="btn btn-info waves-effect waves-light" href="{{ route('admin.profile') }}" class="text-muted">Cancle</a>

                                </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

    </div>
</div>

@endsection
