<?php

$conn = new mysqli("localhost", "root", "", "vango");
    
    if(!empty($_POST))
    {
        $RoundID = $_GET["RoundID"];
        $inputUser = 'Admin';
        foreach ($_POST as $key => $seatID) {
            $query = "call sp_Booking_BookVan('$RoundID','$seatID','$inputUser',@ErrorMsg)";    
            $objQuery = $conn->query($query);
        }
        header ("location:history.php");
    }
?>
