
<!doctype html>
<html lang="en">
 <head>

        <meta charset="utf-8" />
        <title>Dashboard | SIOTimetracker - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />

   @include('admin.admin_style')

    </head>

    <body data-topbar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

              <!-- Begin page -->
        <div id="layout-wrapper">

            @include('admin.body.header')


         <!-- ========== Left Sidebar Start ========== -->
           @include('admin.body.sidebar')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                @yield('admin')

            @include('admin.body.footer')
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
       @include('admin.admin_script')
    </body>

</html>
