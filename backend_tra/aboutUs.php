<?php

include "dbcont.php";

class aboutUs
{


    /** Dashboard Section */

    /**
     * Get Categories
     */
    public static function getAboutUs()
    {
        global $cont;
        $about = $cont->prepare("SELECT * FROM about_us");
        $about->execute();
        return $about->fetchObject();
    }

    public static function updateAbout(){
        global $cont;
        $location = $_POST['location'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];


        $updateAbout = $cont->prepare("UPDATE about_us SET location=?, phone=?, email=?");
        $updateAbout->execute([$location, $phone, $email]);
session_start();
        $_SESSION['message'] = 'Was Updated';
        header('Location:../admin/pages/forms/update-about.php');
        exit();

    }


}


if(isset($_POST['submit']))
{
    aboutUs::updateAbout();
}



?>