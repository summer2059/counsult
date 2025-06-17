<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, nofollow">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" href="#" type="image/x-icon">
    <!-- Google font-->
    @include('dashboard.layouts.partials.styles')
    <style>
        .logo_img{
            width: 45px;
        }
        .logo_icon{
            width: 32px;
        }
    </style>
    @stack('css')
  </head>
  <body>
    @include('sweetalert::alert')
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper StartMy Currencies-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <div class="page-header row">
        <div class="header-logo-wrapper col-auto">
          <div class="logo-wrapper"><a href="#"><img class="img-fluid for-light" src="" alt=""><img class="img-fluid for-dark" src="" alt=""></a></div>
        </div>
        <div class="col-4 col-xl-4 page-title">
          <h4 class="f-w-700"> Admin Dashboard</h4>

        </div>
        <!-- Page Header Start-->
        @include('dashboard.layouts.partials.header')
        <!-- Page Header Ends  -->
      </div>
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        @include('dashboard.layouts.partials.sidebar')
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid dashboard-4">
            <div class="row">
                @yield('content')
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        @include('dashboard.layouts.partials.footer')
      </div>
    </div>
    @include('dashboard.layouts.partials.scripts')
    @stack('js')
  </body>
</html>
