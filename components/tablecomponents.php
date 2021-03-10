<?php 
    include('koneksi.php');
    //ambil table database
    $queryGet = 'SELECT * FROM tb_siswa';
    $result = $conn->query($queryGet);
    $rows = $result->num_rows;

    while ($rows = $result->fetch_assoc()) {
        $student[] = $rows;
        // var_dump ($student);
    }

    session_start();
    if(isset($_SESSION['message'])) {
      $message = $_SESSION['message'];
      session_unset();
      session_destroy();
    }

    if (isset($_SESSION['errormesage'])) {
    $errormessage = $_SESSION['errormessage'];
    session_unset();
    session_destroy();
    }

?>

        <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>Data Siswa</b></h3>
                <a href="addsiswadata.php" class="btn btn-primary float-right"><i class="fas fa-plus"> Tambah Data</i></a>
              </div>
              <!-- /.card-header -->

              <div class="card-body">

            <!-- Succes message -->
            <div id="alert" class="row <?php echo empty($message)?"d-none":"" ?>">
                  <div class="col-md-12">
                    <div class="alert alert-success">
                      <i class="fas fa-check"></i> <?php echo $message?>
                    </div>
                  </div>
                </div>

              <!-- Error message -->
            <div id="alert" class="row <?php echo empty($errormessage)?"d-none":"" ?>">
                  <div class="col-md-12">
                    <div class="alert alert-danger">
                      <i class="fas fa-check"></i> <?php echo $errormessage?>
                    </div>
                  </div>
                </div>

              <!--table components-->
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Siswa</th>
                      <th>Kelas Siswa</th>
                      <th>Jenis Kelamin</th>
                      <th>Alamat Siswa</th>
                      <th>Foto Siswa</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($student as $s => $siswa) {
                       
                      ?>
                    <tr>
                      <td><?php echo $s+1 ?></td>
                      <td><?php echo $siswa['nama_siswa']; ?></td>
                      <td><?php echo $siswa['kelas_siswa']; ?></td>
                      <td><?php echo $siswa['jenis_kelamin']; ?></td>
                      <td><?php echo $siswa['alamat_siswa']; ?></td>
                      <td><img src="images/<?php echo $siswa['foto_siswa']; ?>" style="width: 50%"></td>
                      <td>
                          <div class='btn-group'>
                            <a href="detailsiswadata.php?id=<?php echo $siswa['id_siswa']?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i></a>
                            <a href="editsiswadata.php?id=<?php echo $siswa['id_siswa']?>" class="btn btn-info btn-sm">
                            <i class="fas fa-pencil-alt"></i></a>
                            <form action="deletecomponents.php?id=<?php echo $siswa['id_siswa']?>" method="post">
                            <button type="submit" onclick="return confirm('Are you sure to delete this data?')"
                             class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i></button>
                            </form>
                          </div>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
              <!--success message-->
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
                
              </div>
            </div>
            <!-- /.card -->

          </div>

        </div>