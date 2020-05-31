<?php
session_start();

unset($_SESSION['UserID']);
unset($_SESSION['UserInfo']);
unset($_SESSION['Role']);

header( "location: index.php" );

?>