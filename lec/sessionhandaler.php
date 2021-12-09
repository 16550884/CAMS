<?php
$temadmin="lec";
session_start();
$user_check =$_SESSION['login_user'];
$user_level =$_SESSION['userlevel'];
$ukey=$_SESSION['user_key'];
$lec_key=$_SESSION['lec_key'];


if(!isset($_SESSION['login_user'])|| $user_level!==$temadmin){
    header("location:../index.php");
}
?>