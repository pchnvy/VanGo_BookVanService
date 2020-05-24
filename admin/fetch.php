<?php
$conn = new mysqli("localhost", "root", "P@ssw0rd", "vango");
if(isset($_POST["VanID"]))
{
    $sql = "Select v.VanID,v.VanNumber,count(s.SeatID) SeatCount,v.Fueltype,v.CreateDate,v.CreateBy,v.UpdateDate,v.UpdateBy From tbl_m_van v 
    LEFT JOIN tbl_m_seat s on v.VanID = s.VanID where v.VanID = '".$_POST["VanID"]."' GROUP BY VanID";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}
?>
