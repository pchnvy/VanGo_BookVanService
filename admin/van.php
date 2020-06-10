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
                            <i class="nav-icon fas fa-shuttle-van"></i>
                            <span style="font-family:'Kanit'">รถตู้/ที่นั่ง</span>
                        </strong>
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2">
                <div class="container-fluid" id="vantable">
                    <h2>ตารางแสดงรายละเอียดของรถตู้</h2>
                    <p>ลองพิมพ์เพื่อค้นหาสิ่งที่ท่านต้องการ เช่น รหัส, ทะเบียนรถ หรือประเภทของน้ำมันที่ใช้ เป็นต้น</p>
                    <div class="col-sm-2 col-md-2">
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                        </br>
                        <button type="button" class="btn btn-primary" href="" id="OpenModal" data-toggle="modal" data-target="#AddVanModal" style="background-color:dodgerblue;">เพิ่มข้อมูลรถตู้</button>
                    </div>
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead style="text-align: center;">
                            <tr>
                                <th>รหัสรถตู้</th>
                                <th>ทะเบียนรถ</th>
                                <th>จำนวนที่นั่ง</th>
                                <th>ประเภทน้ำมัน</th>
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
                            $sql = "call sp_van_getvan";
                            $result = $conn->query($sql);

                            if ($result != null) {
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>" .
                                            "<td>" . $row["VanID"] . "</td>" .
                                            "<td>" . $row["VanNumber"] . "</td>" .
                                            "<td>" . $row["SeatCount"] . "</td>" .
                                            "<td>" . $row["Fueltype"] . "</td>" .
                                            "<td>" . $row["CreateDate"] . "</td>" .
                                            "<td>" . $row["CreateBy"] . "</td>" .
                                            "<td>" . $row["UpdateDate"] . "</td>" .
                                            "<td>" . $row["UpdateBy"] . "</td>" .
                                            "<td align=\"center\">
                                            <a name=\"Edit\" value=\"Edit\" id=" . $row["VanID"] . " href=\"#\" 
                                            class=\"edit_data\" title=\"Edit\" /> 
                                            <i class=\"far fa-edit\"></i></a>
                                            </td>" . "<td align=\"center\">
                                            <a name=\"Delete\" value=\"Delete\" id=" . $row["VanID"] . " href=\"#\" 
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


<!-- AddVanModal -->
<div class="modal fade" id="AddVanModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" method="post" id="AddVanForm">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div id="pb-modalreglog-progressbar"></div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="VanID" id="VanID" />
                    </div>
                    <div class="form-group">
                        <label for="email">ทะเบียนรถตู้</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" class="form-control" name="inputNumber" id="inputNumber" placeholder="ทะเบียนรถตู้" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="studentid">ประเภทน้ำมันที่ใช้</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <!-- <input type="text" class="form-control" name="inputFuel" id="inputFuel" placeholder="eg. E20 GASOLINE95" required> -->
                            <select class="form-control" name="inputFuel" id="inputFuel" required>
                                <option>LPG</option>
                                <option>NGV</option>
                                <option>แก๊สโซฮอล์ E20</option>
                                <option>แก๊สโซฮอล์ E85</option>
                                </option>
                                <option>แก๊สโซฮอล์ 95</option>
                                <option>แก๊สโซฮอล์ 91</option>
                                <option>ไบโอดีเซล </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">จำนวนที่นั่ง</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="number" class="form-control" name="inputSeat" id="inputSeat" placeholder="เช่น 14,20,30" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="vanInsert" id="vanInsert" Value="vanInsert" class="btn btn-primary">เพิ่มข้อมูล</button>
                    <button type="button" class="btn btn-secondary" id="closeModal" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Form -->


<!-- EditVanModal -->
<div class="modal fade" id="EditVanModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" method="post" id="EditVanForm">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูลรถตู้</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div id="pb-modalreglog-progressbar"></div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="updateVanID" id="updateVanID" />
                    </div>
                    <div class="form-group">
                        <label for="email">ทะเบียนรถตู้</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" class="form-control" name="updateinputNumber" id="updateinputNumber" placeholder="ทะเบียนรถตู้" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="studentid">ประเภทน้ำมันที่ใช้</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <!-- <input type="text" class="form-control" name="inputFuel" id="inputFuel" placeholder="eg. E20 GASOLINE95" required> -->
                            <select class="form-control" name="updateinputFuel" id="updateinputFuel" required>
                                <option>LPG</option>
                                <option>NGV</option>
                                <option>แก๊สโซฮอล์ E20</option>
                                <option>แก๊สโซฮอล์ E85</option>
                                </option>
                                <option>แก๊สโซฮอล์ 95</option>
                                <option>แก๊สโซฮอล์ 91</option>
                                <option>ไบโอดีเซล </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">จำนวนที่นั่ง</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="number" class="form-control" name="updateinputSeat" id="updateinputSeat" placeholder="เช่น 14,20,30" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="vanUpdate" id="vanUpdate" Value="vanUpdate" class="btn btn-primary">แก้ไขข้อมูล</button>
                    <button type="button" class="btn btn-secondary" id="closeModalUpdate" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Form -->

<!-- DeleteVanModal -->
<div class="modal fade" id="DeleteVanModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" method="post" id="DeleteVanForm">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">ลบข้อมูลรถตู้</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div id="pb-modalreglog-progressbar"></div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="DeleteVanID" id="DeleteVanID" />
                    </div>
                    <div class="form-group">
                        <label for="email">คุณต้องการที่จะลบข้อมูลรถตู้หรือไม่?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="DeleteVan" id="DeleteVan" Value="vanUpdate" class="btn btn-primary">ยืนยัน</button>
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
            document.getElementById("AddVanForm").reset();
            $('#inputSeat').prop('disabled', false);
            document.getElementById("myModalLabel").innerHTML = "เพิ่มข้อมูลรถตู้";
            document.getElementById("vanInsert").innerHTML = "เพิ่มข้อมูล";
        });

        // AddModal
        $('#AddVanForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "AddVanForm.php",
                method: "POST",
                data: $('#AddVanForm').serialize(),
                dataType: "json",
                success: function(data) {
                    document.getElementById("AddVanForm").reset();
                    $('#AddVanModal').modal('hide');
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
            var VanID = $(this).attr("id");
            $.ajax({
                url: "fetch.php",
                method: "POST",
                data: {
                    VanID: VanID
                },
                dataType: "json",
                success: function(data) {
                    $('#updateinputNumber').val(data.VanNumber);
                    // $('#updateinputFuel').children("option:selected").val(data.Fueltype);
                    document.getElementById("updateinputFuel").value = data.Fueltype;
                    $('#updateinputSeat').val(data.SeatCount);
                    $('#updateVanID').val(VanID);
                    $('#updateinputSeat').prop('disabled', true);
                    $('#EditVanModal').modal('show');
                }
            })
        });

        $('#EditVanForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "EditVanForm.php",
                method: "POST",
                data: $('#EditVanForm').serialize(),
                dataType: "json",
                success: function(data) {
                    document.getElementById("EditVanForm").reset();
                    $('#EditVanModal').modal('hide');
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
            var VanID = $(this).attr("id");
            $('#DeleteVanID').val(VanID);
            $('#DeleteVanModal').modal('show');
        });

        $('#DeleteVanForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "DeleteVanForm.php",
                method: "POST",
                data: $('#DeleteVanForm').serialize(),
                dataType: "json",
                success: function(data) {
                    $('#DeleteVanModal').modal('hide');
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