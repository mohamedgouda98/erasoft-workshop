<?php

include "dbcont.php";

class category
{

    /** Dashboard Section */

    /**
     * Get Categories
     */
    public static function getCategories()
    {
        global $cont;
        $categories = $cont->prepare("SELECT * FROM categories");
        $categories->execute();
        return $categories;
    }

    public static function getCategoryCourses($id){
        global $cont;
        $courses = $cont->prepare("SELECT * FROM courses WHERE category_id=?");
        $courses->execute([$id]);
        return $courses;
    }

    public static function addCategory($name){
        global $cont;
        $category = $cont->prepare("INSERT INTO Categories(name) VALUES(?)");
        $category->execute([$name]);
        $_SESSION['message'] = 'Was Added';
        header('Location:add-category.php');
    }

    public static function deleteCategory($id){
        global $cont;
        $category = $cont->prepare("DELETE FROM categories WHERE id=?");
        $category->execute([$id]);
        session_start();
        $_SESSION['message'] = 'Was Deleted';
        header('Location:Categories.php');
    }





}


?>