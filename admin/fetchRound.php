<?php
$conn = new mysqli("localhost", "root", "", "vango");
if(isset($_POST["RoundID"]))
{
    $sql = "SELECT RoundID
			,DATE_FORMAT(RoundTime, \"%H:%i\") AS RoundTime
			,RouteID
			,VanID
			,EmployeeID
		FROM tbl_t_Round WHERE RoundID ='".$_POST["RoundID"]."'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}
?>
