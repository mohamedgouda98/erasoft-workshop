
<?php
    session_start();
    include 'Assets/navbar.php';
    include 'backend/courses.php';

    $imagePath = 'admin/pages/upload/';
    $id = $_GET['course_id'];
    $courseData = courses::getCourseData($id);
?>



<div class="course-details">
    <div class="container">
        <div class="row">
            <div class="col-md-6 image">
                <img src="<?php echo $imagePath . $courseData->image?>" class="card-img-top" alt="...">
            </div>

            <div class="col-md-6">
                <h4><?php echo $courseData->title ?></h4>
                <p class="text-justify"><?php echo $courseData->body?></p>
            </div>
        </div>
    </div>
</div>


<br><hr><br>

<div class="container">
    <div class="row">

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

        <div class="col-md-12">
            <form method="post" action="backend/Requests.php">

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Name">
                </div>

                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" class="form-control" placeholder="Enter Phone">
                </div>

                <input type="hidden" name="course_id" value="<?php echo $id?>">

                <button type="submit" name="add_submit" class="btn btn-success">Submit</button>
            </form>
            <br><br>
        </div>
    </div>
</div>






<?php
    include 'Assets/footer.php';
?>
