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
                    <!-- <p>กรุณาเลือกวันที่ออกเดินทางที่ท่านต้องการ</p> -->
                    <br />
                    <div class="containter-fluid">
                        <form autocomplete="off" method="post" id="SearchRound">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4 col-md-4">
                                        <label for="sDate">วันที่ออกเดินทาง <span style="color: red">*</span></label>
                                        <div class="input-group pb-modalreglog-input-group">
                                            <input type="date" class="form-control datetimepicker-input" name="sDate" id="sDate" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-md-4">
                                        <label for="sRouteID">เส้นทาง</label>
                                        <div class="input-group pb-modalreglog-input-group">
                                            <select class="form-control" name="sRouteID" id="sRouteID">
                                                <option value="">-- กรุณาเลือกเส้นทางที่ต้องการ --</option>
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
                                </div>
                                <div class="row" style="margin: 10px;">
                                    <div class="col-sm-8 col-md-8">
                                        <div class="float-right" style="bottom: 0;">
                                            <button id="searchBtn" type="submit" name="submit" class="btn bg-yellow" style="width: 125px;">ค้นหา</button>
                                            <span style="margin: 5px" ;></span>
                                            <button id="clearBtn" class="btn bg-yellow" style="width: 125px;">ล้างข้อมูล</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <br>
                    <table class="table table-bordered table-striped">
                        <thead style="text-align: center;">
                            <tr>
                                <th>เส้นทาง</th>
                                <th>เวลาออก</th>
                                <th>เวลาถึง</th>
                                <th>ราคา</th>
                                <th>ทะเบียนรถ</th>
                                <th>พนักงานขับรถ</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody id="searchTable">
                            <?php
                            $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
                            if ($conn->connect_error) {
                                die("Connection failed:" . $conn->connect_error);
                            }

                            if (!empty($_POST)) {
                                echo "<alert>" . $_POST["sRouteID"] . "</alert>";
                                $routeID = null;
                                $sql = "";
                                if (isset($_POST['sRouteID'])) {
                                    $routeID = mysqli_real_escape_string($conn, $_POST["sRouteID"]);
                                    $sql = "call sp_Booking_GetUserRound('$routeID')";
                                } else {
                                    $sql = "call sp_Booking_GetUserRound(null)";
                                }
                                $result = $conn->query($sql);

                                if ($result != null) {
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>" .
                                                "<td>" . $row["RouteName"] . "</td>" .
                                                "<td>" . $row["DepartingTime"] . "</td>" .
                                                "<td>" . $row["ArrivingTime"] . "</td>" .
                                                "<td>" . $row["Price"] . "</td>" .
                                                "<td>" . $row["VanNumber"] . "</td>" .
                                                "<td>" . $row["EmployeeName"] . "</td>" .
                                                "<td align=\"center\">
                                                        <a name=\"Booking\" value=\"Booking\" href=\"user_booking.php?RoundDate=" . $_POST['sDate'] . "&RoundID=" . $row["RoundID"] . "\" 
                                                        class=\"booking_data\" title=\"Booking\" /> 
                                                        <i class=\"fas fa-cart-plus fa-2x\"></i></a>
                                                        </td>" .
                                                "</tr>";
                                        }
                                        echo "</table>";
                                    }
                                } else {
                                    echo "0 result.";
                                }
                            }

                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                    <p>Note : กรุณาเลือกวันที่ออกเดินทางที่ท่านต้องการ ก่อนทำการค้นหารอบการเดินรถ</p>
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

        if (!empty($_SESSION)) {
            if ($_SESSION['Role'] == 'A') {
                echo "window.location.href = \"admin/confirm.php\";";
            } else if ($_SESSION['Role'] != 'U') {
                echo "window.location.href = \"_error404.php\";";
            }
        }

        // if click Search button
        if (!empty($_POST)) {
            if (isset($_POST['sDate'])) {
                echo "$('#sDate').val(\"" . $_POST['sDate'] . "\");";
            }
            if (isset($_POST['sRouteID'])) {
                echo "$('#sRouteID').val(\"" . $_POST['sRouteID'] . "\");";
            }
        }

        ?>
    });

    $("#searchBtn").on("click", function() {
        $("#searchTable").load("index.php #searchTable");
        if ($('#sDate').val() == "" || $('#sDate').val() == null) {
            $('#searchTable').hide();
        } 
        else if ( new Date($('#sDate').val()) < new Date() ) {
            $('#searchTable').hide();
        } 
        else {
            $('#searchTable').show();
        }
    });

    $("#clearBtn").on("click", function() {
        $('#sDate').val("");
        $('#sRouteID').val("");
        $('#searchTable').hide();
    });
</script>

</html>