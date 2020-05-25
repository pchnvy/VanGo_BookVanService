<?php

$conn = new mysqli("localhost", "root", "", "vango");
    if(!empty($_POST))
    {
        $output = '';
        $inputNumber = mysqli_real_escape_string($conn,$_POST["inputNumber"]);
        $inputUser = 'Admin';
        $inputFuel = mysqli_real_escape_string($conn,$_POST["inputFuel"]);
        $inputSeat = mysqli_real_escape_string($conn,$_POST["inputSeat"]);
        // $error = 'fuckkkk';
            // $query = "call sp_Van_EditVanSeat('".$_POST["VanID"]."','$inputVanID','$inputNumber','$inputFuel','$inputUser',@error)";y
            $query = "call sp_Van_AddVanSeat('$inputNumber','$inputFuel','$inputUser','$inputSeat',@error)";    
        $objQuery = $conn->query($query);
        $result = $conn->query( 'SELECT @ErrorMsg');
        $row = mysqli_fetch_array($result);
        // if(mysqli_query($conn,$query))
        if($objQuery)
        {
            
        }
        
    }
?>