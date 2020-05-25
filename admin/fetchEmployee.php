<?php
$conn = new mysqli("localhost", "root", "", "vango");
if(isset($_POST["EmployeeID"]))
{
    $sql = "SELECT EmployeeID
			,Name
			,LastName
			,Email
			,Sex
			,Telephone
			,Birthdate
			,FlagDelete
		FROM tbl_m_employee WHERE EmployeeID ='".$_POST["EmployeeID"]."'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}
?>