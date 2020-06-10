<?php

$filename = $_FILES['fileupload']['name'];
// echo "<p>".$filename."</p>";

$filepath = "fileupload/" . $filename;
move_uploaded_file($_FILES['fileupload']['tmp_name'], $filepath);


?>

<script type='text/javascript'>
    alert('Upload File Succesfully');
    window.location = 'upload.php';
</script>