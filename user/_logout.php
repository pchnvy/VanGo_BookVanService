<?php
session_start();
unset($_SESSION['UserID']);
unset($_SESSION['UserInfo']);
unset($_SESSION['Role']);
// pre_r($_SESSION['UserID']);

// if(!isset($_SESSION['user']))
// {
    
//     echo "<p style=\"color:green\">set ka leaw </p>";
// }
// else
// {
//     echo "<p style=\"color:red\">mai dai set ka</p>";
// }
// function pre_r($array){
//     echo '<pre>';
//     print_r($array);
//     echo '</pre>';
// }
header( "location: home.php" );

?>

<!-- <a href="page2.php" class="btn">gogogo</a> -->