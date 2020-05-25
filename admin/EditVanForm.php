<?php

$conn = new mysqli("localhost", "root", "", "vango");
    if(!empty($_POST))
    {
        $output = '';
        $updateVanID = mysqli_real_escape_string($conn,$_POST["updateVanID"]);
        $updateinputNumber = mysqli_real_escape_string($conn,$_POST["updateinputNumber"]);
        $updateinputUser = 'Admin';
        $updateinputFuel = mysqli_real_escape_string($conn,$_POST["updateinputFuel"]);

        $query = "call sp_Van_EditVanSeat('$updateVanID','$updateinputNumber','$updateinputFuel','$updateinputUser',@ErrorMsg)";
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