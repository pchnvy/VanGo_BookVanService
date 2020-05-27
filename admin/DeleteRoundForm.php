<?php

$conn = new mysqli("localhost", "root", "", "vango");
    if(!empty($_POST))
    {
        $output = '';
        $dRoundID = mysqli_real_escape_string($conn, $_POST["dRoundID"]);

        $query = "call sp_Round_DeleteRound('$dRoundID',@ErrorMsg)";    
        $objQuery = $conn->query($query);

        $result = $conn->query( 'SELECT @ErrorMsg');
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
        
    }
?>