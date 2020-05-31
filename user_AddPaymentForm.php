<?php
session_start();

$conn = new mysqli("localhost", "root", "", "vango");
    
    if(!empty($_POST))
    {
        $RoundID = $_GET["RoundID"];
        $inputUser = $_SESSION['UserID'];
        foreach ($_POST as $key => $seatID) {
            $query = "call sp_Booking_BookVan('$RoundID','$seatID','$inputUser',@ErrorMsg)";    
            $objQuery = $conn->query($query);
        }
        header ("location: user_history.php");

        echo $inputUser;
    }
?>
