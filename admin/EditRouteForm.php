<?php
session_start();

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
        $uUserID = $_SESSION['UserID'];

        $query = "call sp_Route_EditRoute('$uRouteID','$uName','$uBegin','$uDestination','$uUsagetime','$uPrice','$uDescription','$uUserID',@ErrorMsg)";
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