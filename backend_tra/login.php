<?php

include 'dbcont.php';
session_start();

class login
{
    public static function authLogin()
    {
        global $cont;
        $email = $_POST['email'];
        $password = SHA1($_POST['password']);
        $auth = $cont->prepare("SELECT name,role FROM users WHERE email=? AND password=? LIMIT 1");
        $auth->execute([$email, $password]);
        $userData = $auth->fetchObject();

        if(empty($userData)){
            $_SESSION['message'] = 'invalid Email Or Password';
            header('Location:../admin/login.php');
            die();
        }

        $_SESSION['auth'] = $userData->name;
        $_SESSION['role'] = $userData->role;
        header('Location:../admin/index.php');
        exit();
    }


}

if(isset($_POST['submit_login'])){
    login::authLogin();
}

?>