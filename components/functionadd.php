<?php
//ini variabel penampung data dari form
$nama_siswa = isset($_REQUEST['nama'])?$_REQUEST['nama']:'';
$kelas_siswa = isset($_REQUEST['kelas'])?$_REQUEST['kelas']:'';
$jenis_kelamin = isset($_REQUEST['jeniskelamin'])?$_REQUEST['jeniskelamin']:'';
$alamat = isset($_REQUEST['alamat'])?$_REQUEST['alamat']:'';

//validasi input
$error = [];

//validasi nama siswa
if (empty($nama_siswa)) {
    $error[] = "kolom nama siswa tidak boleh kosong";
}

//validasi kelas
if (empty($kelas_siswa)) {
    $error[] = "kolom kelas tidak boleh kosong";
}

//validasi jenis kelamin
if (empty($jenis_kelamin)) {
    $error[] = "jenis kelamin tidak boleh kosong";
}

//validasi nama alamat
if (empty($alamat)) {
    $error[] = "alamat tidak boleh kosong";
}

if (!count($error) > 0) {
//tambah data
$queryAdd = "INSERT INTO tb_siswa VALUES (NULL, '{$kelas_siswa}', '{$kelas_siswa}', '{$jenis_kelamin}', '{$alamat}');";

$succes = [];
if ($conn->query($queryAdd) === TRUE) {
    $succes[] = "Data Siswa Berhasil Ditambah";
} else {
    $error[] = "Error: " . $queryAdd . $conn->error;
}


?>

<div id="alert" class="row <?php echo empty($error)?"d-none":"" ?>">
    <div class="col-md-12">
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($error as $r) {?>
                    <li><?php echo $r ?></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>