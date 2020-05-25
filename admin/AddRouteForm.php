<?php

$conn = new mysqli("localhost", "root", "", "vango");
    if(!empty($_POST))
    {
        $output = '';
        $iName = mysqli_real_escape_string($conn,$_POST["iName"]);
        $iBegin = mysqli_real_escape_string($conn,$_POST["iBegin"]);
        $iDestination = mysqli_real_escape_string($conn,$_POST["iDestination"]);
        $iUsagetime = mysqli_real_escape_string($conn,$_POST["iUsagetime"]);
        $iPrice = mysqli_real_escape_string($conn,$_POST["iPrice"]);
        $iDescription = mysqli_real_escape_string($conn,$_POST["iDescription"]);
        $iUser = 'Admin';

        $query = "call sp_Route_AddRoute('$iName','$iBegin','$iDestination','$iUsagetime','$iPrice','$iDescription','$iUser',@ErrorMsg)";    
        $objQuery = $conn->query($query);

        $result = $conn->query( 'SELECT @ErrorMsg');
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
        
        if($objQuery)
        {
            
        }
        
    }
?>