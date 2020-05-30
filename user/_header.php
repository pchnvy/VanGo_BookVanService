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
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
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
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Google Font: Kanit -->
  <link href="https://fonts.googleapis.com/css?family=Kanit:100,200,300,400,500,600,700,900" rel="stylesheet">
</head>

<?php
$pages = array();
$pages["../admin/round.php"] = "ตารางการเดินรถ";
$pages["../admin/history.php"] = "ประวัติการเดินรถ";
$pages["../admin/van.php"] = "รถตู้/ที่นั่ง";
$pages["../admin/route.php"] = "เส้นทางการเดินรถ";
$pages["../admin/employee.php"] = "พนักงาน";

$activePage = "../admin/round.php";

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

<script>
  $(document).ready(function () {
  // Card Multi Select
  $('input[type=checkbox]').click(function () {
    if ($(this).parent().hasClass('active')) {
      $(this).parent().removeClass('active');
    }
    else
    { $(this).parent().addClass('active'); }
  });
});
  $(document).ready(function() {
    $("#loginModal").on("show", function() {
      $("body").addClass("modal-open");
    }).on("hidden", function() {
      $("body").removeClass("modal-open")
    });
  });

  $(function() {
    $('#menuBar a[href^="/' + location.pathname.substring(location.pathname.lastIndexOf("/") + 1) + '"]').addClass('active');
  });

  $("#LoginModal").click(function() {
    document.getElementById("loginForm").reset();
  });

  $('#loginForm').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
      url: "_login.php",
      method: "POST",
      data: $('#loginForm').serialize(),
      success: function(data) {
        document.getElementById("loginForm").reset();
        $('#LoginModal').modal('hide');
      }
    });
  });
</script>

<body class="hold-transition sidebar-mini sidebar-collapse" style="font-family: 'Kanit'">
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
        <li class="nav-item" href="" data-toggle="modal" data-target="#loginModal">
          <i class="fas fa-star">
            <span>สมัครสมาชิก</span>
          </i>
        </li>
        <span style="padding-left: 10px; padding-right: 10px;"> / </span>
        <li class="nav-item" href="" id="LoginModal" data-toggle="modal" data-target="#loginModal">
          <i class="fas fa-sign-in-alt">
            <span>เข้าสู่ระบบ</span>
          </i>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../user/home.php" class="brand-link">
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
              <a href="../user/home.php" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  ตารางการเดินรถ
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../user/history.php" class="nav-link">
                <i class="nav-icon fas fa-history"></i>
                <p>
                  ประวัติการเดินรถ
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Modal Form -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form method="post" id="loginForm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="loginModalLabel"><strong>ลงชื่อเข้าใช้งาน</strong></h4>
              <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <div class="form-group clearfix">
                  <div class="row mb-2">
                    <div class="col-sm-4 col-md-4 icheck-primary d-inline">
                      <input type="radio" id="radioPrimary1" name="Role" value="U" checked>
                      <label for="radioPrimary1">
                        User
                      </label>
                    </div>
                    <div class="col-sm-4 col-md-4 icheck-primary d-inline">
                      <input type="radio" id="radioPrimary2" name="Role" value="A">
                      <label for="radioPrimary2">
                        Admin
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="UserID">เบอร์โทรศัพท์</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                  </div>
                  <input type="text" class="form-control" id="UserID" name="UserID" pattern="[0-9]{10}" placeholder="0987654321" maxlength="30" required>
                </div>
              </div>
              <div class="form-group">
                <label for="Password">รหัสผ่าน</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                  </div>
                  <input type="password" class="form-control" id="Password" name="Password" placeholder="รหัสผ่าน" maxlength="30" required>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="submit" name="login" id="login" Value="login" class="btn btn-primary">เข้าสู่ระบบ</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
            </div>
          </div>
        </form>
      </div>
    </div>