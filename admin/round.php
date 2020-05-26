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
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../admin/home.php">หน้าหลัก</a></li>
                        <li class="breadcrumb-item active">ตารางการเดินรถ</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <!-- <div class="row mb-2">
                <div class="container-fluid" id="vantable">
                    <h2>ตารางแสดงรายละเอียดของรถตู้</h2>
                    <p>ลองพิมพ์เพื่อค้นหาสิ่งที่ท่านต้องการ เช่น ไอดี,ทะเบียนรถ หรือประเภทของพลังงานที่ใช้ เป็นต้น</p>
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
                            } else {
                                echo "0 result.";
                            }
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                    <p>Note : .</p>
                </div> -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->


    </div>
    <!-- ./wrapper -->

    <?php include '../admin/_footer.php' ?>

</html>