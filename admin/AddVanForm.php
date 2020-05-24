<?php

$conn = new mysqli("localhost", "root", "P@ssw0rd", "vango");
    if(!empty($_POST))
    {
        $output = '';
        $inputNumber = mysqli_real_escape_string($conn,$_POST["inputNumber"]);
        $inputUser = 'Admin';
        $inputFuel = mysqli_real_escape_string($conn,$_POST["inputFuel"]);
        $inputSeat = mysqli_real_escape_string($conn,$_POST["inputSeat"]);
        // $error = 'fuckkkk';
        if($_POST["VanID"]!='')
        {
            $query = "call sp_Van_EditVanSeat('".$_POST["VanID"]."','$inputVanID','$inputNumber','$inputFuel','$inputUser',@error)";
        }
        else{
            $query = "call sp_Van_AddVanSeat('$inputNumber','$inputFuel','$inputUser','$inputSeat',@error)";    
        }
        

        $objQuery = $conn->query($query);
        // if(mysqli_query($conn,$query))
        if($objQuery)
        {
            
        }
        
    }
?>