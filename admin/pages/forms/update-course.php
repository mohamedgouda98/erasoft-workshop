<?php
    include 'Assets/navbar.php';
?>
    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Course</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="title">Course Title</label>
                  <input type="text" class="form-control" id="title" placeholder="Enter Title">
                </div>

                <div class="form-group">
                  <label for="price">Course Price</label>
                  <input type="text" class="form-control" id="price" placeholder="Enter Price">
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>

                  </div>
                </div>


                <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                  <label for="title">Course Body</label>
                  <textarea id="summernote">
                    Place <em>some</em> <u>text</u> <strong>here</strong>
                  </textarea>
                </div>
              </div>
<!--                  <div class="card-footer">-->
<!--                    Visit <a href="https://github.com/summernote/summernote/">Summernote</a> documentation for more examples and information about the plugin.-->
<!--                  </div>-->

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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