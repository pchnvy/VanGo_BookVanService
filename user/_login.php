<?php

    $mysqli = new mysqli("localhost","root","","vango");

    // Check connection
    if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
    }

    $conn = mysqli_connect('localhost', 'root', '', 'vango') or die("Error Connect to Database");
    if ($conn->connect_error) {
        die("Connection failed:" . $conn->connect_error);
    }
    if(!empty($_POST))
    {
        $output = '';
        $userID = mysqli_real_escape_string($conn, $_POST['UserID']);
        $password = mysqli_real_escape_string($conn, $_POST['Password']);
        $role = mysqli_real_escape_string($conn, $_POST['Role']);

        $query = "call sp_LoginUser('$userID','$password','$role',@error)";
        if(mysqli_query($conn,$query))
        {
            
        }
        echo $output;
    }

    mysqli_close($conn);
?>