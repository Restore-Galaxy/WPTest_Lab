<?php

/**
 * login.php
 * Project: bookshop 
 * Jul 31, 2014 
 * @author khoidv1
 */
if (privilege() != -1)
    header("location:index.php");

if (isset($_POST['login'])){
    require_once 'model/users.php';
    #lấy giá trị $_POST data
    $username = $_POST['username'];
    $password = $_POST['password'];

    #Kiểm tra username và password rỗng
    if (empty($username) || empty($password)) {
        $msg = array("status"=>false,"txt"=>"Tài khoản và mật khẩu không được để trống!");
    } else {
        $user = new Users();
        $check_login = $user->checkLogin($username, $password);
        if ($check_login == -1) {
            $msg = array("status"=>false,"txt"=>"Tài khoản không tồn tại!");
        } elseif ($check_login == 0) {
            $msg = array("status"=>false,"txt"=>"Mật khẩu không chính xác!");
        } else {
            #Đăng nhập thành công kiểm tra remember me
            if (isset($_POST['rememberme'])) {
                #set cookie 1 ngày
                $account = array("username" => $username, "password" => $password);
                setcookie("account", base64_encode(serialize($account)), time() + 3600 * 24);
            } else {
                if (isRemember())
                    unset($_COOKIE['account']);
            }
            header("location:index.php");
        }
        $user->conn_close();
    }
}
require_once "view/login/login.php";
?>
