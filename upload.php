<!DOCTYPE html>
<html>

<?php include '_header.php' ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>อัพโหลดรูปภาพ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Upload</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="container-fluid">
                    <form action="upload_file.php" method="post" enctype="multipart/form-data" name="upfile" id="upfile">
                        <p>&nbsp;</p>
                        <table width="700" style="margin-right:auto;" cellpadding="0" cellspacing="0">
                            <tr>
                                <td height="40" colspan="2" style="text-align:center;background-color:#fcba03">Form Upload File</td>
                            </tr>
                            <tr>
                                <td width="126" style="background-color:#EDEDED">&nbsp;</td>
                                <td width="574" style="background-color:#EDEDED">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;background-color:#EDEDED">File Browser</td>
                                <td style="background-color:#EDEDED"><label>
                                        <input type="file" name="fileupload" id="fileupload" required="required" />
                                    </label></td>
                            </tr>
                            <tr>
                                <td style="background-color:#EDEDED">&nbsp;</td>
                                <td style="background-color:#EDEDED">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="background-color:#EDEDED">&nbsp;</td>
                                <td style="background-color:#EDEDED"><button type="submit" class="btn bg-yellow margin" style="background-color:#fcba03" name="button" id="button" value="Upload">Upload</button></td>
                            </tr>
                            <tr>
                                <td style="background-color:#EDEDED">&nbsp;</td>
                                <td style="background-color:#EDEDED">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="background-color:#000000">&nbsp;</td>
                                <td style="background-color:#000000">&nbsp;</td>
                            </tr>
                        </table>
                        <p>&nbsp;</p>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<?php include '_footer.php' ?>

<script>
    $(document).ready(() => {

        <?php
        if (!isset($_SESSION['UserID'])) {
            echo "window.location.href = \"_error404.php\";";
        } else if ($_SESSION['Role'] != 'U') {
            echo "window.location.href = \"_error404.php\";";
        }

        ?>

    });
</script>

</html>