<?php
session_start();

$conn = new mysqli("localhost", "root", "", "vango");
    
    if(!empty($_POST))
    {
        $RoundDate = strtotime($_GET["RoundDate"]);
        $RoundID = $_GET["RoundID"];
        $inputUser = $_SESSION['UserID'];
        foreach ($_POST as $key => $seatID) {
            if($seatID != '' || $seatID != null){
                $query = "call sp_Booking_BookVan($RoundDate,'$RoundID','$seatID','$inputUser',@ErrorMsg)";    
                $objQuery = $conn->query($query);
            }
        }
        
        header ("location: user_history.php");
    }
?>