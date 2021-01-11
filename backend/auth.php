<?php

include "dbcont.php";

class auth{

    public static function login(){
        global $cont;
        $email = $_POST['email'];
        $password = SHA1($_POST['password']);


        $auth = $cont->prepare("SELECT role FROM users WHERE email=? AND password=? LIMIT 1");
        $auth->execute([$email, $password]);
        $authData = $auth->fetchObject();
        session_start();
        if(empty($authData)){

            $_SESSION['error'] = "Email Or Password is Invalid";
            header('Location:../admin/login.php');

        }else{
           $_SESSION['role'] = $authData->role;
           header('Location:../admin/index.php');
        }

    }

}

if(isset($_POST['login'])){
    auth::login();
}