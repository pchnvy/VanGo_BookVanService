<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Van GO! บริการจองที่นั่งโดยสาร</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Google Font: Kanit -->
    <link href="https://fonts.googleapis.com/css?family=Kanit:100,200,300,400,500,600,700,900" rel="stylesheet">
</head>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>


<body class="hold-transition sidebar-mini sidebar-collapse" style="font-family: 'Kanit'">

    <?php
    session_start();
    ?>

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light navbar-warning">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <?php
                if (isset($_SESSION['UserID'])) {
                    echo "<li><a class=\"nav-link\" href=\"\" style=\"color:#000;\">ยินดีต้อนรับ, คุณ " . $_SESSION['UserInfo'] . "</a></li>";
                    echo "<li><a class=\"nav-link active\" href=\"\" data-toggle=\"modal\" data-target=\"#logoutModal\" style=\"background:#000;color:#fff;\">ออกจากระบบ</a></li>";
                } else {
                    echo "<li><a class=\"nav-link active\" href=\"\" id=\"RegisterModal\" data-toggle=\"modal\" data-target=\"#registerModal\" style=\"background:#fff;color:#000;\">สมัครสมาชิก</a></li>";
                    echo "<span style=\"padding: 5px;\"></span>";
                    echo "<li><a class=\"nav-link active\" href=\"\" id=\"LoginModal\" data-toggle=\"modal\" data-target=\"#loginModal\" style=\"background:#000;color:#fff;\">เข้าสู่ระบบ</a></li>";
                }
                ?>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4 sidebar-light-warning">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link navbar-warning">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-bold">Van GO!</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <?php
                if (isset($_SESSION['UserID'])) {
                    echo "
                        <div class=\"user-panel mt-3 pb-3 mb-3 d-flex\">
                        <div class=\"image\">
                        <img src=\"dist/img/user2-160x160.jpg\" class=\"img-circle elevation-2\" alt=\"User Image\">
                        </div>
                        <div class=\"info\">
                        <a href=\"#\" class=\"d-block\">" . $_SESSION['UserInfo'] . "</a>
                        </div>
                        </div>
                        ";
                }
                ?>

                <!-- Sidebar Menu -->
                <nav id="menuBar" class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    ตารางการเดินรถ
                                </p>
                            </a>
                        </li>
                        <?php
                        if (isset($_SESSION['UserID']) && $_SESSION['Role'] != 'A') {
                            echo "
                                <li class=\"nav-item\">
                                    <a href=\"user_history.php\" class=\"nav-link\">
                                    <i class=\"nav-icon fas fa-history\"></i>
                                    <p>
                                        ประวัติการเดินรถ
                                    </p>
                                    </a>
                                </li>
                                ";
                        }
                        ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>


        <!-- Register Modal Form -->
        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" id="registerForm" autocomplete="off">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="registerModalLabel"><strong>สมัครสมาชิก</strong></h4>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="form-group clearfix">
                                    <div class="row mb-2">
                                        <div class="col-sm col-md">
                                            <label for="iName">ชื่อ</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="iName" name="iName" maxlength="60" required>
                                            </div>
                                        </div>
                                        <div class="col-sm col-md">
                                            <label for="iLastname">นามสกุล</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="iLastname" name="iLastname" maxlength="60" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="iEmail">อีเมลล์</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" id="iEmail" name="iEmail" placeholder="example@vango.com" maxlength="30" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="iPassword">รหัสผ่าน</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type="password" class="form-control" id="iPassword" name="iPassword" placeholder="รหัสผ่าน" maxlength="30" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row mb-2">
                                        <div class="col-sm col-md">
                                            <label for="iTelephone">เบอร์โทรศัพท์</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="iTelephone" name="iTelephone" pattern="[0-9]{10}" placeholder="0987654321" maxlength="30" required>
                                            </div>
                                        </div>
                                        <div class="col-sm col-md">
                                            <label for="iSex">เพศ</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                                </div>
                                                <select class="form-control" name="iSex" id="iSex" required>
                                                    <option value="ชาย">ชาย</option>
                                                    <option value="หญิง">หญิง</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="register" id="register" Value="register" class="btn btn-primary">สมัครสมาชิก</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Login Modal Form -->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" id="loginForm" autocomplete="off">
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
                                <div class="form-group">
                                    <label for="UserID">อีเมลล์</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" id="UserID" name="UserID" placeholder="example@vango.com" maxlength="30" required>
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
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="login" id="login" Value="login" class="btn btn-primary">เข้าสู่ระบบ</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Logout Modal -->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form autocomplete="off" method="post" id="logout">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">ออกจากระบบ</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <span>ท่านต้องการที่จะออกจากระบบหรือไม่?</span>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="btnlogout" id="btnlogout" Value="btnlogout" class="btn btn-primary">ตกลง</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <script>
            // toast
            // common toast
            function showerror(error) {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    body: error,
                    title: 'มีข้อผิดพลาด!',
                    subtitle: 'ปิด',
                    icon: 'fas fa-envelope fa-lg',
                })
            }

            function showsuccess(successbody) {
                $(document).Toasts('create', {
                    class: 'bg-success',
                    body: successbody,
                    title: 'สำเร็จ!',
                    subtitle: 'ปิด',
                    icon: 'fas fa-envelope fa-lg',
                })
            }


            // delete toast
            function deleteerror(error) {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    body: error,
                    title: 'ไม่สามารถลบข้อมูลได้',
                    subtitle: 'ปิด',
                    icon: 'fas fa-envelope fa-lg',
                })
            }

            function deletesuccess() {
                $(document).Toasts('create', {
                    class: 'bg-success',
                    body: 'ลบข้อมูลออกจากฐานข้อมูลแล้ว',
                    title: 'ลบข้อมูลสำเร็จแล้ว',
                    subtitle: 'ปิด',
                    icon: 'fas fa-envelope fa-lg',
                })
            }

            // insert toast
            function inserterror(error) {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    body: error,
                    title: 'ไม่สามารถเพิ่มข้อมูลได้',
                    subtitle: 'ปิด',
                    icon: 'fas fa-envelope fa-lg',
                })
            }

            function insertsuccess() {
                $(document).Toasts('create', {
                    class: 'bg-success',
                    body: 'เพิ่มข้อมูลลงฐานข้อมูลเรียบร้อยแล้ว',
                    title: 'เพิ่มข้อมูลสำเร็จ',
                    subtitle: 'ปิด',
                    icon: 'fas fa-envelope fa-lg',
                })
            }

            // update toast
            function updateerror(error) {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    body: error,
                    title: 'ไม่สามารถแก้ไขข้อมูลได้',
                    subtitle: 'ปิด',
                    icon: 'fas fa-envelope fa-lg',
                })
            }

            function updatesuccess() {
                $(document).Toasts('create', {
                    class: 'bg-success',
                    body: 'แก้ไขข้อมูลลงฐานข้อมูลเรียบร้อยแล้ว',
                    title: 'แก้ไขข้อมูลสำเร็จ',
                    subtitle: 'ปิด',
                    icon: 'fas fa-envelope fa-lg',
                })
            }

            $(function() {
                $('#menuBar a[href^="/' + location.pathname.substring(location.pathname.lastIndexOf("/") + 1) + '"]').addClass('active');
            });

            $("#RegisterModal").click(function() {
                document.getElementById("registerForm").reset();
            });

            $('#registerForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "_register.php",
                    method: "POST",
                    data: $('#registerForm').serialize(),
                    dataType: "json",
                    success: function(data) {
                        $('#registerModal').modal('hide');
                        if (data['@ErrorMsg'] != null) {
                            showerror(data['@ErrorMsg']);
                        } else {
                            showsuccess("สมัครสมาชิกเรียบร้อยแล้ว");
                        }
                    }
                });
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
                    dataType: "json",
                    success: function(data) {
                        $('#loginModal').modal('hide');
                        if (data != null) {
                            showsuccess("กำลังเข้าสู่ระบบ กรุณารอสักครู่");

                            setTimeout(() => {
                                if ($('#radioPrimary1').is(":checked")) {
                                    window.location.href = "index.php";
                                } else {
                                    window.location.href = "admin/confirm.php";
                                }
                            }, 3000);
                        } else {
                            showerror("Username หรือ Password ไม่ถูกต้อง");
                        }
                    }
                });
            });

            $('#logout').on('submit', function(event) {
                event.preventDefault();
                window.location.href = "_logout.php";
            });
        </script>