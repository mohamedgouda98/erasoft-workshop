<?php

include "dbcont.php";

class slider
{


    /** Dashboard Section */

    /**
     * Get Categories
     */
    public static function getSliders()
    {
        global $cont;
        $sliders = $cont->prepare("SELECT * FROM sliders");
        $sliders->execute();
        return $sliders;
    }

    public static function addSlider(){
        global $cont;
        $avatarName = $_FILES['image']['name'];
        $avatarSize = $_FILES['image']['size'];
        $avatarTmp = $_FILES['image']['tmp_name'];
        $avatarType = $_FILES['image']['type'];


        $avatar = slider::saveImage($avatarName,$avatarSize,$avatarType,$avatarTmp);

        $slider = $cont->prepare("INSERT INTO sliders(image) VALUES(?)");
        $slider->execute([$avatar]);
        session_start();
        $_SESSION['message'] = 'Was Added';
        header('Location:../admin/pages/tables/Sliders.php');
        exit();

    }

    public static function saveImage($imageName, $imageSize, $imageType, $imageTemp){

        $avatar = time() . '_' . $imageName;

        $ImageLink = dirname(__FILE__) . '/../admin/pages/upload/';
        move_uploaded_file($imageTemp, $ImageLink . $avatar);

        return $avatar;
    }

    public static function deleteSlider(){
        $id = $_POST['id'];
        global $cont;
        $slider = $cont->prepare("DELETE FROM sliders WHERE id=?");
        $slider->execute([$id]);
        $_SESSION['message'] = 'Was Deleted';
        header('Location:Sliders.php');
        exit();

    }


}


if(isset($_POST['submit_slider']))
{
    slider::addSlider();
}

if(isset($_POST['submit_delete'])){

    slider::deleteSlider();
}


?>