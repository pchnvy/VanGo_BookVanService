<?php
session_start();

$filename = $_FILES['fileupload']['name'];
// echo "<p>".$filename."</p>";

$filepath = "fileupload/" . $filename;
move_uploaded_file($_FILES['fileupload']['tmp_name'], $filepath);


$conn = new mysqli("localhost", "root", "", "vango");
    
    if(!empty($_POST))
    {
        $RoundDate = strtotime($_GET["RoundDate"]);
        $RoundID = $_GET["RoundID"];
        $inputUser = $_SESSION['UserID'];
        echo $RoundDate . " " . $RoundID . " " .$inputUser . " " . $filepath;

        $query = "call sp_Booking_UploadFile($RoundDate,'$RoundID','$inputUser','$filepath',@ErrorMsg)";    
        $objQuery = $conn->query($query);
        
    }


?>

<script type='text/javascript'>
    alert('Upload File Succesfully');
    window.location = 'user_history.php';
</script>