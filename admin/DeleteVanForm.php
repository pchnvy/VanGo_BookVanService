<?php

$conn = new mysqli("localhost", "root", "", "vango");
    if(!empty($_POST))
    {
        $output = '';
        $DeleteVanID = mysqli_real_escape_string($conn,$_POST["DeleteVanID"]);
        $query = "call sp_Van_DeleteVanSeat('$DeleteVanID',@ErrorMsg)";
        $objQuery = $conn->query($query);

        $result = $conn->query( 'SELECT @ErrorMsg');
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
        
    }
?>
