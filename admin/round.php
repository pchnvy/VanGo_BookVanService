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
                        </br>
                        <button type="button" class="btn btn-primary" href="" id="OpenModal" data-toggle="modal" data-target="#AddRoundModal" style="background-color:dodgerblue;">เพิ่มข้อมูลรอบการเดินรถ</button>
                    </div>
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead style="text-align: center;">
                            <tr>
                                <th>วันที่</th>
                                <th>เวลาออก</th>
                                <th>เวลาถึง</th>
                                <th>เส้นทาง</th>
                                <th>ทะเบียนรถ</th>
                                <th>พนักงานขับรถ</th>
                                <th>สร้างเมื่อ</th>
                                <th>สร้างโดย</th>
                                <th>แก้ไขเมื่อ</th>
                                <th>แก้ไขโดย</th>
                                <th> </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php
                            $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
                            if ($conn->connect_error) {
                                die("Connection failed:" . $conn->connect_error);
                            }
                            $sql = "call sp_Round_GetRound()";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>" .
                                        "<td>" . $row["RoundDate"] . "</td>" .
                                        "<td>" . $row["DepartingTime"] . "</td>" .
                                        "<td>" . $row["ArrivingTime"] . "</td>" .
                                        "<td>" . $row["RouteName"] . "</td>" .
                                        "<td>" . $row["VanNumber"] . "</td>" .
                                        "<td>" . $row["EmployeeName"] . "</td>" .
                                        "<td>" . $row["CreateDate"] . "</td>" .
                                        "<td>" . $row["CreateBy"] . "</td>" .
                                        "<td>" . $row["UpdateDate"] . "</td>" .
                                        "<td>" . $row["UpdateBy"] . "</td>" .
                                        "<td align=\"center\">
                                        <a name=\"Edit\" value=\"Edit\" id=" . $row["RoundID"] . " href=\"#\" 
                                        class=\"edit_data\" title=\"Edit\" /> 
                                        <i class=\"far fa-edit\"></i></a>
                                        </td>" . "<td align=\"center\">
                                        <a name=\"Delete\" value=\"Delete\" id=" . $row["RoundID"] . " href=\"#\" 
                                        class=\"delete_data\" title=\"Delete\" /> 
                                        <i class=\"far fa-trash-alt text-red\"></i></td>" .
                                        "</tr>";
                                }
                                echo "</table>";
                            } else {
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

<!-- AddRoundModal -->
<div class="modal fade" id="AddRoundModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" method="post" id="AddRoundForm">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลรอบการเดินรถ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div id="pb-modalreglog-progressbar"></div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="RoundID" id="RoundID" />
                    </div>
                    <div class="form-group">
                        <label for="iRoundDate">วันและเวลาที่ออกเดินทาง</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <input type="datetime-local" class="form-control datetimepicker-input" name="iRoundDate" id="iRoundDate" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="iRouteID">เส้นทาง</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <select class="form-control" name="iRouteID" id="iRouteID" required>
                                <?php
                                $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
                                if ($conn->connect_error) {
                                    die("Connection failed:" . $conn->connect_error);
                                }
                                $sql = "call sp_Common_GetRouteCombo";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value=\"" . $row["RouteID"] . "\">" . $row["RouteName"] . "</option>";
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
                    <div class="form-group">
                        <label for="iVanID">รถตู้ที่ใช้เดินทาง</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <select class="form-control" name="iVanID" id="iVanID" required>
                                <?php
                                $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
                                if ($conn->connect_error) {
                                    die("Connection failed:" . $conn->connect_error);
                                }
                                $sql = "call sp_Common_GetVanCombo";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value=\"" . $row["VanID"] . "\">" . $row["VanNumber"] . "</option>";
                                    }
                                }
                                mysqli_close($conn);
                                ?>
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fas fa-shuttle-van"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="iEmployeeID">พนักงานขับรถ</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <select class="form-control" name="iEmployeeID" id="iEmployeeID" required>
                                <?php
                                $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
                                if ($conn->connect_error) {
                                    die("Connection failed:" . $conn->connect_error);
                                }
                                $sql = "call sp_Common_GetEmployeeCombo";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value=\"" . $row["EmployeeID"] . "\">" . $row["EmployeeName"] . "</option>";
                                    }
                                }
                                mysqli_close($conn);
                                ?>
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="roundInsert" id="roundInsert" Value="roundInsert" class="btn btn-primary">เพิ่มข้อมูล</button>
                    <button type="button" class="btn btn-secondary" id="closeModal" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Form -->


<!-- EditVanModal -->
<div class="modal fade" id="EditRoundModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" method="post" id="EditRoundForm">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูลรอบการเดินรถ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div id="pb-modalreglog-progressbar"></div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="uRoundID" id="uRoundID" />
                    </div>
                    <div class="form-group">
                        <label for="uRoundDate">วันและเวลาที่ออกเดินทาง</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <input type="text" class="form-control datetimepicker-input" name="uRoundDate" id="uRoundDate" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="uRouteID">เส้นทาง</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <select class="form-control" name="uRouteID" id="uRouteID" required>
                                <?php
                                $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
                                if ($conn->connect_error) {
                                    die("Connection failed:" . $conn->connect_error);
                                }
                                $sql = "call sp_Common_GetRouteCombo";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value=\"" . $row["RouteID"] . "\">" . $row["RouteName"] . "</option>";
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
                    <div class="form-group">
                        <label for="uVanID">รถตู้ที่ใช้เดินทาง</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <select class="form-control" name="uVanID" id="uVanID" required>
                                <?php
                                $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
                                if ($conn->connect_error) {
                                    die("Connection failed:" . $conn->connect_error);
                                }
                                $sql = "call sp_Common_GetVanCombo";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value=\"" . $row["VanID"] . "\">" . $row["VanNumber"] . "</option>";
                                    }
                                }
                                mysqli_close($conn);
                                ?>
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fas fa-shuttle-van"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="uEmployeeID">พนักงานขับรถ</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <select class="form-control" name="uEmployeeID" id="uEmployeeID" required>
                                <?php
                                $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
                                if ($conn->connect_error) {
                                    die("Connection failed:" . $conn->connect_error);
                                }
                                $sql = "call sp_Common_GetEmployeeCombo";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value=\"" . $row["EmployeeID"] . "\">" . $row["EmployeeName"] . "</option>";
                                    }
                                }
                                mysqli_close($conn);
                                ?>
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="roundUpdate" id="roundUpdate" Value="roundUpdate" class="btn btn-primary">แก้ไขข้อมูล</button>
                    <button type="button" class="btn btn-secondary" id="closeModalUpdate" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Form -->

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

        // ClearModal
        $('#OpenModal').click(function() {
            document.getElementById("AddRoundForm").reset();
        });

        // AddModal
        $('#AddRoundForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "AddRoundForm.php",
                method: "POST",
                data: $('#AddRoundForm').serialize(),
                dataType: "json",
                success: function(data) {
                    document.getElementById("AddRoundForm").reset();
                    $('#AddRoundModal').modal('hide');
                    if (data['@ErrorMsg'] != null) {
                        inserterror(data['@ErrorMsg']);
                    } else {
                        insertsuccess();
                    }
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
            });
        });

        // EditData
        $(document).on('click', '.edit_data', function() {
            var RoundID = $(this).attr("id");
            $.ajax({
                url: "fetchRound.php",
                method: "POST",
                data: {
                    RoundID: RoundID
                },
                dataType: "json",
                success: function(data) {
                    $('#uRoundID').val(RoundID);
                    $('#uRoundDate').val(data.RoundDate);
                    $('#uRouteID').val(data.RouteID);
                    $('#uVanID').val(data.VanID);
                    $('#uEmployeeID').val(data.EmployeeID);

                    $('#EditRoundModal').modal('show');
                }
            })
        });

        $('#EditRoundForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "EditRoundForm.php",
                method: "POST",
                data: $('#EditRoundForm').serialize(),
                dataType: "json",
                success: function(data) {
                    document.getElementById("EditRoundForm").reset();
                    $('#EditRoundModal').modal('hide');
                    if (data['@ErrorMsg'] != null) {
                        updateerror(data['@ErrorMsg']);
                    } else {
                        updatesuccess();
                    }
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
            });
        });

        // DeleteData
        $(document).on('click', '.delete_data', function() {
            var RoundID = $(this).attr("id");
            $('#dRoundID').val(RoundID);
            $('#DeleteRoundModal').modal('show');
        });

        $('#DeleteRoundForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "DeleteRoundForm.php",
                method: "POST",
                data: $('#DeleteRoundForm').serialize(),
                dataType: "json",
                success: function(data) {
                    $('#DeleteRoundModal').modal('hide');
                    if (data['@ErrorMsg'] != null) {
                        deleteerror(data['@ErrorMsg']);
                    } else {
                        deletesuccess();
                    }
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
            });
        });

    });
</script>

<?php include '../admin/_footer.php' ?>

</html>