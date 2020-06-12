<?php
session_start();

$conn = new mysqli("localhost", "root", "", "vango");

    $RoundDate = strtotime($_GET["RoundDate"]);
    $RoundID = $_GET["RoundID"];
    $BookingBy = $_GET["BookingBy"];
    $inputUser = $_SESSION['UserID'];
    $isConfirm = $_GET["IsConfirm"];

    echo $RoundDate . " " . $RoundID  . " " . $BookingBy . " " . $inputUser . " " . $isConfirm;

    $query = "call sp_Confirm_ConfirmBill($RoundDate,'$RoundID','$BookingBy','$inputUser', $isConfirm,@ErrorMsg)";
    $objQuery = $conn->query($query);

    header("location: confirm.php");
?>
