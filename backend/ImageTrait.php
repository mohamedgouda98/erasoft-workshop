<?php

trait ImageTrait{

    /**
     * Check Image Ext.
     * return 1 true or 0 = false
     * @param $imageType
     * @return int
     */
    public static function checkImageExt($imageType)
    {
        $ext = ['image/png' , 'image/jpeg'];
        if(in_array($imageType , $ext)){
            return 1;
        }
        return 0;
    }


    public static function checkImageExist($imageName)
    {
        global $cont;
        $checkImageExist= $cont->prepare("SELECT * FROM Courses WHERE image=? LIMIT 1");
        $checkImageExist->execute([$imageName]);
        if(empty($checkImageExist->fetchColumn())){

            return $imageName;
        }

        $imageName = rand(00000 , 99999) . '_' . $imageName;
        return $imageName;
    }



}