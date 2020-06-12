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
                    <p>ลองพิมพ์เพื่อค้นหาสิ่งที่ท่านต้องการ เช่น วันที่, เวลา หรือเส้นทาง เป็นต้น</p>
                    <div class="col-sm-2 col-md-2">
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                    </div>
                    <br>
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

                            if ($result != null) {
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
            echo "window.location.href = \"admin/confirm.php\";";
        } else if ($_SESSION['Role'] != 'U') {
            echo "window.location.href = \"_error404.php\";";
        }

        ?>

    });
</script>

</html>