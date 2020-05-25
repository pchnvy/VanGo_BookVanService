<?php

$conn = new mysqli("localhost", "root", "", "vango");
    if(!empty($_POST))
    {
        $output = '';
        $uRouteID = mysqli_real_escape_string($conn,$_POST["uRouteID"]);
        $uName = mysqli_real_escape_string($conn,$_POST["uName"]);
        $uBegin = mysqli_real_escape_string($conn,$_POST["uBegin"]);
        $uDestination = mysqli_real_escape_string($conn,$_POST["uDestination"]);
        $uUsagetime = mysqli_real_escape_string($conn,$_POST["uUsagetime"]);
        $uPrice = mysqli_real_escape_string($conn,$_POST["uPrice"]);
        $uDescription = mysqli_real_escape_string($conn,$_POST["uDescription"]);
        $uUserID = 'Admin';
        $query = "call sp_Route_EditRoute('$uRouteID','$uName','$uBegin','$uDestination','$uUsagetime','$uPrice','$uDescription','$uUserID',@error)";
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