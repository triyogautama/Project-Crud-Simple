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

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Final Project</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="src/style.css">

</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    <!-- <div class="container_fluid"> -->

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">LOGO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#portofolio">Portofolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="home" class="jumbotron jumbotron-fluid" style="padding-bottom: 30%">
        <div class="container">
            <h1 class="display-4" style="padding-top: 10%">Welcome To Info Students</h1>
            <p class="lead">This is a modified jumbotron that occupies the entire
                horizontal
                space of its parent.</p>
        </div>
    </div>

    <!-- PORTOFOLIO -->
    <div id="portofolio" class="container-fluid text-center bg-light">
        <div class="container section">
            <h2 class="">OUR STUDENTS</h2>
            <!-- <h4 class="">What we have create</h4> -->
            <div class="row">
            <?php foreach ($student as $s) { ?>
                <div class="col-md-4 text-center">
                    <div class="img-thumbnail">
                        <img style="width: 200px; height: 200px;" class="img-fluid" src="images/<?php echo $s['foto_siswa']?>" alt="ini foto siswa"><hr>
                        <p style="margin-top: 30px;"><b><?php echo $s['nama_siswa']?></b></p>
                        <p style="top: 0px;"><?php echo $s['kelas_siswa']?></p>
                        <p style="top: 0px;"><?php echo $s['jenis_kelamin']?></p>
                        <p style="top: 0px;"><?php echo $s['alamat_siswa']?></p>
                    </div>
                </div>

                <?php }?>
                </div>
            </div>
        </div>
    </div>

    <!-- kontak -->
    <div id="contact" class="container-fluid text-warning bg-primary">
        <div class="container section">
            <h2 class="text-center">Where is rumah coding located?</h2>

            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.043716520707!2d106.82352901431194!3d-6.3883604642619805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ec6e06f8179b%3A0xc393f79d8debe4df!2sRumah%20Coding!5e0!3m2!1sen!2sid!4v1584599878789!5m2!1sen!2sid"
                width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                tabindex="0"></iframe>
        </div>
    </div>

    <!-- footer -->
    <footer class="container-fluid text-center bg-dark text-white">
        <div class="container section">
            <a href="#myPage">
                <span class="fa fa-chevron-up"></span>
            </a>
            <p>&copy;2020 PT. BERSAMA KITA BERSINERGI</p>
        </div>
    </footer>
</body>

</html>