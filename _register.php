<?php

$conn = new mysqli("localhost", "root", "", "vango");
    if(!empty($_POST))
    {
        $output = '';
        $iName = mysqli_real_escape_string($conn,$_POST["iName"]);
        $iLastname = mysqli_real_escape_string($conn,$_POST["iLastname"]);
        $iEmail = mysqli_real_escape_string($conn,$_POST["iEmail"]);
        $iPassword = mysqli_real_escape_string($conn,$_POST["iPassword"]);
        $iPaymentNumber = mysqli_real_escape_string($conn,$_POST["iPaymentNumber"]);
        $iPaymentMethod = mysqli_real_escape_string($conn,$_POST["iPaymentMethod"]);
        $iSex = mysqli_real_escape_string($conn,$_POST["iSex"]);
        $iTelephone = mysqli_real_escape_string($conn,$_POST["iTelephone"]);


        $query = "call sp_Common_RegisterUser('$iName','$iLastname','$iEmail','$iPassword','$iPaymentNumber','$iPaymentMethod','$iSex','$iTelephone',@ErrorMsg)";
        $objQuery = $conn->query($query);
        
        $result = $conn->query( 'SELECT @ErrorMsg');
        $row = mysqli_fetch_array($result);
        echo json_encode($row);        
    }
?>