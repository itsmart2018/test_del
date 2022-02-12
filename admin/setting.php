<?php
include "../config.php";
    //var_dump("ddd"); die();
if($_POST["delete_object"]){
    //var_dump("ddd"); die();
    $str="DELETE FROM `games` WHERE `games`.`id` = " . $_POST["id"];
     mysqli_query($connection,$str);
    echo '<script>location.replace("index.php");</script>'; exit;
}

if($_POST["save_object"]){
    $str="UPDATE `games`SET name='" . $_POST["name"] . "', mark='" . $_POST["mark"] . "', genre='" . $_POST["genre"] . "',  dev='" . $_POST["dev"] . "' where `id` = " . $_POST["id"];
    
    //var_dump($str); die();
     mysqli_query($connection,$str);
    echo '<script>location.replace("index.php");</script>'; exit;
}
if($_POST["add_object"]){
    $str = "INSERT INTO `games` (`id`, `name`, `mark`, `genre`, `dev`) VALUES (NULL, '" . $_POST["name"] . "', '" . $_POST["mark"] . "', '" . $_POST["genre"] . "', '" . $_POST["dev"] . "')";
     mysqli_query($connection,$str);
    echo '<script>location.replace("index.php");</script>'; exit;
}

?>
