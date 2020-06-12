<!DOCTYPE html>
<html>

<?php include '_header.php' ?>

<style>
    /* Cosmetics styles */
    .cards {
        display: flex;
        flex-wrap: wrap;
    }

    .card {
        flex: 1% 0 20%;
        position: relative;
        margin: .5em;
        padding: 2em;
        min-height: 4em;
        /* background: greenyellow; */
        background-image: url("img/c-green.png");
        background-position: center;
        background-size: contain;
        background-repeat: no-repeat;
        /* border: 3px solid grey; */
    }

    .active {
        background-image: url("img/c-red.png");
        background-position: center;
        border-color: greenyellow;
        background-repeat: no-repeat;
        background-size: contain;
    }

    /* This is where the magic happens */
    input[type="checkbox"] {
        position: absolute;
        top: .5em;
        left: .5em;
        width: 30px;
        height: 30px;
    }

    @media (pointer: coarse) {
        input[type="checkbox"] {
            height: 2em;
            width: 2em;
        }
    }
    @media (hover: hover) {
        input[type="checkbox"] {
            z-index: -1
        }

        .card:hover input[type="checkbox"],
        input[type="checkbox"]:focus,
        input[type="checkbox"]:checked {
            z-index: auto
        }
    }
</style>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <strong>
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <span>รายละเอียดของเส้นทางที่ท่านต้องการจอง</span>
                        </strong>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item">Booking</li>
                    </ol>
                </div>
            </div><!-- /.row -->
            <div class="row mb-2">
                <div class="container-fluid" id="vantable">
                    <h5 style="margin:1%;">วันที่ออกเดินทาง : <span id="sRoundDate" style="color:#c28f02"></span></h5>
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
                    if ($conn->connect_error) {
                        die("Connection failed:" . $conn->connect_error);
                    }
                    $price;
                    
                    $roundID = $_GET["RoundID"];
                    $roundDate = strtotime($_GET['RoundDate']);

                    $sql = "call sp_Booking_GetHeader('$roundID', $roundDate)";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<h5 style=\"margin:1%;\">จุดเริ่มต้นและจุดปลายทางที่ท่านต้องการจะไป : <span style=\"color:#c28f02\"> " . $row["RouteName"] . "</span></h5>";
                            echo "<h5 style=\"margin:1%;\">ราคาต่อที่นั่ง :  <span style=\"color:#c28f02\"> " . $row["Price"] . " บาท</span></h5>";
                            echo "<h5 style=\"margin:1%;\">เวลารถออกและคาดว่าจะไปถึง :  <span style=\"color:#c28f02\"> " . $row["DepartingTime"] . " - " . $row["ArrivingTime"] . "</span></h5>";
                            echo "<h5 style=\"margin:1%;\">จำนวนที่นั่งคงเหลือ :  <span style=\"color:#c28f02\"> " . $row["RemainSeatCount"] . " จาก " . $row["SeatCount"] . "</span></h5>";
                            echo "<h4 style=\"margin:1%;\">ข้อมูลติดต่อคนขับ</h4>";
                            echo "<h5 style=\"margin:1%;\">ชื่อคนขับรถ :  <span style=\"color:#c28f02\"> " . $row["EmployeeName"] . "</span></h5>";
                            echo "<h5 style=\"margin:1%;\">หมายเลขทะเบียน :  <span style=\"color:#c28f02\"> " . $row["VanNumber"] . "</span></h5>";
                            echo "<h5 style=\"margin:1%;\">หมายเลขโทรศัพท์ :  <span style=\"color:#c28f02\"> " . $row["Telephone"] . "</span></h5>";
                            $price=$row["Price"];
                        }
                    }
                    ?>
                    <br>
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
                    if ($conn->connect_error) {
                        die("Connection failed:" . $conn->connect_error);
                    }

                    $roundID = $_GET["RoundID"];
                    $roundDate = strtotime($_GET['RoundDate']);
                                        
                    $sql = "call sp_Booking_GetSeatDetail('$roundID', $roundDate)";
                    $result = $conn->query($sql);
                    // echo "<form autocomplete=\"off\" method=\"post\" id=\"AddBookVanForm\" action=\"user_payment.php?RoundDate=" . $_GET["RoundDate"] . "&RoundID=".$_GET["RoundID"]."\">";
                    echo "<form autocomplete=\"off\" method=\"post\" id=\"AddBookVanForm\" action=\"user_BookingForm.php?RoundDate=" . $_GET["RoundDate"] . "&RoundID=".$_GET["RoundID"]."\">";
                    echo "<div class=\"container\">";
                    echo "<div class=\"row\">";
                    echo "<div class=\"cards\">";
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if($row["Available"]==1){
                            echo "<div class=\"col-sm-4\">";
                            echo "<div style='pointer-events: auto;' class=\"card\" name=\"Seat\" id=\"DIV".$row["SeatID"]."\">" .
                                // "<input type=\"hidden\" name=\"RoundID\" id=\"R".$row["RoundID"]."\" value=\"".$row["RoundID"]."\" />".
                                // "<input name=\"Seat".$row["SeatID"]."\" id=\"".$row["SeatID"]."\" value=\"".$row["SeatID"]."\" type=\"hidden\" /><br>" .
                                "<input style=\"display:none\" name=\"".$row["SeatID"]."\" id=\"".$row["SeatID"]."\" value=\"".$row["SeatID"]."\" type=\"checkbox\" /><br>" .
                                "<p class=\"text-center\">".$row["SeatName"]."</p>".
                                "</div>".
                                "</div>";
                            }
                            else
                            {
                            echo "<div class=\"col-sm-4\">";
                            echo "<div class=\"card active\">" .
                                "<input style=\"display:none\" value=\"".$row["SeatID"]."\" type=\"checkbox\" /><br>" .
                                "<p class=\"text-center\">".$row["SeatName"]."</p>".
                                "</div>".
                                "</div>";
                            }

                        }
                    } else {
                        echo "0 result.";
                    }
                    echo "</div>".
                    "</div><br>".
                    "<h5 style=\"float: right;\">จำนวนเงินที่ต้องชำระ : <span id=\"SeatCount\">0</span> x <span id=\"Price\">0</span> =  <span id=\"Total\">0<span></h5><br><br>".
                    "<button style=\"float: right;\" type=\"submit\" name=\"BookVanInsert\" id=\"BookVanInsert\" class=\"btn btn-primary\">จอง</button>".
                    "</div>".
                    "</form>";
                    mysqli_close($conn);
                    ?>
                </div><!-- /.container-fluid -->
            </div>
        </div>
    </div>
    <!-- /.content-header -->
</div>

<?php include '_footer.php' ?>

<script>
    var sum = 1;
    
    $(document).ready(function() {
        <?php 
            if (!isset($_SESSION['UserID'])){
                echo "window.location.href = \"_error404.php\";";
            }
            else if ($_SESSION['Role'] != 'U'){
                echo "window.location.href = \"_error404.php\";";
            }

        ?>

        // show date
        var roundDate = <?php echo strtotime($_GET['RoundDate']) ?>;
        document.getElementById('sRoundDate').innerHTML = new Date(roundDate * 1000).toDateString();
        // Card Multi Select
        var SeatCount = 0;
        var Price = <?php echo $price ?>;
        document.getElementById('Price').innerHTML = Price;
        document.getElementById('Total').innerHTML = Price*SeatCount;
        $('input[type=checkbox]').click(function() {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                $(this).addClass('active');
            }
        });
        $('div[name=Seat]').click(function(){
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                document.getElementById($(this).attr('id')).getElementsByTagName("input")[0].checked = false;
                SeatCount --;
                document.getElementById('SeatCount').innerHTML = SeatCount;
                document.getElementById('Total').innerHTML = SeatCount*Price;
            } else {
                $(this).addClass('active');
                document.getElementById($(this).attr('id')).getElementsByTagName("input")[0].checked = true;
                SeatCount++;
                document.getElementById('SeatCount').innerHTML = SeatCount;
                document.getElementById('Total').innerHTML = SeatCount*Price;
            }
        });
    });
</script>

</html>