<!DOCTYPE html>
<html>

<?php include '_header.php' ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <strong>
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <span>ตารางการเดินรถ</span>
                        </strong>
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2">
                <div class="container-fluid" id="vantable">
                    <h2>ตารางแสดงรายละเอียดของรอบการเดินรถ</h2>
                    <p>กรุณาเลือกเส้นทางและวันเวลาที่ท่านต้องการจองที่นั่งให้ครบถ้วน</p>


                    <div class="containter-fluid">
                        <form autocomplete="off" method="post" id="SearchRound">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm col-md">
                                        <label for="sDate">วันที่ออกเดินทาง</label>
                                        <div class="input-group pb-modalreglog-input-group">
                                            <input type="date" class="form-control datetimepicker-input" name="sDate" id="sDate" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm col-md">
                                        <label for="sRouteID">เส้นทาง</label>
                                        <div class="input-group pb-modalreglog-input-group">
                                            <select class="form-control" name="sRouteID" id="sRouteID" required>
                                                <?php
                                                $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
                                                if ($conn->connect_error) {
                                                    die("Connection failed:" . $conn->connect_error);
                                                }
                                                $sql = "call sp_Common_GetRouteCombo";
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<option value=\"" . $row["RouteID"] . "\">" . $row["RouteFromTo"] . "</option>";
                                                    }
                                                }
                                                mysqli_close($conn);
                                                ?>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-route"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm col-md">
                                    <label for="sTime">รอบเวลา</label>
                                        <div class="input-group pb-modalreglog-input-group">
                                            <select class="form-control" name="sTime" id="sTime" required>
                                                <?php
                                                $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
                                                if ($conn->connect_error) {
                                                    die("Connection failed:" . $conn->connect_error);
                                                }
                                                $sql = "call sp_Common_GetRouteCombo";
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<option value=\"" . $row["RouteID"] . "\">" . $row["RouteFromTo"] . "</option>";
                                                    }
                                                }
                                                mysqli_close($conn);
                                                ?>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="float-right d-none d-sm-inline-block">
                                <button type="submit" class="btn bg-maroon" style="padding-left: 50px; padding-right: 50px;">ค้นหา</button>
                            </div>
                        </form>
                    </div>

                    <br/>
                    <table class="table table-bordered table-striped">
                        <thead style="text-align: center;">
                            <tr>
                                <th>วันที่</th>
                                <th>เวลาออก</th>
                                <th>เวลาถึง</th>
                                <th>เส้นทาง</th>
                                <th>ราคา</th>
                                <th>ทะเบียนรถ</th>
                                <th>พนักงานขับรถ</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php
                            $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
                            if ($conn->connect_error) {
                                die("Connection failed:" . $conn->connect_error);
                            }
                            $sql = "call sp_Booking_GetUserRound()";
                            $result = $conn->query($sql);

                            if($result != null){
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>" .
                                            "<td>" . $row["RoundDate"] . "</td>" .
                                            "<td>" . $row["DepartingTime"] . "</td>" .
                                            "<td>" . $row["ArrivingTime"] . "</td>" .
                                            "<td>" . $row["RouteName"] . "</td>" .
                                            "<td>" . $row["Price"] . "</td>" .
                                            "<td>" . $row["VanNumber"] . "</td>" .
                                            "<td>" . $row["EmployeeName"] . "</td>" .
                                            "<td align=\"center\">
                                            <a name=\"Booking\" value=\"Booking\" href=\"user_booking.php?RoundID=" . $row["RoundID"] . "\" 
                                            class=\"booking_data\" title=\"Booking\" /> 
                                            <i class=\"fas fa-cart-plus fa-2x\"></i></a>
                                            </td>" .
                                            "</tr>";
                                    }
                                    echo "</table>";
                                }
                            }
                            else {
                                echo "0 result.";
                            }
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                    <p>Note : .</p>
                </div>
            </div><!-- /.container-fluid -->




        </div>
    </div>
    <!-- /.content-header -->
</div>

<?php include '_footer.php' ?>

<script>
    $(document).ready(() => {

        <?php

        if ($_SESSION['Role'] == 'A') {
            echo "window.location.href = \"admin/round.php\";";
        } else if ($_SESSION['Role'] != 'U') {
            echo "window.location.href = \"_error404.php\";";
        }

        ?>

    });
</script>

</html>