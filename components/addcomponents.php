<?php
include('koneksi.php');

//ini variabel penampung data dari form
$nama_siswa = isset($_REQUEST['nama'])?$_REQUEST['nama']:'';
$kelas_siswa = isset($_REQUEST['kelas'])?$_REQUEST['kelas']:'';
$jenis_kelamin = isset($_REQUEST['jeniskelamin'])?$_REQUEST['jeniskelamin']:'';
$alamat = isset($_REQUEST['alamat'])?$_REQUEST['alamat']:'';
$submit = isset($_REQUEST['submit'])?$_REQUEST['submit']:'';


//validasi input
$error = [];
//validasi nama siswa
if (!empty($submit)) {
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

    //validasi nama siswa
    if (empty($alamat)) {
        $error[] = "alamat tidak boleh kosong";
    }

    //file upload
        $ekstensi_diperbolehkan = array('png','jpg');
        $foto_siswa = $_FILES['file']['name'];
        $x = explode('.', $foto_siswa);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];


        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            if($ukuran < 1044070){ 
            move_uploaded_file($file_tmp, 'images/'.$foto_siswa);

            } else {
            $error[] = 'UKURAN FILE TERLALU BESAR';
            }
        } else {
        $error[] = 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        }

    if (!count($error) > 0) {
        //tambah data
        $queryAdd = "INSERT INTO tb_siswa VALUES (NULL, '{$nama_siswa}', '{$kelas_siswa}', '{$jenis_kelamin}', '{$alamat}', '{$foto_siswa}');";
        
        if ($conn->query($queryAdd) === TRUE) {
            session_start();
            $_SESSION["message"] = "Data siswa berhasil ditambahkan";
            header('Location: index.php');
        } else {
            $error[] = "Error: " . $queryAdd . $conn->error;
        }
    }
}
?>


            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Data Siswa</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                <!-- pesan error -->
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
                  <div class="form-group">
                    <label>Nama Siswa</label>
                    <input type="text" class="form-control" placeholder="Nama Siswa" name="nama">
                  </div>
                  <div class="form-group">
                    <label>Kelas Siswa</label>
                    <input type="text" class="form-control" placeholder="V a" name="kelas">
                  </div><div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="form-check">
                         <input class="form-check-input" type="radio" name="jeniskelamin" value="Pria">
                        <label class="form-check-label" for="jeniskelamin1">
                          Pria
                         </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="jeniskelamin" value="Wanita">
                        <label class="form-check-label" for="jeniskelamin2">
                            Wanita
                        </label>
                        </div>
                    </div>
                  <div class="form-group">
                    <label>Alamat Siswa</label>
                    <textarea name="alamat" class="form-control" placeholder="Masukkan alamat"></textarea>
                  </div>
                    <div class="form-group">
                        <label>Foto Siswa</label>
                        <input type="file" class="form-control-file" name="file">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="submit" name="submit" value="simpan" class="btn btn-primary"></input>
                </div>
              </form>
            </div>