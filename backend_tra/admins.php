<?php

include "dbcont.php";

class admins
{


    /** Dashboard Section */

    /**
     * Get Categories
     */
    public static function getAdmins()
    {
        global $cont;
        $users = $cont->prepare("SELECT * FROM users WHERE role=?");
        $users->execute([2]);
        return $users;
    }

    public static function getAdminData($id){
        global $cont;
        $user = $cont->prepare("SELECT * FROM users WHERE id=?");
        $user->execute([$id]);
        return $user->fetchObject();
    }

    public static function addAdmin(){

        global $cont;

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = SHA1($_POST['password']);
        $role = $_POST['role'];

        $admin = $cont->prepare("INSERT INTO users(name,email,password,role) VALUES(?,?,?,?)");
        $admin->execute([$name, $email,$password,$role]);

        $_SESSION['message'] = 'Was Added';
        header('Location:../admin/pages/tables/Admins.php');
        exit();
    }

    public static function updateAdmin(){
        global $cont;

        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $id = $_POST['id'];

        if(empty($_POST['password'])){
            $password = $_POST['old_password'];
        }else{
            $password= sha1($_POST['password']);
        }

        $admin = $cont->prepare("UPDATE users SET name=?, email=?, password=?, role=? WHERE id=?");
        $admin->execute([$name,$email,$password, $role, $id]);
        $_SESSION['message'] = 'Was Updated';
        header('Location:../admin/pages/tables/Admins.php');
        exit();
    }


    public static function deleteAdmin(){
        $id = $_POST['id'];
        global $cont;
        $user = $cont->prepare("DELETE FROM users WHERE id=?");
        $user->execute([$id]);
        $_SESSION['message'] = 'Was Deleted';
        header('Location:../admin/pages/tables/Admins.php');
        exit();
    }


}


if(isset($_POST['submit_admin']))
{
    admins::addAdmin();
}

if(isset($_POST['delete_submit'])){

    admins::deleteAdmin();
}

if(isset($_POST['submit_update'])){

    admins::updateAdmin();
}


?>