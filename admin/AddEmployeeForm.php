<?php

$conn = new mysqli("localhost", "root", "", "vango");
    if(!empty($_POST))
    {
        $output = '';
        $iName = mysqli_real_escape_string($conn,$_POST["iName"]);
        $iLastName = mysqli_real_escape_string($conn,$_POST["iLastName"]);
        $iEmail = mysqli_real_escape_string($conn,$_POST["iEmail"]);
        $iPassword = mysqli_real_escape_string($conn,$_POST["iPassword"]);
        $iSex = mysqli_real_escape_string($conn,$_POST["iSex"]);
        $iTelephone = mysqli_real_escape_string($conn,$_POST["iTelephone"]);
        $iBirthdate = mysqli_real_escape_string($conn,$_POST["iBirthdate"]);
        // $iBirthdate = "2020-05-16";


        $query = "call sp_Employee_AddEmployee($iName','$iLastName','$iEmail','$iPassword','$iSex','$iTelephone','$iBirthdate',@error)";
        $objQuery = $conn->query($query);
        $result = $conn->query( 'SELECT @ErrorMsg');
        $row = mysqli_fetch_array($result);
        // if(mysqli_query($conn,$query))
        if($objQuery)
        {
            
        }
        
    }
?>