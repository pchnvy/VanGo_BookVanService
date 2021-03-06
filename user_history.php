<!DOCTYPE html>
<html>

<?php include '_header.php' ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <strong>
                            <i class="nav-icon fas fa-history"></i>
                            <span>ประวัติการเดินรถ</span>
                        </strong>
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Timelime example  -->
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
                    <div class="timeline">
                        <!-- timeline group -->
                        <?php
                        $inputUser = $_SESSION['UserID'];
                        $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
                        if ($conn->connect_error) {
                            die("Connection failed:" . $conn->connect_error);
                        }
                        $sql = "call sp_HistoryUser('$inputUser')";
                        $result = $conn->query($sql);

                        $round = "";
                        if ($result != null) {
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    if ($round != $row["RoundDate"]) {
                                        echo    "<div class=\"time-label\">
                                                    <span class=\"bg-yellow\">" . $row["RoundDate"] . "</span>
                                                </div>";
                                        $round = $row["RoundDate"];
                                    }
    
                                    if ($round == $row["RoundDate"]) {
                                        echo    "<div>";
                                        if ($row["RoundStatus"] == 0) {
                                            echo "<i class=\"fas fa-pause bg-red\"></i>";
                                        }
                                        else if ($row["RoundStatus"] == 1) {
                                            echo "<i class=\"fas fa-file-upload bg-black\"></i>";
                                        }
                                        else if ($row["RoundStatus"] == 2) {
                                            echo "<i class=\"fas fa-qrcode bg-green\"></i>";
                                        }
                                        else if ($row["RoundStatus"] == 3) {
                                            echo "<i class=\"fas fa-road bg-blue\"></i>";
                                        }
                                        else if ($row["RoundStatus"] == 4) {
                                            echo "<i class=\"fas fa-calendar-check bg-green\"></i>";
                                        }
    
                                        if ($row["RoundStatus"] == 1) {
                                            echo   "<div class=\"timeline-item\">
                                                    <h3 class=\"timeline-header\">รอบรถ <a href=\"#\">" . $row["RoundID"] . "</a>
                                                    " . $row["RoundStatusName"] . 
                                                    " (
                                                    <a href=\"upload.php?RoundDate=" . $row["RoundDate"] . "&RoundID=" . $row["RoundID"] . "\" 
                                                    style=\"\"><u>คลิกที่นี่เพื่อแนบหลักฐาน</u>
                                                    </a>
                                                    )
                                                    <span style='color:red'> * กรุณาอัพโหลดภายใน 2 ชั่วโมง *</span>
                                                    </h3>";
                                        }
                                        else {
                                            echo   "<div class=\"timeline-item\">
                                                    <h3 class=\"timeline-header\">รอบรถ <a href=\"#\">" . $row["RoundID"] . "</a>
                                                    " . $row["RoundStatusName"] . "</h3>";
                                        }
        
                                                    echo    "<div class=\"timeline-body\">
                                                            <h4>[" . $row["DepartingTime"] . " - " . $row["ArrivingTime"] . "] " . $row["RouteName"] . "</h4>
                                                            จำนวนที่นั่ง: " . $row["TotalSeat"] . " ที่นั่ง (" . $row["SeatName"] . ")<br />
                                                            ราคา: " . $row["TotalPrice"] . " บาท<br />
                                                            รถตู้ที่ใช้เดินทาง: " . $row["VanNumber"] . "<br />
                                                            ขับโดย: " . $row["EmployeeName"] . " (" . $row["EmployeePhone"] . ")<br />
                                                        </div>
                                                    </div>
                                                </div>";
                                    }
                                }
                            }
                        }
                        mysqli_close($conn);
                        ?>
                        <!-- END timeline group -->
                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.timeline -->

    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->


<?php include '_footer.php' ?>

<script>
    $(document).ready(() => {

        <?php 
            if (!isset($_SESSION['UserID'])){
                echo "window.location.href = \"_error404.php\";";
            }
            else if ($_SESSION['Role'] != 'U'){
                echo "window.location.href = \"_error404.php\";";
            }

        ?>
        
    });
</script>

</html>