<?php

include "dbcont.php";

class courses
{

    /** Dashboard Section */

    /**
     * Get Categories
     */
    public static function getCourses()
    {
        global $cont;
        $courses = $cont->prepare("SELECT courses.id, courses.image, courses.title,courses.price,courses.body, categories.name FROM courses INNER JOIN categories ON courses.category_id = categories.id");
        $courses->execute();
        return $courses;
    }

    public static function getCourseData($id){
        global $cont;
        $course = $cont->prepare("SELECT courses.id,courses.title,courses.price,courses.body,courses.image, categories.name FROM courses INNER JOIN categories ON courses.category_id = categories.id WHERE courses.id=? LIMIT 1");
        $course->execute([$id]);
        return $course->fetchObject();
    }

    public static function addCourse($title, $price, $imageName, $body, $category_id){
        global $cont;
        $category = $cont->prepare("INSERT INTO courses(title,image,body,price,category_id) VALUES(?,?,?,?,?)");
        $category->execute([$title,$imageName,$body,$price, $category_id]);
        $_SESSION['message'] = 'Was Added';
        header('Location:add-course.php');
        exit();

    }

    public static function saveImage($imageName, $imageSize, $imageType, $imageTemp){

        $avatar = time() . '_' . $imageName;

        $ImageLink = dirname(__FILE__) . '/../admin/pages/upload/';
        move_uploaded_file($imageTemp, $ImageLink . $avatar);

        return $avatar;
    }

    public static function deleteCourse(){
        $id = $_POST['id'];
        global $cont;
        $requestCount = courses::checkCourseRequests($id);

        if($requestCount != 0){
            $_SESSION['message'] = "Can't Delete This Course That Have Requests";
            header('Location:Courses.php');
            exit();
        }

        $category = $cont->prepare("DELETE FROM courses WHERE id=?");
        $category->execute([$id]);
        $_SESSION['message'] = 'Was Deleted';
        header('Location:Courses.php');
        exit();
    }

    public static function checkCourseRequests($courseId){
        global $cont;
        $requests = $cont->prepare("SELECT id FROM requests WHERE course_id=?");
        $requests->execute([$courseId]);
        return $requests->rowCount();
    }

    public static function updateCourse(){
        global $cont;
        $title = $_POST['title'];
        $price = $_POST['price'];
        $body = $_POST['body'];
        $id = $_POST['id'];

        if(!empty($_FILES['image']['name'])) {
            $avatarName = $_FILES['image']['name'];
            $avatarSize = $_FILES['image']['size'];
            $avatarTmp = $_FILES['image']['tmp_name'];
            $avatarType = $_FILES['image']['type'];

            $avatar = time() . '_' . $avatarName;

            $ImageLink = dirname(__FILE__) . '/../admin/pages/upload/';
            move_uploaded_file($avatarTmp, $ImageLink . $avatar);
        }else{
            $avatar = $_POST['oldImage'];
        }

        $updateCourse = $cont->prepare("UPDATE courses SET title=?, price=?, image=?, body=? WHERE id=?");
        $updateCourse->execute([$title, $price, $avatar, $body, $id]);
        session_start();
        $_SESSION['message'] = 'Was Updated';
        header('Location:../admin/pages/tables/Courses.php');
        exit();

    }

}


if(isset($_POST['delete_submit']))
{
    courses::deleteCourse();

}


if(isset($_POST['submit_update'])){

    courses::updateCourse();

}



?>