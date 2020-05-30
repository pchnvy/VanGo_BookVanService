<!DOCTYPE html>
<html>

<?php include '_header.php' ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ยืนยันการชำระเงิน</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Payment</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-shuttle-van"></i> รายละเอียดการจอง
                                    <small class="float-right"><?php echo "<p>Round ID : " . $_GET["RoundID"] . "</p>" ?></small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <?php
                                $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
                                if ($conn->connect_error) {
                                    die("Connection failed:" . $conn->connect_error);
                                }
                                $price;
                                $sql = "call sp_Booking_GetHeader('" . $_GET["RoundID"] . "')";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<h5>จุดเริ่มต้นและจุดปลายทางที่ท่านต้องการจะไป : " . $row["RouteName"] . "</h5>" .
                                            "<h5>เวลารถออกและคาดว่าจะไปถึง : " . $row["DepartingTime"] . " - " . $row["ArrivingTime"] . "</h5>";
                                        $price = $row["Price"];
                                    }
                                }
                                $count = count($_POST) - 1;
                                $total = $count * $price;
                                ?>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <p class="lead">วิธีการชำระเงิน : </p>
                                <img src="dist/img/credit/visa.png" alt="Visa">
                                <img src="dist/img/credit/mastercard.png" alt="Mastercard">
                                <img src="dist/img/credit/american-express.png" alt="American Express">
                                <img src="dist/img/credit/paypal2.png" alt="Paypal">

                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                    ระบบจะทำการตัดเงินจากหมายเลขบัญชีที่ท่านได้ทำการลงทะเบียน จากการผูกบัญชีผู้ใช้งานกับวิธีการชำระเงิน
                                    </?php>
                            </div>
                            <!-- /.col -->

                            <div class="col-6">
                                <p class="lead">สรุปการชำระเงิน</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>หมายเลขนั่งที่จอง</th>
                                            <td>
                                                <?php
                                                foreach ($_POST as $key => $value) {
                                                    if (substr(htmlspecialchars($key), 0, 4) == 'Seat') {
                                                        echo htmlspecialchars($key) . ",";
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width:50%">จำนวนที่นั่ง:</th>
                                            <?php echo "<td>" . $count . "</td>" ?>
                                        </tr>
                                        <tr>
                                            <th>ราคาต่อที่นั่ง :</th>
                                            <?php echo "<td>" . $price . "</td>" ?>
                                        </tr>
                                        <tr>
                                            <th>ยอดชำระทั้งหมด:</th>
                                            <?php echo "<td>" . $total . "</td>" ?>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <?php echo "<form autocomplete=\"off\" method=\"post\" id=\"AddPaymentForm\" action=\"user_AddPaymentForm.php?RoundID=".$_GET["RoundID"]."\">"; ?>
                            <?php
                            foreach ($_POST as $key => $seatID) {
                                if (substr(htmlspecialchars($key), 0, 4) == 'Seat') {
                                    echo htmlspecialchars($seatID) . ",";
                                    echo "<input style=\"display:none\" name=\"".$seatID."\" id=\"".$seatID."\" value=\"".$seatID."\" type=\"text\" /><br>";
                                }
                            }
                            ?>
                            <div class="row no-print">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> ชำระเงิน</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>



</div>
</div>
<!-- /.content-header -->
</div>

<?php include '_footer.php' ?>

</html>