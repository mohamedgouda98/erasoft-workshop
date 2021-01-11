<?php
    include 'Assets/navbar.php';
?>


<div class="category">
    <div class="container">
        <h3>Category Course</h3>
        <div class="row">

            <?php
            include 'backend/courses.php';
            $courses = courses::getCourses();
            $imagePath = 'admin/pages/upload/';
            while ($row = $courses->fetch()){
            ?>

                <div class="course col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="<?php echo $imagePath . $row['image']?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title']?></h5>
                            <p class="card-text"><?php echo substr($row['body'], 0 , 50)?></p>
                        </div>
                        <div class="card-body">
                            <a href="course-details.php?course_id=<?php echo $row['id']?>" type="button" class="btn btn-primary">See More</a>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>
</div>




<?php
    include 'Assets/footer.php';
?>
