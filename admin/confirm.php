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
                            <i class="nav-icon fas fa-check-double"></i>
                            <span>ตรวจสอบการชำระเงิน</span>
                        </strong>
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row --> 
            <div class="row mb-2">
                <div class="container-fluid" id="vantable">
                    <h2>ตารางแสดงหลักฐานการชำระเงิน</h2>
                    <p>ลองพิมพ์เพื่อค้นหาสิ่งที่ท่านต้องการ เช่น วันที่, เวลา หรือเส้นทาง เป็นต้น</p>
                    <div class="col-sm-2 col-md-2">
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                    </div>
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead style="text-align: center;">
                            <tr>
                                <th>วันที่ออกเดินทาง</th>
                                <th>รอบเวลา</th>
                                <th>เส้นทาง</th>
                                <th>ราคาทั้งหมด</th>
                                <th>ชื่อผู้จอง</th>
                                <th>เบอร์ติดต่อ</th>
                                <th>สถานะ</th>
                                <th>หลักฐานการชำระเงิน</th>
                                <th>ยืนยันหลักฐาน</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php
                            $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
                            if ($conn->connect_error) {
                                die("Connection failed:" . $conn->connect_error);
                            }
                            $sql = "call sp_Confirm_GetBill()";
                            $result = $conn->query($sql);

                            if ($result != null){
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>" .
                                            "<td>" . $row["RoundDate"] . "</td>" .
                                            "<td>" . $row["DepartingTime"] . " - " . $row["ArrivingTime"] . "</td>" .
                                            "<td>" . $row["RouteName"] . "</td>" .
                                            "<td>" . $row["TotalPrice"] . " </td>" .
                                            "<td>" . $row["BookingByName"] . "</td>" .
                                            "<td>" . $row["BookingPhone"] . "</td>" .
                                            "<td>" . $row["StatusName"] . "</td>";

                                        // show preview Bill's picture
                                        if (($row["FlagUpload"] == 1 && $row["FlagConfirm"] == 1) || ($row["FlagUpload"] == 1 && $row["FlagConfirm"] != 1)){
                                            echo "<td align='center'>
                                            <a style='pointer-events: auto;' target='_blank' href='../".$row["FilePath"]."'>
                                            <button class='btn bg-yellow' style='width: 100px;'>พรีวิว</button>
                                            </a>
                                            </td>";
                                        }
                                        else {
                                            echo "<td align='center'>
                                            <a style='pointer-events: none;' target='_blank' href='../".$row["FilePath"]."'>
                                            <button class='btn bg-gray' style='width: 100px;'>พรีวิว</button>
                                            </a>
                                            </td>";
                                        }

                                        // button Approve & Reject
                                        if ($row["FlagUpload"] == 1 && $row["FlagConfirm"] != 1){
                                            echo  "<td align='center'>" .
                                            "<a style='pointer-events: auto;' 
                                            name=\"Approve\" value=\"Approve\" id=" . $row["RoundID"] . " 
                                            href='ConfirmBillForm.php?RoundDate=" . $row["RoundDate"] . "&RoundID=" . $row["RoundID"] . "&BookingBy=" . $row["BookingBy"] . "&IsConfirm=1'
                                           title=\"Approve\" /> 
                                            <i class=\"fas fa-check-circle fa-2x text-green\"></i></a>

                                            <span style=\"margin: 5px\"></span>

                                            <a style='pointer-events: auto;' 
                                            name=\"Reject\" value=\"Reject\" id=" . $row["RoundID"] . "
                                            href='ConfirmBillForm.php?RoundDate=" . $row["RoundDate"] . "&RoundID=" . $row["RoundID"] . "&BookingBy=" . $row["BookingBy"] . "&IsConfirm=0'
                                            title=\"Reject\" /> 
                                            <i class=\"fas fa-times-circle fa-2x text-red\"></i>
                                            </td>";
                                        }
                                        else {
                                            echo  "<td align=\"center\">" .
                                            "<a style='pointer-events: none;'  
                                            name=\"Approve\" value=\"Approve\" id=" . $row["RoundID"] . " href=\"#\" 
                                            title=\"Approve\" /> 
                                            <i class=\"fas fa-check-circle fa-2x text-gray\"></i></a>

                                            <span style=\"margin: 5px\"></span>

                                            <a style='pointer-events: none;'   
                                            name=\"Reject\" value=\"Reject\" id=" . $row["RoundID"] . " href=\"#\" 
                                            title=\"Reject\" /> 
                                            <i class=\"fas fa-times-circle fa-2x text-gray\"></i>
                                            </td>";
                                        }

                                        // Delete booking
                                        if ($row["FlagUpload"] == 1 && $row["FlagConfirm"] == 1){
                                            echo "<td align='center'>
                                            <a style='pointer-events: none;' 
                                            name=\"Delete\" value=\"Delete\" id=" . $row["RoundID"] ."
                                            class=\"delete_data\" title=\"Delete\"  /> 
                                            <i class=\"far fa-trash-alt text-gray fa-2x\"></i></td>";
                                        }
                                        else {
                                            echo "<td align='center'>
                                            <a style='pointer-events: auto;' 
                                            name=\"Delete\" value=\"Delete\" id=" . $row["RoundID"] . " 
                                            href='DeleteBookingForm.php?RoundDate=" . $row["RoundDate"] . "&RoundID=" . $row["RoundID"] . "&BookingBy=" . $row["BookingBy"] . "' 
                                            class=\"delete_data\" title=\"Delete\" /> 
                                            <i class=\"far fa-trash-alt text-red fa-2x\"></i></td>";
                                        }

                                        echo "</tr>";
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
<!-- ./wrapper -->

<script>
    $(document).ready(() => {
        <?php 
            if (!isset($_SESSION['UserID'])){
                echo "window.location.href = \"../_error404.php\";";
            }
            else if ($_SESSION['Role'] != 'A'){
                echo "window.location.href = \"../_error404.php\";";
            }

        ?>

        // search
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

    });
</script>

<?php include '../admin/_footer.php' ?>

</html>