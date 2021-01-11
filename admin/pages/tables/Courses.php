<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | DataTables</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">


      </ul>
  </nav>
  <!-- /.navbar -->


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="../../index.php" class="brand-link">
            <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


                    <li class="nav-item">
                        <a href="Courses.php" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Courses
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="Categories.php" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Categories
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="Requests.php" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Requests
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="Sliders.php" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Slider
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="../forms/update-about.php" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                About Us
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="Admins.php" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Admins
                            </p>
                        </a>
                    </li>


                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <?php
              if(!empty($_SESSION['message'])) {
                  ?>
                  <div class="alert alert-success" role="alert">
                      <?php echo $_SESSION['message']?>
                  </div>
                  <?php
                  session_unset($_SESSION['message']);
              }
              ?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3><br>
                  <a href="../forms/add-course.php" class="btn btn-success">Add Course</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Title</th>
                      <th>Price</th>
                      <th>Category Name</th>
                    <th>body</th>
                    <th>image</th>
                  <th>Update</th>
                  <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
                  require '../../../backend/courses.php';

                  $courses = courses::getCourses();
                  $imagePath = '../upload/';
                  while ($row = $courses->fetch()){
                  ?>
                  <tr>
                    <td><?php echo $row['title'] ?></td>
                      <td><?php echo $row['price']?></td>
                      <td><?php echo $row['name']?></td>
                    <td><?php echo $row['body'] ?></td>
                    <td> <img src="<?php echo $imagePath . $row['image']?>" width="100px" height="100px"></td>
                      <td><a class="btn btn-success" href="../forms/update-course.php?id=<?php echo $row['id']?>">Update</a></td>
                      <td>
                          <form method="post" action="../../../backend/courses.php">
                              <input type="hidden" name="course_id" value="<?php echo $row['id']?>">
                              <button type="submit" name="delete_submit" class="btn btn-danger">Delete</button>
                          </form>
                      </td>
                  </tr>
                  <?php
                  }
                  ?>


                  </tbody>
                  <tfoot>
                  <tr>
                      <th>Title</th>
                      <th>Price</th>
                      <th>Category Name</th>
                      <th>body</th>
                      <th>image</th>
                      <th>Update</th>
                      <th>Delete</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
      <strong>Copyright &copy; 2020 <a href="#">Erasoft</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
