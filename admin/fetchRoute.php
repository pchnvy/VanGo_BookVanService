<?php
$conn = new mysqli("localhost", "root", "", "vango");
if(isset($_POST["RouteID"]))
{
    $sql = "Select RouteID,Name,Begin,Destination,Usagetime,Price,Description,CreateDate,CreateBy,UpdateDate,UpdateBy from tbl_m_route where RouteID ='".$_POST["RouteID"]."'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}
?>
