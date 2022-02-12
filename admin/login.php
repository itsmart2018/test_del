<?php session_start();
include "../config.php";
include "pass.php";
/*
echo encode('pass', 'login');
die();
*/
if(isset($_POST["login_button"])){
    $pass = encode($_POST['password'],$_POST['login']);
    $str="SELECT * FROM `admin` where a_login = '" . $_POST['login'] . "' and a_pass = '" . $pass . "'";
        $answer = mysqli_fetch_assoc(mysqli_query($connection,$str));
        /*
        die();*/
        /*var_dump($answer);
        var_dump($str);
        die();*/
        if(isset($answer)){
            $_SESSION['id'] = $answer["a_id"];
            $_SESSION['level'] = $answer["a_level"];
            $_SESSION['name'] = $answer["a_login"];
        }else{
            echo '<script>alert("Ошибка логина или пароля");</script>';
        }
/*	$_SESSION['id'] = $_POST["number"];
	$_SESSION['name'] = $_POST["name"];*/
}
echo '<script>location.replace("index.php");</script>'; exit;