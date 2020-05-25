<?php

$conn = new mysqli("localhost", "root", "", "vango");
    if(!empty($_POST))
    {
        $output = '';
        $updateVanID = mysqli_real_escape_string($conn,$_POST["updateVanID"]);
        $updateinputNumber = mysqli_real_escape_string($conn,$_POST["updateinputNumber"]);
        $updateinputUser = 'Admin';
        $updateinputFuel = mysqli_real_escape_string($conn,$_POST["updateinputFuel"]);
        $query = "call sp_Van_EditVanSeat('$updateVanID','$updateinputNumber','$updateinputFuel','$updateinputUser',@error)";
            // $query = "call sp_Van_AddVanSeat('$inputNumber','$inputFuel','$inputUser','$inputSeat',@error)";    
        $objQuery = $conn->query($query);
        $result = $conn->query( 'SELECT @ErrorMsg');
        $row = mysqli_fetch_array($result);
        // if(mysqli_query($conn,$query))
        if($objQuery)
        {
            
        }
        
    }
?>