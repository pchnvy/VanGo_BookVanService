<?php

$conn = new mysqli("localhost", "root", "", "vango");
    if(!empty($_POST))
    {
        $output = '';
        $uEmployeeID = mysqli_real_escape_string($conn, $_POST["uEmployeeID"]);
        $uName = mysqli_real_escape_string($conn, $_POST["uName"]);
        $uLastName = mysqli_real_escape_string($conn, $_POST["uLastName"]);
        $uEmail = mysqli_real_escape_string($conn, $_POST["uEmail"]);
        $uTelephone = mysqli_real_escape_string($conn, $_POST["uTelephone"]);
        $uStatus = mysqli_real_escape_string($conn, $_POST["uStatus"]);

        $query = "call sp_Employee_EditEmployee('$uEmployeeID','$uName','$uLastName','$uEmail',null,'$uTelephone',$uStatus,@ErrorMsg)";
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