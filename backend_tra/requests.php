<?php
include "dbcont.php";

if(isset($_POST['id'])){
    global $cont;
    $id = $_POST['id'];
    $updateStatus = $cont->prepare("UPDATE requests SET status=? WHERE id=?");
    $updateStatus->execute([ 1 ,$id]);
}


class requests{

    public static function getRequests(){
        global $cont;
        $requests = $cont->prepare("SELECT requests.id, requests.name, requests.email, requests.phone, requests.status, courses.title FROM requests INNER JOIN courses ON requests.course_id= courses.id");
        $requests->execute();
        return $requests;
    }

    public static function deleteCourse(){
        $id = $_POST['id'];
        global $cont;
        $category = $cont->prepare("DELETE FROM requests WHERE id=?");
        $category->execute([$id]);
        session_start();
        $_SESSION['message'] = 'Was Deleted';
        header('Location:../admin/pages/tables/Requests.php');
        exit();
    }


}

if(isset($_POST['delete_submit'])){
    requests::deleteCourse();
}


?>