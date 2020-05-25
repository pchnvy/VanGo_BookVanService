<?php

$conn = new mysqli("localhost", "root", "", "vango");
    if(!empty($_POST))
    {
        $output = '';
        $DeleteRouteID = mysqli_real_escape_string($conn,$_POST["DeleteRouteID"]);

        $query = "call sp_Route_DeleteRoute('$DeleteRouteID',@ErrorMsg)";
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