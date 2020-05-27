<?php

$conn = new mysqli("localhost", "root", "", "vango");
    if(!empty($_POST))
    {
        $output = '';
        $uRoundID = mysqli_real_escape_string($conn, $_POST["uRoundID"]);
        $uRouteID = mysqli_real_escape_string($conn, $_POST["uRouteID"]);
        $uVanID = mysqli_real_escape_string($conn, $_POST["uVanID"]);
        $uEmployeeID = mysqli_real_escape_string($conn, $_POST["uEmployeeID"]);
        $uUser = 'Admin';

        $query = "call sp_Round_EditRound('$uRoundID','$uRouteID','$uVanID','$uEmployeeID','$uUser',@ErrorMsg)";    
        $objQuery = $conn->query($query);

        $result = $conn->query( 'SELECT @ErrorMsg');
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
        
    }
?>