<?php

/**
 * register.php
 * Project: bookshop 
 * Jul 31, 2014 
 * @author khoidv1
 */
require_once 'model/users.php';
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    #Kiểm tra username và password rỗng
    if (empty($username) || empty($password) || empty($repassword)) {
        $msg = array("status"=>false,"txt"=>"Tài khoản và mật khẩu không được để trống!");
    } elseif ($password != $repassword) {
        $msg = array("status"=>false,"txt"=>"Mật khẩu không trùng nhau!");
    } else {
        $user = new Users();
        $insertUser = $user->insert($username, $password);
        if ($insertUser == -1) {
            $errmsg = "Tài khoản <b>{$username}</b> đã tồn tại!";
            $msg = array("status"=>false,"txt"=>$errmsg);
        } elseif ($insertUser == 0) {
            $errmsg = "Có lỗi xảy ra, đăng ký không thành công!";
            $msg = array("status"=>false,"txt"=>$errmsg);
        } else {
            #Đăng nhập thành công kiểm tra remember me
            $msg = array("status"=>True,"txt"=>"Đăng ký tài khoản thành công!");
        }
        $user->conn_close();
    }
}
require_once 'view/login/register.php';
?>
