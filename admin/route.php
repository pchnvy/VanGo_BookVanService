<!DOCTYPE html>
<html>

<?php include '../admin/_header.php' ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <strong>
                            <i class="nav-icon fas fa-route"></i>
                            <span style="font-family:'Kanit'">เส้นทางการเดินรถ</span>
                        </strong>
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2">
                <div class="container-fluid" id="route">
                    <h2>ตารางแสดงรายละเอียดเส้นทางการเดินรถ</h2>
                    <p>ลองพิมพ์เพื่อค้นหาสิ่งที่ท่านต้องการ เช่น ชื่อเส้นทาง, จุดเริ่มต้น หรือปลายทาง เป็นต้น</p>
                    <div class="col-sm-2 col-md-2">
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                        </br>
                        <button type="button" class="btn btn-primary" href="" id="OpenModal" data-toggle="modal" data-target="#AddRouteModal" style="background-color:dodgerblue;">เพิ่มข้อมูลเส้นทาง</button>
                    </div>
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead style="text-align: center;">
                            <tr>
                                <th>รหัสเส้นทาง</th>
                                <th>ชื่อเส้นทาง</th>
                                <th>จุดเริ่มต้น</th>
                                <th>จุดปลายทาง</th>
                                <th>ระยะเวลา</th>
                                <th>ราคา</th>
                                <th>รายละเอียดการเดินทาง</th>
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
                            $sql = "call sp_Route_Getroute";
                            $result = $conn->query($sql);

                            if ($result != null) {
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>" .
                                            "<td>" . $row["RouteID"] . "</td>" .
                                            "<td>" . $row["Name"] . "</td>" .
                                            "<td>" . $row["Begin"] . "</td>" .
                                            "<td>" . $row["Destination"] . "</td>" .
                                            "<td>" . $row["Usagetime"] . " นาที</td>" .
                                            "<td>" . $row["Price"] . " บาท</td>" .
                                            "<td>" . $row["Description"] . "</td>" .
                                            "<td>" . $row["CreateDate"] . "</td>" .
                                            "<td>" . $row["CreateBy"] . "</td>" .
                                            "<td>" . $row["UpdateDate"] . "</td>" .
                                            "<td>" . $row["UpdateBy"] . "</td>" .
                                            "<td align=\"center\">
                                            <a name=\"Edit\" value=\"Edit\" id=" . $row["RouteID"] . " href=\"#\" 
                                            class=\"edit_data\" title=\"Edit\" /> 
                                            <i class=\"far fa-edit\"></i></a>
                                            </td>" . "<td align=\"center\">
                                            <a name=\"Delete\" value=\"Delete\" id=" . $row["RouteID"] . " href=\"#\" 
                                            class=\"delete_data\" title=\"Delete\" /> 
                                            <i class=\"far fa-trash-alt text-red\"></i></td>" .
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
</div>
<!-- ./wrapper -->


<!-- AddRouteModal -->
<div class="modal fade" id="AddRouteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" method="post" id="AddRouteForm">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลเส้นทางการเดินรถ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div id="pb-modalreglog-progressbar"></div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="RouteID" id="RouteID" />
                    </div>
                    <div class="form-group">
                        <label for="iName">ชื่อเส้นทาง</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" class="form-control" name="iName" id="iName" placeholder="ชื่อเส้นทางการเดินรถ" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm">
                                <label for="iBegin">จุดเริ่มต้น</label>
                                <div class="input-group pb-modalreglog-input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <!-- <input type="text" class="form-control" name="inputFuel" id="inputFuel" placeholder="eg. E20 GASOLINE95" required> -->
                                    <select class="form-control" name="iBegin" id="iBegin" required>
                                        <option>บางแสน</option>
                                        <option>กรุงเทพฯ</option>
                                        <option>พัทยา</option>
                                        <option>ศรีราชา</option>
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm">
                                <label for="iDestination">จุดปลายทาง</label>
                                <div class="input-group pb-modalreglog-input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <!-- <input type="text" class="form-control" name="inputFuel" id="inputFuel" placeholder="eg. E20 GASOLINE95" required> -->
                                    <select class="form-control" name="iDestination" id="iDestination" required>
                                        <option>บางแสน</option>
                                        <option>กรุงเทพฯ</option>
                                        <option>พัทยา</option>
                                        <option>ศรีราชา</option>
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="iUsagetime">เวลาที่ใช้ในการเดินทาง</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="number" class="form-control" name="iUsagetime" id="iUsagetime" placeholder="หน่วยเป็นนาทีเช่น 60 นาที , 120 ,90" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="iPrice">ราคา</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="number" class="form-control" name="iPrice" id="iPrice" placeholder="เช่น 140.00,240.00" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="iDescription">รายละเอียดการเดินทาง</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="text" class="form-control" name="iDescription" id="iDescription" placeholder="เช่น จุดจอดรถระหว่างทาง" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="vanInsert" id="RouteInsert" Value="RouteInsert" class="btn btn-primary">เพิ่มข้อมูล</button>
                    <button type="button" class="btn btn-secondary" id="closeInsertModal" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Form -->


<!-- EditRouteModal -->
<div class="modal fade" id="EditRouteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" method="post" id="EditRouteForm">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูลเส้นทางการเดินรถ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div id="pb-modalreglog-progressbar"></div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="uRouteID" id="uRouteID" />
                    </div>
                    <div class="form-group">
                        <label for="uName">ชื่อเส้นทาง</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" class="form-control" name="uName" id="uName" placeholder="ชื่อเส้นทางการเดินรถ" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm">
                                <label for="uBegin">จุดเริ่มต้น</label>
                                <div class="input-group pb-modalreglog-input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <!-- <input type="text" class="form-control" name="inputFuel" id="inputFuel" placeholder="eg. E20 GASOLINE95" required> -->
                                    <select class="form-control" name="uBegin" id="uBegin" required>
                                        <option>บางแสน</option>
                                        <option>กรุงเทพฯ</option>
                                        <option>พัทยา</option>
                                        <option>ศรีราชา</option>
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm">
                                <label for="uDestination">จุดปลายทาง</label>
                                <div class="input-group pb-modalreglog-input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <!-- <input type="text" class="form-control" name="inputFuel" id="inputFuel" placeholder="eg. E20 GASOLINE95" required> -->
                                    <select class="form-control" name="uDestination" id="uDestination" required>
                                        <option>บางแสน</option>
                                        <option>กรุงเทพฯ</option>
                                        <option>พัทยา</option>
                                        <option>ศรีราชา</option>
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="uUsagetime">เวลาที่ใช้ในการเดินทาง</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="number" class="form-control" name="uUsagetime" id="uUsagetime" placeholder="หน่วยเป็นนาทีเช่น 60 นาที , 120 ,90" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="uPrice">ราคา</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="number" class="form-control" name="uPrice" id="uPrice" placeholder="เช่น 140.00,240.00" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="uDescription">รายละเอียดการเดินทาง</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="text" class="form-control" name="uDescription" id="uDescription" placeholder="เช่น จุดจอดรถระหว่างทาง" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="vanInsert" id="RouteUpdate" Value="RouteUpdate" class="btn btn-primary">แก้ไขข้อมูล</button>
                    <button type="button" class="btn btn-secondary" id="closeEditModal" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Form -->

<!-- DeleteRouteModal -->
<div class="modal fade" id="DeleteRouteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" method="post" id="DeleteRouteForm">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">ลบข้อมูลเส้นทางการเดินรถ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div id="pb-modalreglog-progressbar"></div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="DeleteRouteID" id="DeleteRouteID" />
                    </div>
                    <div class="form-group">
                        <label for="email">คุณต้องการที่จะลบข้อมูลเส้นทางการเดินรถหรือไม่?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="DeleteRoute" id="DeleteRoute" class="btn btn-primary">ยืนยัน</button>
                    <button type="button" class="btn btn-secondary" id="closeModalDelete" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../plugins/toastr/toastr.min.js"></script>


<script>
    $(document).ready(() => {
        <?php
        if (!isset($_SESSION['UserID'])) {
            echo "window.location.href = \"../_error404.php\";";
        } else if ($_SESSION['Role'] != 'A') {
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
            document.getElementById("AddRouteForm").reset();
        });

        // AddModal
        $('#AddRouteForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "AddRouteForm.php",
                method: "POST",
                data: $('#AddRouteForm').serialize(),
                dataType: "json",
                success: function(data) {
                    document.getElementById("AddRouteForm").reset();
                    $('#AddRouteModal').modal('hide');
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
            var RouteID = $(this).attr("id");
            $.ajax({
                url: "fetchRoute.php",
                method: "POST",
                data: {
                    RouteID: RouteID
                },
                dataType: "json",
                success: function(data) {
                    $('#uRouteID').val(RouteID);
                    $('#uName').val(data.Name);
                    // $('#updateinputFuel').children("option:selected").val(data.Fueltype);
                    document.getElementById("uBegin").value = data.Begin;
                    document.getElementById("uDestination").value = data.Destination;
                    // $('#uName').val(data.Name);
                    $('#uUsagetime').val(data.Usagetime);
                    $('#uPrice').val(data.Price);
                    $('#uDescription').val(data.Description);
                    $('#EditRouteModal').modal('show');
                }
            })
        });

        $('#EditRouteForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "EditRouteForm.php",
                method: "POST",
                data: $('#EditRouteForm').serialize(),
                dataType: "json",
                success: function(data) {
                    document.getElementById("EditRouteForm").reset();
                    $('#EditRouteModal').modal('hide');
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
            var RouteID = $(this).attr("id");
            $('#DeleteRouteID').val(RouteID);
            $('#DeleteRouteModal').modal('show');
        });

        $('#DeleteRouteForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "DeleteRouteForm.php",
                method: "POST",
                data: $('#DeleteRouteForm').serialize(),
                dataType: "json",
                success: function(data) {
                    $('#DeleteRouteModal').modal('hide');
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