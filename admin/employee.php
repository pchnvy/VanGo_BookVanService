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
                        <thead style="text-align: center;">
                            <tr>
                                <th>รหัสพนักงาน</th>
                                <th>ชื่อพนักงาน</th>
                                <th>นามสกุลพนักงาน</th>
                                <th>อีเมลล์</th>
                                <th>เพศ</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>วันเกิด</th>
                                <th>สถานะ</th>
                                <th></th>
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
                                        <a name=\"Edit\" value=\"Edit\" id=" . $row["EmployeeID"] . " href=\"#\" 
                                        class=\"edit_data\" title=\"Edit\" /> 
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
                        <div class="row">
                            <div class="col-sm">
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
                            <div class="col-sm">
                                <label for="iTelephone">เบอร์โทรศัพท์</label>
                                <div class="input-group pb-modalreglog-input-group">
                                    <input type="text" class="form-control" name="iTelephone" id="iTelephone" pattern="[0-9]{10}" placeholder="0987654321" maxlength="30" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                                <div class="row">
                                    <div class="col-sm icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary1" name="iStatus" value="0" checked disabled>
                                        <label for="radioPrimary1">
                                            ปกติ
                                        </label>
                                    </div>
                                    <div class="col-sm icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary2" name="iStatus" value="1" disabled>
                                        <label for="radioPrimary2">
                                            พ้นสภาพ
                                        </label>
                                    </div>
                                </div>
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

<!-- EditEmployeeModal -->
<div class="modal fade" id="EditEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" method="post" id="EditEmployeeForm">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูลพนักงาน</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div id="pb-modalreglog-progressbar"></div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="uEmployeeID" id="uEmployeeID" />
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm">
                                <label for="uName">ชื่อพนักงาน</label>
                                <div class="input-group pb-modalreglog-input-group">
                                    <input type="text" class="form-control" name="uName" id="uName" placeholder="ชื่อ" required>
                                </div>
                            </div>
                            <div class="col-sm">
                                <label for="uLastName">นามสกุลพนักงาน</label>
                                <div class="input-group pb-modalreglog-input-group">
                                    <input type="text" class="form-control" name="uLastName" id="uLastName" placeholder="นามสกุล" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="uEmail">อีเมลล์</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <input type="email" class="form-control" id="uEmail" name="uEmail" placeholder="อีเมลล์" maxlength="30" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <label for="uSex">เพศ</label>
                                <div class="input-group pb-modalreglog-input-group">
                                    <select class="form-control" name="uSex" id="uSex" disabled required>
                                        <option>ชาย</option>
                                        <option>หญิง</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <label for="uTelephone">เบอร์โทรศัพท์</label>
                                <div class="input-group pb-modalreglog-input-group">
                                    <input type="text" class="form-control" name="uTelephone" id="uTelephone" pattern="[0-9]{10}" placeholder="0987654321" maxlength="30" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <label for="uBirthdate">วันเกิด</label>
                                <div class="input-group pb-modalreglog-input-group">
                                    <input type="text" class="form-control" name="uBirthdate" id="uBirthdate" disabled required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <label for="uStatus">สถานะการทำงาน</label>
                                <div class="row">
                                    <div class="col-sm icheck-primary d-inline">
                                        <input type="radio" id="uradioPrimary1" name="uStatus" value="false">
                                        <label for="uradioPrimary1">
                                            ปกติ
                                        </label>
                                    </div>
                                    <div class="col-sm icheck-primary d-inline">
                                        <input type="radio" id="uradioPrimary2" name="uStatus" value="true">
                                        <label for="uradioPrimary2">
                                            พ้นสภาพ
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="EmployeeUpdate" id="EmployeeUpdate" Value="EmployeeUpdate" class="btn btn-primary">แก้ไขข้อมูล</button>
                    <button type="button" class="btn btn-secondary" id="closeEditModal" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Form -->


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

        $('#OpenModal').click(function() {
            document.getElementById("AddEmployeeForm").reset();
        });

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
            var EmployeeID = $(this).attr("id");
            $.ajax({
                url: "fetchEmployee.php",
                method: "POST",
                data: {
                    EmployeeID: EmployeeID
                },
                dataType: "json",
                success: function(data) {
                    document.getElementById("EditEmployeeForm").reset();

                    $('#uEmployeeID').val(EmployeeID);
                    $('#uName').val(data.Name);
                    $('#uLastName').val(data.LastName);
                    $('#uEmail').val(data.Email);
                    document.getElementById("uSex").value = data.Sex;
                    $('#uTelephone').val(data.Telephone);
                    document.getElementById("uBirthdate").value = data.Birthdate;
                    if (data.FlagDelete == 0){
                        document.getElementById("uradioPrimary1").checked = true;
                        document.getElementById("uradioPrimary2").checked = false;
                    }
                    else{
                        document.getElementById("uradioPrimary2").checked = true;
                        document.getElementById("uradioPrimary1").checked = false;
                    }
                    $('#EditEmployeeModal').modal('show');
                }
            });
        });

        $('#EditEmployeeForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "EditEmployeeForm.php",
                method: "POST",
                data: $('#EditEmployeeForm').serialize(),
                dataType: "json",
                success: function(data) {
                    document.getElementById("EditEmployeeForm").reset();
                    $('#EditEmployeeModal').modal('hide');
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

    });
</script>



</div>
<!-- ./wrapper -->

<?php include '../admin/_footer.php' ?>

</html>