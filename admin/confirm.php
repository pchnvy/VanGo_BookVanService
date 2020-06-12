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
                        </br>
                        <button type="button" class="btn btn-primary" href="" id="OpenModal" data-toggle="modal" data-target="#AddRoundModal" style="background-color:dodgerblue;">เพิ่มข้อมูลรอบการเดินรถ</button>
                    </div>
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead style="text-align: center;">
                            <tr>
                                <th>วันที่ออกเดินทาง</th>
                                <th>เส้นทาง</th>
                                <th>ราคาทั้งหมด</th>
                                <th>ชื่อผู้จอง</th>
                                <th>สถานะ</th>
                                <th>หลักฐานการชำระเงิน</th>
                                <th>ยืนยันหลักฐาน</th>
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
                                            "<td>" . $row["RouteName"] . "</td>" .
                                            "<td>" . $row["TotalPrice"] . " </td>" .
                                            "<td>" . $row["BookingByName"] . "</td>" .
                                            "<td>" . $row["StatusName"] . "</td>";

                                        if (($row["FlagUpload"] == 1 && $row["FlagConfirm"] == 1) || ($row["FlagUpload"] == 1 && $row["FlagConfirm"] != 1)){
                                            echo "<td align='center'>
                                            <a target='_blank' href='../".$row["FilePath"]."'>
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

                                        if ($row["FlagUpload"] == 1 && $row["FlagConfirm"] != 1){
                                            echo  "<td align='center'>" .
                                            "<a name=\"Approve\" value=\"Approve\" id=" . $row["RoundID"] . " 
                                            href='ConfirmBillForm.php?RoundDate=" . $row["RoundDate"] . "&RoundID=" . $row["RoundID"] . "&BookingBy=" . $row["BookingBy"] . "&IsConfirm=1'
                                            class=\"edit_data\" title=\"Approve\" /> 
                                            <i class=\"fas fa-check-circle fa-2x text-green\"></i></a>

                                            <span style=\"margin: 5px\"></span>

                                            <a name=\"Reject\" value=\"Reject\" id=" . $row["RoundID"] . "
                                            href='ConfirmBillForm.php?RoundDate=" . $row["RoundDate"] . "&RoundID=" . $row["RoundID"] . "&BookingBy=" . $row["BookingBy"] . "&IsConfirm=0'
                                            class=\"delete_data\" title=\"Reject\" /> 
                                            <i class=\"fas fa-times-circle fa-2x text-red\"></i>
                                            </td>" .
                                            "</tr>";
                                        }
                                        else {
                                            echo  "<td align=\"center\">" .
                                            "<a style=\"pointer-events: none;\" 
                                            name=\"Approve\" value=\"Approve\" id=" . $row["RoundID"] . " href=\"#\" 
                                            class=\"edit_data\" title=\"Approve\" /> 
                                            <i class=\"fas fa-check-circle fa-2x text-gray\"></i></a>

                                            <span style=\"margin: 5px\"></span>

                                            <a style=\"pointer-events: none;\" 
                                            name=\"Reject\" value=\"Reject\" id=" . $row["RoundID"] . " href=\"#\" 
                                            class=\"delete_data\" title=\"Reject\" /> 
                                            <i class=\"fas fa-times-circle fa-2x text-gray\"></i>
                                            </td>" .
                                            "</tr>";
                                        }
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

<!-- DeleteRoundModal -->
<div class="modal fade" id="DeleteRoundModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" method="post" id="DeleteRoundForm">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">ลบข้อมูลรอบการเดินรถ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div id="pb-modalreglog-progressbar"></div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="dRoundID" id="dRoundID" />
                    </div>
                    <div class="form-group">
                        <label for="email">คุณต้องการที่จะลบข้อมูลรอบการเดินรถหรือไม่?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="roundDelete" id="roundDelete" Value="roundDelete" class="btn btn-primary">ยืนยัน</button>
                    <button type="button" class="btn btn-secondary" id="closeModalDelete" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>

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