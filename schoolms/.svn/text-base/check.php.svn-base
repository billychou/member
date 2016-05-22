<?php
session_start();
$user = $_POST['user'];
$passwd = $_POST['passwd'];
$code  = $_POST['code'];
if($code != $_SESSION['letters_code']) {
    $msg = '请重新输入验证码';
    header("Location: login.php?msg=" . $msg);
    exit;
}
if( $user != 'admin' || $passwd != 'admin' ) {
    $msg = '请重新输入用户名和密码';
    header("Location: login.php?msg=" . $msg);
    exit;
}
echo "login success";