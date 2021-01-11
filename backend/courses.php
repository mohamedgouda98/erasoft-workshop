<?php

include 'dbcont.php';
include 'ImageTrait.php';
include 'CoursesTrait.php';

class courses{

    use ImageTrait;
    use CoursesTrait;

   /**
    * Get attar Values.
    * Insert Into Courses.
    * Session with message.
    * Header with Location.
    */
   public static function addCourse(){
       global $cont;
       if(!empty($_POST['script'])){
           session_start();
           $_SESSION['message'] = 'u r Script';
           header('Location:../admin/pages/forms/add-course.php');
           die();
       }

       $title = $_POST['title'];
       $price = $_POST['price'];
       $body = $_POST['body'];
       $categoryId = $_POST['category_id'];

       $imageName = $_FILES['image']['name'];
       $imageType = $_FILES['image']['type'];
       $imageTmp = $_FILES['image']['tmp_name'];

       $imageExt = courses::checkImageExt($imageType);

       if($imageExt == 0){
           session_start();
           $_SESSION['error'] = 'U Must Upload Correct File';
           header('Location:../admin/pages/forms/add-course.php');
           die();
       }

       $avatarName = courses::checkImageExist(time() . '_' . $imageName);

       $imageLink = dirname(__FILE__). '/../admin/pages/upload/';

       move_uploaded_file($imageTmp, $imageLink . $avatarName);

       $course = $cont->prepare("INSERT INTO courses(title,price,image,body,category_id) VALUES(?,?,?,?,?)");
       $course->execute([$title, $price, $avatarName, $body, $categoryId]);
       session_start();
       $_SESSION['message']= 'Course Was Created';
       header('Location:../admin/pages/forms/add-course.php');
   }

    public static function getCourses(){
       global $cont;
       $courses = $cont->prepare("SELECT courses.id, courses.title, courses.price, courses.body, courses.image, categories.name FROM courses INNER JOIN categories ON courses.category_id = categories.id");
       $courses->execute();
       return $courses;
   }

   public static function deleteCourse(){
       global $cont;
       $courseId = $_POST['course_id'];
       $courseRequests = courses::checkCourseRequests($courseId);

       if(!empty($courseRequests->fetchColumn())){
           session_start();
           $_SESSION['message']= 'Cannot Delete This Course, This Course Had Requests';
           header('Location:../admin/pages/tables/Courses.php');
           die();
       }

       $course = $cont->prepare("DELETE FROM courses WHERE id=?");
       $course->execute([$courseId]);
       session_start();
       $_SESSION['message']= 'Course Was Deleted';
       header('Location:../admin/pages/tables/Courses.php');
   }

   public static function getCourseData($id){
       global $cont;
       $courseData = $cont->prepare("SELECT courses.id, courses.title, courses.price, courses.body, courses.image, courses.category_id, categories.name FROM courses INNER JOIN categories ON courses.category_id = categories.id  WHERE courses.id=? LIMIT 1");
       $courseData->execute([$id]);
       return $courseData->fetchObject();
   }

   public static function getCategoryCourses($id){
       global $cont;
       $courses = $cont->prepare("SELECT * FROM courses WHERE category_id=?");
       $courses->execute([$id]);
       return $courses;
   }

    /**
     * Get New Data.
     * Check if user upload new image or not.
     * update into database.
     * set sessions.
     * Location Update Course Page.
     */
   public static function updateCourse(){
       global $cont;
       $title = $_POST['title'];
       $body = $_POST['body'];
       $price = $_POST['price'];
       $categoryId = $_POST['category_id'];
       $courseId = $_POST['course_id'];

       if(!empty($_FILES['image']['name'])){
           $imageName = $_FILES['image']['name'];
           $imageType = $_FILES['image']['type'];
           $imageTmp = $_FILES['image']['tmp_name'];

           $imageExt = courses::checkImageExt($imageType);

           if($imageExt == 0){
               session_start();
               $_SESSION['error'] = 'U Must Upload Correct File';
               header('Location:../admin/pages/forms/update-course.php?id='.$courseId );
               die();
           }

           $avatarName = courses::checkImageExist(time() . '_' . $imageName);
           $imageLink = dirname(__FILE__). '/../admin/pages/upload/';

           move_uploaded_file($imageTmp, $imageLink . $avatarName);

       }else{
           $avatarName = $_POST['old_image'];
       }

       $course = $cont->prepare("UPDATE courses SET title=? , price=?, body=?, image=?, category_id=? WHERE id=?");
       if($course->execute([$title, $price, $body, $avatarName, $categoryId, $courseId])){
           session_start();
           $_SESSION['message'] = "Course Was Updated";
           header('Location:../admin/pages/forms/update-course.php?id='.$courseId );
           die();
       }

       session_start();
       $_SESSION['error'] = "Some Errors";
       header('Location:../admin/pages/forms/update-course.php?id='.$courseId );

   }


}


if(isset($_POST['add_submit'])){
    courses::addCourse();
}

if(isset($_POST['delete_submit'])){
    courses::deleteCourse();
}


if(isset($_POST['update_submit'])){
    courses::updateCourse();
}