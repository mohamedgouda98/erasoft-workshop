<?php
    session_start();
    include 'Assets/navbar.php';
?>
    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-12">

            <?php
            if(!empty($_SESSION['message'])) {
                ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['message']?>
                </div>
                <?php
                session_unset($_SESSION['message']);
            }

            if(!empty($_SESSION['error'])) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['error']?>
                </div>
                <?php
                session_unset($_SESSION['error']);
            }
            ?>
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Slider</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="../../../backend/Sliders.php" enctype="multipart/form-data">

                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>

                  </div>
                </div>

              <div class="card-footer">
                <button type="submit" name="add_submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>

        </div>


      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
    include 'Assets/footer.php';
?>