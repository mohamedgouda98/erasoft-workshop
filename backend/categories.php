<?php

include 'dbcont.php';

class categories{


    /**
     * Get Category Name.
     * Insert Into Categories.
     * session with message.
     * header location.
     */
    public static function addCategory(){
        global $cont;
        $name = $_POST['name'];
        $category = $cont->prepare("INSERT INTO categories(name) VALUES(?)");
        $category->execute([$name]);
        session_start();
        $_SESSION['message'] = 'Category Was Created';
        header('Location:../admin/pages/forms/add-category.php');
    }

    /**
     * Get Categories.
     * @return bool|PDOStatement
     */
    public static function getCategories(){
        global $cont;
        $categories = $cont->prepare("SELECT * FROM categories");
        $categories->execute();
        return $categories;
    }

    /**
     * get category id.
     * get script value.
     * check if the user is real user or script.
     * delete category.
     * session with message.
     * header location.
     */
    public static function deleteCategory()
    {
        global $cont;

        $scriptData = $_POST['script'];

        if(!empty($scriptData)){
            session_start();
            $_SESSION['message'] = 'Not Allow';
            header('Location:../admin/pages/tables/Categories.php');
            die();
        }

        $categoryId = $_POST['category_id'];
        $query = $cont->prepare("DELETE FROM categories WHERE id= ?");
        $query->execute([$categoryId]);
        session_start();
        $_SESSION['message'] = 'Category Was Deleted';
        header('Location:../admin/pages/tables/Categories.php');
    }

}


if(isset($_POST['add_submit'])){
    categories::addCategory();
}

if(isset($_POST['delete_submit'])){
    categories::deleteCategory();
}








?>