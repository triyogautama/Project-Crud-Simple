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

  <?php include 'src/style.php' ?>

  <!-- akhir style -->
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


<!-- navbar components-->
<?php include 'components/navbarcomponents.php' ?>
<!-- akhir navbar components-->

<!-- sidebar components-->   
<?php include 'components/sidebarcomponents.php' ?>
<!-- akhir sidebar components-->     

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Starter Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
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

          <?php include "components/addcomponents.php" ?>
          
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- footer components -->
  <?php include 'components/footercomponents.php' ?>
  <!-- akhir footer -->

</div>
<!-- ./wrapper -->

<!-- js src -->
<?php include 'src/js.php' ?>
<!-- akhir js -->

</body>
</html>
