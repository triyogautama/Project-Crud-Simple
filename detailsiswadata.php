<?php

include('koneksi.php');

$idsiswa = isset($_REQUEST['id'])?$_REQUEST['id']:'';

if (empty($idsiswa)) {
    die('Invalid student Id!');
}

$student = null;

$queryGet = "SELECT * FROM tb_siswa WHERE id_siswa = ? LIMIT 1";
$exec = $conn->prepare($queryGet);

$exec->bind_param("i", $idsiswa);
$exec->execute();

$result = $exec->get_result();

while ($row = $result->fetch_assoc()) {
    $student = $row;
}



?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Admin</title>

    <!-- style src -->
    <?php include "src/style.php" ?>
    <!-- akhir style -->
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- navbar component -->
        <?php include "components/navbarcomponents.php" ?>
        <!-- akhir navbar -->

        <!-- sidebar component -->
        <?php include "components/sidebarcomponents.php" ?>
        <!-- akhir sidebar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Siswa Data</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Siswa Data</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Widget: user widget style 1 -->
                            <div class="card card-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-info">
                                    <h3 class="widget-user-username"><?php echo $student['nama_siswa']?></h3>
                                    <h5 class="widget-user-desc"><?php echo $student['kelas_siswa']?></h5>
                                </div>
                                <div class="">
                                    <img styleclass="img-circle elevation-2" src="images/<?php echo $student['foto_siswa']?>"
                                        alt="User Avatar">
                                </div>
                                
                            </div>
                            <!-- /.widget-user -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- footer component -->
        <?php include "components/footercomponents.php" ?>
        <!-- akhir footer -->
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- js src -->
    <?php include "src/js.php" ?>
    <!-- akhir js -->
</body>

</html>