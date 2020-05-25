<?php include '../admin/_header.php' ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <strong>
                            <i class="nav-icon fas fa-user-friends"></i>
                            <span style="font-family:'Kanit'">พนักงาน</span>
                        </strong>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../admin/home.php">หน้าหลัก</a></li>
                        <li class="breadcrumb-item active">พนักงาน</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2">
                <div class="container-fluid" id="employee">
                    <h2>ตารางแสดงรายละเอียดของพนักงาน</h2>
                    <p>ลองพิมพ์เพื่อค้นหาสิ่งที่ท่านต้องการ เช่น ชื่อ,นามสกุล หรืออายุ เป็นต้น</p>
                    <div class="col-sm-2 col-md-2">
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                        </br>
                        <button type="button" class="btn btn-primary" href="" id="OpenModal" data-toggle="modal" data-target="#AddEmployeeModal" style="background-color:dodgerblue;">เพิ่มข้อมูลพนักงาน</button>
                    </div>
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>LastName</th>
                                <th>Email</th>
                                <th>Sex</th>
                                <th>Telephone</th>
                                <th>Birthdate</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php
                            $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
                            if ($conn->connect_error) {
                                die("Connection failed:" . $conn->connect_error);
                            }
                            $sql = "call sp_Employee_GetEmployee";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>" .
                                        "<td>" . $row["EmployeeID"] . "</td>" .
                                        "<td>" . $row["Name"] . "</td>" .
                                        "<td>" . $row["LastName"] . "</td>" .
                                        "<td>" . $row["Email"] . "</td>" .
                                        "<td>" . $row["Sex"] . "</td>" .
                                        "<td>" . $row["Telephone"] . "</td>" .
                                        "<td>" . $row["Birthdate"] . "</td>" .
                                        "<td align=\"center\">";
                                    if ($row["FlagDelete"] == 0) {
                                        echo "<i class=\"fas fa-circle\" style=\"color:Green\"></i>";
                                    } else {
                                        echo "<i class=\"fas fa-circle\" style=\"color:Red\"></i>";
                                    };
                                    echo "</td>" .
                                        "<td align=\"center\">
                                        <a name=\"Edit\" value=\"Edit\" id=" . $row["EmployeeID"] . " href=\"#\" class=\"edit_data\" /> 
                                        <i class=\"far fa-edit\"></i></a>
                                        </td></tr>";
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
</div>
<!-- ./wrapper -->


<!-- AddEmployeeModal -->
<div class="modal fade" id="AddEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" method="post" id="AddEmployeeForm">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลพนักงาน</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div id="pb-modalreglog-progressbar"></div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="EmployeeID" id="EmployeeID" />
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm">
                                <label for="iName">ชื่อพนักงาน</label>
                                <div class="input-group pb-modalreglog-input-group">
                                    <input type="text" class="form-control" name="iName" id="iName" placeholder="ชื่อ" required>
                                </div>
                            </div>
                            <div class="col-sm">
                                <label for="iLastName">นามสกุลพนักงาน</label>
                                <div class="input-group pb-modalreglog-input-group">
                                    <input type="text" class="form-control" name="iLastName" id="iLastName" placeholder="นามสกุล" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="iEmail">อีเมลล์</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <input type="email" class="form-control" id="iEmail" name="iEmail" placeholder="อีเมลล์" maxlength="30" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="iPassword">รหัสผ่าน</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <input type="password" class="form-control" name="iPassword" id="iPassword" placeholder="รหัสผ่านสำหรับเข้าระบบ" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="iSex">เพศ</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <select class="form-control" name="iSex" id="iSex" required>
                                    <option>ชาย</option>
                                    <option>หญิง</option>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="iTelephone">เบอร์โทรศัพท์</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <input type="text" class="form-control" name="iTelephone" id="iTelephone" pattern="[0-9]{10}" placeholder="0987654321" maxlength="30" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-sm">
                                <label for="iBirthdate">วันเกิด</label>
                                <div class="input-group pb-modalreglog-input-group">
                                    <input type="date" class="form-control datetimepicker-input" name="iBirthdate" id="iBirthdate" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <label for="iStatus">สถานะการทำงาน</label>
                                <div class="input-group pb-modalreglog-input-group">
                                    <input type="text" class="form-control" name="iLastName" id="iLastName" placeholder="นามสกุล" required>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="iBirthdate">วันเกิด</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <input type="date" class="form-control datetimepicker-input" name="iBirthdate" id="iBirthdate" required>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="EmployeeInsert" id="EmployeeInsert" Value="EmployeeInsert" class="btn btn-primary">เพิ่มข้อมูล</button>
                        <button type="button" class="btn btn-secondary" id="closeInsertModal" data-dismiss="modal">ยกเลิก</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Form -->


<!-- EditVanModal -->
<div class="modal fade" id="EditRouteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" method="post" id="EditRouteForm">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">แก้ไขเส้นทาง</h4>
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
                    <button type="submit" name="vanInsert" id="RouteUpdate" Value="RouteUpdate" class="btn btn-primary">เพิ่มข้อมูล</button>
                    <button type="button" class="btn btn-secondary" id="closeEditModal" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Form -->

<!-- DeleteVanModal -->
<div class="modal fade" id="DeleteRouteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" method="post" id="DeleteRouteForm">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">ลบข้อมูลรถตู้</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div id="pb-modalreglog-progressbar"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="DeleteRouteID" id="DeleteRouteID" />
                    </div>
                    <div class="form-group">
                        <label for="email">คุณต้องการที่จะลบข้อมูลรถตู้หรือไม่?</label>
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
        // search
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        // ClearModal
        // $('#OpenModal').click(function() {
        //     document.getElementById("AddRouteForm").reset();
        //     $('#inputSeat').prop('disabled', false);
        //     document.getElementById("myModalLabel").innerHTML = "เพิ่มข้อมูลรถตู้";
        // });

        // AddModal
        $('#AddEmployeeForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "AddEmployeeForm.php",
                method: "POST",
                data: $('#AddEmployeeForm').serialize(),
                dataType: "json",
                success: function(data) {
                    document.getElementById("AddEmployeeForm").reset();
                    $('#AddEmployeeModal').modal('hide');
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
                url: "fetchEmployee.php",
                method: "POST",
                data: {
                    EmployeeID: EmployeeID
                },
                dataType: "json",
                success: function(data) {
                    $('#uRouteID').val(EmployeeID);
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



</div>
<!-- ./wrapper -->

<?php include '../admin/_footer.php' ?>

</html>