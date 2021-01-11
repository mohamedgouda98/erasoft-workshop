<?php

include 'dbcont.php';
include 'ImageTrait.php';

class Sliders{
    use ImageTrait;

    public static function getSliders(){
        global $cont;
        $sliders = $cont->prepare("SELECT * FROM sliders");
        $sliders->execute();
        return $sliders;
    }

    public static function addSlider(){
        global $cont;

        $imageName = $_FILES['image']['name'];
        $imageType = $_FILES['image']['type'];
        $imageTmp = $_FILES['image']['tmp_name'];

        $imageExt = self::checkImageExt($imageType);

        if($imageExt == 0){
            session_start();
            $_SESSION['error'] = 'U Must Upload Correct File';
            header('Location:../admin/pages/forms/add-course.php');
            die();
        }

        $avatarName = self::checkImageExist(time() . '_' . $imageName);

        $imageLink = dirname(__FILE__). '/../admin/pages/upload/';

        move_uploaded_file($imageTmp, $imageLink . $avatarName);

        $slider = $cont->prepare("INSERT INTO sliders(image) VALUES(?)");
        $slider->execute([$avatarName]);

        session_start();
        $_SESSION['message'] = 'Slider Was Added';
        header('Location:../admin/pages/forms/add-slider.php');

    }


}

if(isset($_POST['add_submit'])){
    Sliders::addSlider();
}


?>