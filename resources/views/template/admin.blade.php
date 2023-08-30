<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->

  <!-- data tables -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light align-middle">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
      <div class="dropdown pa-0">
        <img src="dist/img/user2-160x160.jpg" width="40" class="img-fluid img-circle elevation-2" alt="User Image">
        <a class="" data-toggle="dropdown" href="#">
          <i class="fa fa-angle-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" >
        @auth

          <div class="d-flex align-items-center p-2">
            <div class="image">
              <img src="dist/img/user2-160x160.jpg" width="40" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info pl-2">
              <span>{{auth()->user()->name}}</span>
            </div>
          </div>

          <li class="nav-item">
            <a class="nav-link" href="">
              Ganti Password
              <!-- <i class="fas fa-th-large"></i> -->
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout.perform') }}">
                <i class="fas fa-power-off pr-2"></i>
                Keluar
            </a>
          </li>
        </div>
        @endauth
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li> -->
      </div>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">

      <div class="brand-text font-weight-light"><img src="{{ asset('dist/img/logo.jpeg') }}" alt="" class="brand-image"
           style="opacity: .8"> UD. ILHAMPILLY</div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar py-3">
      <!-- Sidebar user panel (optional) -->


      <!-- Sidebar Menu -->
      <nav>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active':'' }}">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Dashboard
              </p>
            </a>

          </li>
          @auth

          <li class="nav-item has-treeview">
            <a href="{{ route('item') }}" class="nav-link {{ request()->is('barang') ? 'active':'' }}">
              <i class="nav-icon fa fa-box"></i>
              <p>
                Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('itemIn') }}" class="nav-link {{ request()->is('barangMasuk') ? 'active':'' }}">
              <i class="nav-icon fa fa-dolly"></i>
              <p>
                Barang Masuk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('itemOut') }}" class="nav-link {{ request()->is('barangKeluar') ? 'active':'' }}">
              <i class="nav-icon fa fa-box-open"></i>
              <p>
                Barang Keluar
              </p>
            </a>
          </li>
          @role('admin')
          <li class="nav-item">
            <a href="{{ route('supplier') }}" class="nav-link {{ request()->is('supplier') ? 'active':'' }}">
              <i class="nav-icon fa fa-truck"></i>
              <p>
                Supplier
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('operator') }}" class="nav-link {{ request()->is('operator') ? 'active':'' }}">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Operator
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('customer') }}" class="nav-link {{ request()->is('pelanggan') ? 'active':'' }}">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Pelanggan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('report') }}" class="nav-link {{ request()->is('laporan') ? 'active':'' }}">
              <i class="nav-icon fa fa-file"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('transaction') }}" class="nav-link {{ request()->is('transaction') ? 'active':'' }}">
              <i class="nav-icon fa fa-chart-line"></i>
              <p>
                Transaksi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('fifo') }}" class="nav-link {{ request()->is('fifo') ? 'active':'' }}">
              <!-- <i class="nav-icon fa fa-chart-line"></i> -->
              <p>
                Hasil FIFO
              </p>
            </a>
          </li>
          </li>
          <li class="nav-item">
            <a href="{{ url('fefo') }}" class="nav-link {{ request()->is('fefo') ? 'active':'' }}">
              <!-- <i class="nav-icon fa fa-chart-line"></i> -->
              <p>
                Hasil FEFO
              </p>
            </a>
          </li>
          @endrole


        @endauth
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <!-- <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('breadcrumb-title')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">@yield('breadcrumb-item')</li>
            </ol>
          </div>
        </div> -->
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            @yield('content')
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="http://adminlte.io">UD. ILHAMPILLY</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- <script src="plugins/jquery-ui/jquery-ui.min.js"></script> -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!-- <script src="plugins/chart.js/Chart.min.js"></script> -->
<!-- Sparkline -->
<!-- <script src="plugins/sparklines/sparkline.js"></script> -->
<!-- JQVMap -->
<!-- <script src="plugins/jqvmap/jquery.vmap.min.js"></script> -->
<!-- <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="plugins/jquery-knob/jquery.knob.min.js"></script> -->
<!-- daterangepicker -->
<!-- <script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script> -->
<!-- Tempusdominus Bootstrap 4 -->
<!-- <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->
<!-- Summernote -->
<!-- <script src="plugins/summernote/summernote-bs4.min.js"></script> -->
<!-- overlayScrollbars -->
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/app.js"></script>
@yield('script')

</body>
</html>
