<?php

include('koneksi.php');

$idsiswa = isset($_REQUEST['id'])?$_REQUEST['id']:'';

if (empty($idsiswa)) {
    die('Invalid student Id!');
}

$queryDelete = "DELETE FROM `tb_siswa` WHERE id_siswa = ? LIMIT 1";
$exec = $conn->prepare($queryDelete);

$exec->bind_param("i", $idsiswa);
$exec->execute();

if ($exec->affected_rows > 0) {
    session_start();
    $_SESSION['message'] = 'Data Berhasil Dihapus!';
    header('Location: index.php');
}

?>

