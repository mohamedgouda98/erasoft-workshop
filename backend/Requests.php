<?php

include 'dbcont.php';

class Requests{

    public static function addRequest(){
        global $cont;
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $courseId = $_POST['course_id'];

        $request = $cont->prepare("INSERT INTO requests(name, email, phone, course_id) VALUES(?,?,?,?)");
        $request->execute([$name, $email, $phone, $courseId]);

        session_start();
        $_SESSION['message'] = 'Request Was Send';
        header('Location:../course-details.php?course_id=' . $courseId);
    }

    public function getRequests(){
        global $cont;
        $requests = $cont->prepare("SELECT requests.id, requests.name, requests.status, requests.email, requests.phone, courses.title FROM requests INNER JOIN courses ON requests.course_id = courses.id");
        $requests->execute();
        return $requests;
    }

    public static function updateRequestStatus(){
        global $cont;
        $id = $_POST['id'];
        $request = $cont->prepare("UPDATE requests SET status=? WHERE id=?");
        $request->execute([1, $id]);
    }



}

if(isset($_POST['add_submit'])){
    Requests::addRequest();
}

if(isset($_POST['id'])){
    Requests::updateRequestStatus();
}


?>