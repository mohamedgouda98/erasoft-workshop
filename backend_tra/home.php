<?php

include "dbcont.php";

class home
{

    public static function newCourses(){
        global $cont;
        $courses = $cont->prepare("SELECT * FROM courses ORDER BY id DESC LIMIT 6");
        $courses->execute();
        return $courses;
    }

    public static function bookCourse(){
        global $cont;
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $courseId = $_POST['id'];

        $request = $cont->prepare("INSERT INTO requests(name,phone,email,course_id) VALUES (?,?,?,?)");
        $request->execute([$name, $phone, $email, $courseId]);
        session_start();
        $_SESSION['message'] = "Course Was Booked";
        header('Location:../course-details.php?id='. $courseId);
    }


    public static function aboutData(){
        global $cont;
        $data = $cont->prepare("SELECT * FROM about_us LIMIT 1");
        $data->execute();
        return $data->fetchObject();
    }

}

if(isset($_POST['submit_book'])){
    home::bookCourse();
}