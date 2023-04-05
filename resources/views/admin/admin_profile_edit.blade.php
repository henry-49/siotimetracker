@extends('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit Profile Page</h4>

                                <form  method="POST" action="{{ route('store.profile') }}" enctype="multipart/form-data">

                                    @csrf

                                    <div class="row mb-3">
                                        <label for="first_name" class="col-sm-2 col-form-label">FirstName</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="first_name" type="text" value="{{ $editData->first_name }}" id="first_name">
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row mb-3">
                                        <label for="last_name" class="col-sm-2 col-form-label">LastName</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="last_name" type="text" value="{{ $editData->last_name }}" id="last_name">
                                        </div>
                                    </div>
                                    <!-- end row -->

                                      <div class="row mb-3">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="email" type="email" value="{{ $editData->email }}" id="email">
                                        </div>
                                    </div>
                                    <!-- end row -->

                                     <div class="row mb-3">
                                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="username" type="text" value="{{ $editData->username }}" id="username">
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row mb-3">
                                        <label for="profile_image" class="col-sm-2 col-form-label">Profile Image</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="profile_image" type="file"  id="profile_image">
                                        </div>
                                    </div>
                                    <!-- end row -->

                                     <div class="row mb-3">
                                        <label for="ShowImage" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                             <img id="ShowImage" class="rounded avatar-lg"
                                             src="{{ (!empty($editData->profile_image))
                                                    ? url('upload/admin_images/'.$editData->profile_image)
                                                    : url('upload/no_image.jpg') }}" alt="Card image cap">
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Profile"/>

                                    <a class="btn btn-info waves-effect waves-light" href="{{ route('admin.profile') }}" class="text-muted">Cancle</a>

                                </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('#profile_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
               $('#ShowImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection
