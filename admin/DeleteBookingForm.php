<?php

$conn = new mysqli("localhost", "root", "", "vango");

    $RoundDate = strtotime($_GET["RoundDate"]);
    $RoundID = $_GET["RoundID"];
    $BookingBy = $_GET["BookingBy"];

    $query = 
    "DELETE FROM tbl_t_bookvan
    WHERE DATE_FORMAT(RoundDate, '%Y-%m-%d') = FROM_UNIXTIME($RoundDate, '%Y-%m-%d')
    AND RoundID = '$RoundID'
    AND BookingBy = '$BookingBy'";
    $objQuery = $conn->query($query);

    header("location: confirm.php");
?>