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
              <h3 class="card-title">Add Course</h3>
            </div>
            <!-- /.card-header -->


            <!-- form start -->
            <form method="post" action="../../../backend/courses.php" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label for="title">Course Title</label>
                  <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
                </div>

                <div class="form-group">
                  <label for="price">Course Price</label>
                  <input type="text" name="price" class="form-control" id="price" placeholder="Enter Price">
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>

                  </div>
                </div>


                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text">Body</span>
                      </div>
                      <textarea name="body" class="form-control" aria-label="With textarea"></textarea>
                  </div>

                  <br>
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <label class="input-group-text" for="inputGroupSelect01">Options</label>
                      </div>
                      <select name="category_id" class="custom-select" id="inputGroupSelect01">
                          <option selected>Choose...</option>

                          <?php
                          require_once '../../../backend/categories.php';
                          $categories = categories::getCategories();
                          while ($row = $categories->fetch()){
                              ?>
                              <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                              <?php
                          }
                          ?>

                          <input type="hidden" name="script">

                      </select>
                  </div>



              </div>
              <!-- /.card-body -->

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