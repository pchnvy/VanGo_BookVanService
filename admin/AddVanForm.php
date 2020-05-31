<?php
session_start();

$conn = new mysqli("localhost", "root", "", "vango");
    if(!empty($_POST))
    {
        $output = '';
        $inputNumber = mysqli_real_escape_string($conn,$_POST["inputNumber"]);
        $inputUser = $_SESSION['UserID'];
        $inputFuel = mysqli_real_escape_string($conn,$_POST["inputFuel"]);
        $inputSeat = mysqli_real_escape_string($conn,$_POST["inputSeat"]);

        $query = "call sp_Van_AddVanSeat('$inputNumber','$inputFuel','$inputUser','$inputSeat',@ErrorMsg)";    
        $objQuery = $conn->query($query);
        
        $result = $conn->query( 'SELECT @ErrorMsg');
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
        // if(mysqli_query($conn,$query))
        if($objQuery)
        {
            
        }
        
    }
?>