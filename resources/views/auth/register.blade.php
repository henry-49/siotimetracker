<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Register | Gurutechsecurity - Admin & Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />

       @include('admin.admin_style')

    </head>

    <body class="auth-body-bg">
        <div class="bg-overlay"></div>
        <div class="wrapper-page">
            <div class="container-fluid p-0">
                <div class="card">
                    <div class="card-body">

                        <div class="text-center mt-4">
                            <div class="mb-3">
                                <a href="index.html" class="auth-logo">
                                   <img src="{{ asset('backend/assets/images/logo.png') }}" height="30" class="logo-dark mx-auto" alt="">
                                    <img src="{{ asset('backend/assets/images/logo-light.png') }}" height="30" class="logo-light mx-auto" alt="">
                                </a>
                            </div>
                        </div>

                        <h4 class="text-muted text-center font-size-18"><b>Register</b></h4>

                        <div class="p-3">
                            <form class="form-horizontal mt-3" method="POST" action="{{ route('register') }}">

                                 @csrf

                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input id="first_name" class="form-control" name="first_name" type="text" required placeholder="FirstName">
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input id="last_name" class="form-control" name="last_name" type="text" required placeholder="LastName">
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input id="username" class="form-control" name="username" type="text" required placeholder="Username">
                                    </div>
                                </div>

                                 <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input id="email" class="form-control" name="email" type="email" required placeholder="Email">
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input id="password" class="form-control" type="password" name="password" required placeholder="Password">
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required placeholder="Confirm Password">
                                    </div>
                                </div>

                                <div class="form-group text-center row mt-3 pt-1">
                                    <div class="col-12">
                                        <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Register</button>
                                    </div>
                                </div>

                                <div class="form-group mt-2 mb-0 row">
                                    <div class="col-12 mt-3 text-center">
                                        <a href="{{ route('login') }}" class="text-muted">Already have account?</a>
                                    </div>
                                </div>
                            </form>
                            <!-- end form -->
                        </div>
                    </div>
                    <!-- end cardbody -->
                </div>
                <!-- end card -->
            </div>
            <!-- end container -->
        </div>
        <!-- end -->


        <!-- JAVASCRIPT -->
        @include('admin.admin_script')

    </body>
</html>
