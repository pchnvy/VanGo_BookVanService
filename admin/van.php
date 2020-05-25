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
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../admin/home.php">หน้าหลัก</a></li>
                        <li class="breadcrumb-item active">รถตู้/ที่นั่ง</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2">
                <div class="container-fluid">
                    <h2>ตารางแสดงรายละเอียดของรถตู้</h2>
                    <p>ลองพิมพ์เพื่อค้นหาสิ่งที่ท่านต้องการ เช่น ไอดี,ทะเบียนรถ หรือประเภทของพลังงานที่ใช้ เป็นต้น</p>  
                    <div class="col-sm-2 col-md-2">
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                            </br>
                        <button type="button" class="btn btn-primary" href="" id="OpenModal" data-toggle="modal" data-target="#AddVanModal" style="background-color:dodgerblue;" >เพิ่มข้อมูลรถตู้</button>
                    </div>
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Van ID</th>
                            <th>Van Number</th>
                            <th>Seat Count</th>
                            <th>Fuel Type</th>
                            <th>Create Date</th>
                            <th>Create By</th>
                            <th>Update Date</th>
                            <th>Update By</th>
                            <th>Edit</th>
                            <th>Delete</th>
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
                                        <a name=\"Edit\" value=\"Edit\" id=".$row["VanID"]." href=\"#\" class=\"edit_data\" /> 
                                        <i class=\"far fa-edit\"></i></a></td>" .
                                        "<td align=\"center\"><a href=\"master_medicine_deleteform.php?MedID=". $row["VanID"]. "\">
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
</div>
<!-- ./wrapper -->


<!-- AddVanModal -->
<div class="modal fade" id="AddVanModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" method="post" id="AddVanForm">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">เพิ่ม/แก้ไขข้อมูลรถตู้</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div id="pb-modalreglog-progressbar"></div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="VanID" id="VanID"/>
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
                                <option>แก๊สโซฮอล์ E85</option></option>
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
                    <button type="submit" name ="vanInsert" id="vanInsert" Value="vanInsert" class="btn btn-primary">เพิ่มข้อมูล</button>
                    <button type="button" class="btn btn-secondary" id="closeModal" data-dismiss="modal">ยกเลิก</button>
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
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $(document).on('click','.edit_data',function(){
        var VanID = $(this).attr("id");
        $.ajax({
            url:"fetch.php",
            method:"POST",
            data:{VanID:VanID},
            dataType:"json",
            success:function(data){
                $('#inputNumber').val(data.VanNumber);
                $('#inputFuel').children("option:selected").val(data.Fueltype);
                $('#inputSeat').prop('disabled', true);
                $('#inputSeat').val(data.SeatCount);
                document.getElementById("myModalLabel").innerHTML = "แก้ไขข้อมูลรถตู้";
                document.getElementById("vanInsert").innerHTML = "แก้ไขข้อมูล";
                $('#vanInsert').val("Update");
                $('#AddVanModal').modal('show');
            }
        })
    });

    $('#vanInsert').click(function() {
        $(document).Toasts('create', {
            class: 'bg-success', 
            title: 'สำเร็จ',
            autohide: true,
            delay: 1750,
            body: 'ข้อมูลของท่านได้ถูกเพิ่มเข้าระบบแล้ว'
        })
    });

    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });    

    $('#OpenModal').click(function() {
        document.getElementById("AddVanForm").reset();
        $('#inputSeat').prop('disabled', false);
        document.getElementById("myModalLabel").innerHTML = "เพิ่มข้อมูลรถตู้";
        document.getElementById("vanInsert").innerHTML = "เพิ่มข้อมูล";
    });

    $('#AddVanForm').on('submit',function(event){
        event.preventDefault();
        $.ajax({
            url:"AddVanForm.php",
            method:"POST",
            data:$('#AddVanForm').serialize(),
            success:function(data)
            {
                document.getElementById("AddVanForm").reset();
                $('#AddVanModal').modal('hide');
            }
        });
    });
});
</script>

<?php include '../admin/_footer.php' ?>

</html>