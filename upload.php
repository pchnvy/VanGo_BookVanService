<!DOCTYPE html>
<html>

<?php include '_header.php' ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <strong>
                            <i class="nav-icon fas fa-file-upload"></i>
                            <span>อัพโหลดรูปภาพ</span>
                        </strong>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="user_history.php">History</a></li>
                        <li class="breadcrumb-item active">Upload</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="container-fluid">
                    <?php
                    $uploadForm = "upload_file.php?RoundDate=" . $_GET['RoundDate'] . "&RoundID=" . $_GET['RoundID'];
                    ?>
                    <form action="<?php echo $uploadForm ?>" method="post" enctype="multipart/form-data" name="upfile" id="upfile">
                        <h5 style="margin:1%;">วันที่ออกเดินทาง : <span id="sRoundDate" style="color:#c28f02"></span></h5>



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
            <h2>ช่องทางการชำระเงิน</h2>
            <div class="col-6">
                <div class="container">
                    <div class="row">
                        <div class="col-2">
                            <img src="img/Bank1.png" alt="SCB" width="100%" height="90%">
                        </div>
                        <div class="col">
                            <h4>ธนาคารไทยพาณิชย์</h4>
                            <p>ชื่อบัญชี : บริษัท แวนโก จำกัด</p>
                            <p>เลขที่บัญชี : 547-245273-6</p>
                            <p>พร้อมเพย์ : 0623870311</p>
                            <p>สาขา : แหลมทองบางแสน</p>
                        </div>
                    </div>
                    <div class="row" style="background-color:#d1d1d1">
                        <div class="col-2">
                            <img src="img/Bank2.png" alt="SCB" width="100%" height="90%">
                        </div>
                        <div class="col">
                            <h4>ธนาคารกรุงเทพ</h4>
                            <p>ชื่อบัญชี : บริษัท แวนโก จำกัด</p>
                            <p>เลขที่บัญชี : 316-4-68552-5</p>
                            <p>พร้อมเพย์ : 0623870312</p>
                            <p>สาขา : แหลมทองบางแสน</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <img src="img/Bank3.png" alt="SCB" width="100%" height="90%">
                        </div>
                        <div class="col">
                            <h4>ธนาคารกรุงไทย</h4>
                            <p>ชื่อบัญชี : บริษัท แวนโก จำกัด</p>
                            <p>เลขที่บัญชี : 412-3-01370-8</p>
                            <p>พร้อมเพย์ : 0623870313</p>
                            <p>สาขา : แหลมทองบางแสน</p>
                        </div>
                    </div>
                    <div class="row" style="background-color:#d1d1d1">
                        <div class="col-2">
                            <img src="img/Bank4.png" alt="SCB" width="100%" height="90%">
                        </div>
                        <div class="col">
                            <h4>ธนาคารกสิกรไทย</h4>
                            <p>ชื่อบัญชี : บริษัท แวนโก จำกัด</p>
                            <p>เลขที่บัญชี : 120-2-82880-5</p>
                            <p>พร้อมเพย์ : 0623870314</p>
                            <p>สาขา : แหลมทองบางแสน</p>
                        </div>
                    </div>
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

        // show date
        var roundDate = <?php echo strtotime($_GET['RoundDate']) ?>;
        document.getElementById('sRoundDate').innerHTML = new Date(roundDate * 1000).toDateString();

    });
</script>

</html>