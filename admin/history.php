<!DOCTYPE html>
<html>

<?php include '../admin/_header.php' ?>

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
        <!-- Search Criteria -->
        <div class="containter-fluid">
            <form autocomplete="off" method="post" id="SearchRound">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <label for="sDate">วันที่ออกเดินทาง</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <input type="date" class="form-control datetimepicker-input" name="sDate" id="sDate">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 10px;">
                        <div class="col-sm-4 col-md-4">
                            <div class="float-right" style="bottom: 0;">
                                <button id="searchBtn" type="submit" name="submit" class="btn bg-yellow" style="width: 125px;">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Search Criteria -->

        <div class="container-fluid" id="searchTimeline">
            <!-- Timelime example  -->
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
                    <div class="timeline">
                        <!-- timeline group -->
                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
                        if ($conn->connect_error) {
                            die("Connection failed:" . $conn->connect_error);
                        }

                        $roundDate = null;
                        $sql = "";
                        if (!empty($_POST)) {
                            if (isset($_POST["sDate"]) && !empty($_POST["sDate"])){
                                $sql = "call sp_HistoryAdmin(".strtotime($_POST["sDate"]).")";
                            }
                            else {
                                $sql = "call sp_HistoryAdmin(null)";
                            }
                        } else {
                            $sql = "call sp_HistoryAdmin(null)";
                        }
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
                                            echo "<i class=\"fas fa-cash-register bg-grey\"></i>";
                                        } else if ($row["RoundStatus"] == 1) {
                                            echo "<i class=\"fas fa-road bg-blue\"></i>";
                                        } else if ($row["RoundStatus"] == 2) {
                                            echo "<i class=\"fas fa-calendar-check bg-green\"></i>";
                                        }

                                        echo   "<div class=\"timeline-item\">
                                                        <h3 class=\"timeline-header\">รอบรถ <a href=\"#\">" . $row["RoundID"] . "</a>
                                                        " . $row["RoundStatusName"] . "</h3>
            
                                                            <div class=\"timeline-body\">
                                                                <h4>[" . $row["DepartingTime"] . " - " . $row["ArrivingTime"] . "] " . $row["RouteName"] . "</h4>
                                                                ยอดขายตั๋วทั้งหมด: " . $row["TotalSales"] . " บาท (ตั๋วใบละ " . $row["PricePerSeat"] . " บาท)<br />
                                                                จำนวนผู้โดยสาร: " . $row["SoldSeat"] . " <br />
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


<?php include '../admin/_footer.php' ?>

<script>
    $(document).ready(() => {

        <?php
        if (!isset($_SESSION['UserID'])) {
            echo "window.location.href = \"../_error404.php\";";
        } else if ($_SESSION['Role'] != 'A') {
            echo "window.location.href = \"../_error404.php\";";
        }
        ?>
    });
</script>

</html>