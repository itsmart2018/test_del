<?php 
include "config.php";
if($_POST["add_object"]){
    /*echo "good";
    var_dump( $_POST);
    die();*/
    $str = "INSERT INTO `games` (`id`, `name`, `mark`, `genre`, `dev`) VALUES (NULL, '" . $_POST["name"] . "', '" . $_POST["mark"] . "', '" . $_POST["genre"] . "', '" . $_POST["dev"] . "')";
    mysqli_query($connection,$str);
    echo '<script>location.replace("index.php");</script>'; exit;
}
if($_POST["delete_object"]){
    $str="DELETE FROM `games` WHERE `games`.`id` = " . $_POST["id"];
     mysqli_query($connection,$str);
    echo '<script>location.replace("index.php");</script>'; exit;
}