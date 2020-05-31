<?php
session_start();

$conn = new mysqli("localhost", "root", "", "vango");
    if(!empty($_POST))
    {
        $output = '';
        $iRoundDate = mysqli_real_escape_string($conn, $_POST["iRoundDate"]);
        $iRouteID = mysqli_real_escape_string($conn, $_POST["iRouteID"]);
        $iVanID = mysqli_real_escape_string($conn, $_POST["iVanID"]);
        $iEmployeeID = mysqli_real_escape_string($conn, $_POST["iEmployeeID"]);
        $iUser = $_SESSION['UserID'];

        $query = "call sp_Round_AddRound('$iRoundDate','$iRouteID','$iVanID','$iEmployeeID','$iUser',@ErrorMsg)";    
        $objQuery = $conn->query($query);

        $result = $conn->query( 'SELECT @ErrorMsg');
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
        
    }
?>