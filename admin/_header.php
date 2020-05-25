<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Van GO! บริการจองที่นั่งโดยสาร</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <!-- custom css  -->
  <link rel="stylesheet" href="../plugins/style.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<?php
$pages = array();
$pages["../admin/home.php"] = "หน้าหลัก";
$pages["../admin/round.php"] = "ตารางการเดินรถ";
$pages["../admin/history.php"] = "ประวัติการเดินรถ";
$pages["../admin/van.php"] = "รถตู้/ที่นั่ง";
$pages["../admin/route.php"] = "เส้นทางการเดินรถ";
$pages["../admin/employee.php"] = "พนักงาน";

$activePage = "../admin/home.php";

?>

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<!-- <script>
  $(function() {
    $('#menuBar a[href^="/' + location.pathname.substring(location.pathname.lastIndexOf("/") + 1) + '"]').addClass('active');
  });
</script> -->

<script>
    // toast
    // delete toast
    function deleteerror(error){
        $(document).Toasts('create', {
            class: 'bg-danger', 
            body: error,
            title: 'ไม่สามารถลบข้อมูลได้',
            subtitle: 'ปิด',
            icon: 'fas fa-envelope fa-lg',
        })
    }
    function deletesuccess(){
        $(document).Toasts('create', {
            class: 'bg-success', 
            body: 'ลบข้อมูลออกจากฐานข้อมูลแล้ว',
            title: 'ลบข้อมูลสำเร็จแล้ว',
            subtitle: 'ปิด',
            icon: 'fas fa-envelope fa-lg',
        })
    }

    // insert toast
    function inserterror(error){
        $(document).Toasts('create', {
            class: 'bg-danger', 
            body: error,
            title: 'ไม่สามารถเพิ่มข้อมูลได้',
            subtitle: 'ปิด',
            icon: 'fas fa-envelope fa-lg',
        })
    }
    function insertsuccess(){
        $(document).Toasts('create', {
            class: 'bg-success', 
            body: 'เพิ่มข้อมูลลงฐานข้อมูลเรียบร้อยแล้ว',
            title: 'เพิ่มข้อมูลสำเร็จ',
            subtitle: 'ปิด',
            icon: 'fas fa-envelope fa-lg',
        })
    }

    // update toast
    function updateerror(error){
        $(document).Toasts('create', {
            class: 'bg-danger', 
            body: error,
            title: 'ไม่สามารถอัพเดทข้อมูลได้',
            subtitle: 'ปิด',
            icon: 'fas fa-envelope fa-lg',
        })
    }
    function updatesuccess(){
        $(document).Toasts('create', {
            class: 'bg-success', 
            body: 'อัพเดทข้อมูลลงฐานข้อมูลเรียบร้อยแล้ว',
            title: 'อัพเดทข้อมูลสำเร็จ',
            subtitle: 'ปิด',
            icon: 'fas fa-envelope fa-lg',
        })
    }


</script>

<body class="hold-transition sidebar-mini layout-fixed" style="font-family: 'Kanit'">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../admin/home.php" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">Van GO!</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav id="menuBar" class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-flat" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="../admin/home.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  หน้าหลัก
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../admin/round.php" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  ตารางการเดินรถ
                  <span class="right badge badge-danger">สำคัญ</span>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../admin/history.php" class="nav-link">
                <i class="nav-icon fas fa-history"></i>
                <p>
                  ประวัติการเดินรถ
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  ข้อมูลระบบ
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../admin/van.php" class="nav-link">
                    <i class="fas fa-shuttle-van nav-icon"></i>
                    <p>รถตู้/ที่นั่ง</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../admin/route.php" class="nav-link">
                    <i class="fas fa-route nav-icon"></i>
                    <p>เส้นทางการเดินรถ</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../admin/employee.php" class="nav-link">
                    <i class="fas fa-user-friends nav-icon"></i>
                    <p>พนักงาน</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>