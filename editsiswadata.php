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

// ini variable penampung data input dari form
    $nama_siswa = isset($_REQUEST['nama'])?$_REQUEST['nama']:'';
    $kelas_siswa = isset($_REQUEST['kelas'])?$_REQUEST['kelas']:'';
    $jenis_kelamin = isset($_REQUEST['kelamin'])?$_REQUEST['kelamin']:'';
    $alamat_siswa = isset($_REQUEST['alamat'])?$_REQUEST['alamat']:'';
    $submit = isset($_REQUEST['submit'])?$_REQUEST['submit']:'';

    // variable untuk validasi
    $error = [];
        
    // validasi input
    if (!empty($submit)) {
        // validasi untuk nama siswa
        if (empty($nama_siswa)) {
            $error[] = "Nama Siswa Tidak Boleh Kosong!";
        }
        // validasi untuk kelas siswa
        if (empty($kelas_siswa)) {
            $error[] = "Kelas Siswa Tidak Boleh Kosong!";
        }
    
        // validasi untuk jenis kelamin
        if (empty($jenis_kelamin)) {
            $error[] = "Jenis Kelamin Tidak Boleh Kosong!";
        }
    
        // validasi untuk alamat siswa
        if (empty($alamat_siswa)) {
            $error[] = "Alamat Siswa Tidak Boleh Kosong!";
        }

        // file upload
        $ekstensi_diperbolehkan = array('png','jpg');
        $foto_siswa = $_FILES['poto']['name'];
        $x = explode('.', $foto_siswa);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['poto']['size'];
        $file_tmp = $_FILES['poto']['tmp_name'];
        
        // validasi gambar
        if ($foto_siswa === '') {
            $foto_siswa = $student['foto_siswa'];
        } else {
            // validasi untuk file, jika file ada maka bernilai true. apabila else maka akan muncul echo
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){

                // validasi untuk ukuran file, jika file berukuran lebih besar maka akan muncul echo
                if($ukuran < 1044070){ 
    
                move_uploaded_file($file_tmp, 'images/'.$foto_siswa);
    
                }else{
                $error[] = "UKURAN FILE TERLALU BESAR!";
                }
  
            }else{
              $error[] = "EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN!";
            }
        }
        
        // validasi count
        if (!count($error) > 0) {
            // edit data
            $queryEdit = "UPDATE tb_siswa SET nama_siswa='{$nama_siswa}',kelas_siswa='{$kelas_siswa}',jenis_kelamin='{$jenis_kelamin}',alamat_siswa='{$alamat_siswa}',foto_siswa='{$foto_siswa}' WHERE id_siswa = {$idsiswa}";
        
            if ($conn->query($queryEdit) === TRUE) {
                session_start();
                $_SESSION['message'] = "Data Siswa Berhasil Di Edit!";
                header('Location: index.php');
            } else {
                session_start();
                $_SESSION['errormessage'] = "Error: " . $queryEdit . $conn->error;
                header('Location: index.php'); 
            }
        }
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
                            <!-- general form elements -->
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Siswa Data</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
                                    enctype="multipart/form-data">
                                    <div class="card-body">

                                        <!-- Error Message -->
                                        <div id="alert" class="row <?php echo empty($error)?"d-none":"" ?>">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        <?php foreach ($error as $r) { ?>
                                                        <li><?php echo $r?></li>
                                                        <?php }?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Siswa</label>
                                            <input type="text" class="form-control" placeholder="Masukkan Nama Siswa"
                                                name="nama" value="<?php echo $student['nama_siswa']?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Kelas Siswa</label>
                                            <input type="text" class="form-control" placeholder="Masukkan Kelas Siswa"
                                                name="kelas" value="<?php echo $student['kelas_siswa']?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kelamin"
                                                    value="Pria"
                                                    <?php echo ($student['jenis_kelamin'] == 'Pria')?'checked':''?>>
                                                <label class="form-check-label">
                                                    Pria
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kelamin"
                                                    value="Wanita"
                                                    <?php echo ($student['jenis_kelamin'] == 'Wanita')?'checked':''?>>
                                                <label class="form-check-label">
                                                    Wanita
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat Siswa</label>
                                            <textarea class="form-control" placeholder="Masukkan Alamat Siswa"
                                                name="alamat"><?php echo $student['alamat_siswa']?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Foto Siswa</label>
                                            <input type="file" class="form-control-file" name="poto">
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <input type="submit" name="submit" class="btn btn-info" value="edit">
                                    </div>
                                </form>
                            </div>
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