<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ URL::asset('/assets/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ URL::asset('/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/assets/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/assets/plugins/daterangepicker/daterangepicker.css')}}">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Laravel-Vue</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
          <a href="#" class="d-block">{{Auth::user()->email}}</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <li class="nav-item">
          <router-link class="nav-link" to="/dashboard" active-class="active" exact>
            <i class="nav-icon fas fa-tachometer-alt text-teal"></i>
              <p>
                Dashboard
              </p>
            </router-link>
          </li>
          
        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cog text-green"></i>
              <p>
                Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <router-link class="nav-link" to="/users" active-class="active" exact>
                  <i class="fas fa-users nav-icon"></i>
                  <p>Users</p>
              </router-link>
              </li>
            </ul>
          </li>
           
            <li class="nav-item">
            <router-link to="/profile" class="nav-link" active-class="active" exact>
              <i class="nav-icon fas fa-user text-orange"></i>
              <p>
                Profile
              </p>
            </router-link>
          </li>

          <li class="nav-item">
            <router-link to="/developer" class="nav-link" active-class="active" exact>
              <i class="nav-icon fas fa-user text-orange"></i>
              <p>
                Developer
              </p>
            </router-link>
          </li>

          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
             <i class="nav-icon fas fa-power-off text-red"></i>
              <p>
                Logout
              </p>                         
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            </form>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    </aside>
    @yield('content')
    <!-- /.content -->
  </div>
    </div>
<!-- jQuery -->
<script src="{{ URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/sparklines/sparkline.js')}}"></script>

<script src="{{ URL::asset('assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/adminlte.js')}}"></script>
<script src="{{ URL::asset('assets/js/demo.js')}}"></script>
<script src="{{ URL::asset('assets/js/pages/dashboard.js')}}"></script>
<script src="{{mix('js/app.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
</body>
</html>    