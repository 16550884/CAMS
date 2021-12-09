<?php

session_start();
$user_check =$_SESSION['login_user'];
$ukey=$_SESSION['user_key'];


if(!isset($_SESSION['login_user'])){
    header("location:../index.php");
}
?>