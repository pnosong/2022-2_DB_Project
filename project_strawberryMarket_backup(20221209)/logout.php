<?php
error_reporting(E_ALL & ~E_WARNING);
session_start();

unset($_SESSION['account']);
unset($_SESSION['password']);
unset($_SESSION['name']);
unset($_SESSION['nickname']);
unset($_SESSION['Email']);
unset($_SESSION['sex']);
unset($_SESSION['phonenumber']);

$my_account = null;
$my_password = null;
$my_name = null;
$my_nickname = null;
$my_Email = null;
$my_sex = null;
$my_phonenumber = null;


echo "<script>alert('Successfully logged out.');
        location.href='./login_and_createAccount.php'
        </script>";
