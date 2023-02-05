<?php
error_reporting(E_ALL&~E_WARNING);
session_start();
$my_account = null;
$my_password = null;
$my_name = null;
$my_nickname = null;
$my_Email = null;
$my_sex = null;
$my_phonenumber = null;

header( 'Location: login2.php' );
?>