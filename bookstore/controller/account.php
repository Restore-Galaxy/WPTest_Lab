<?php

/**
 * account.php
 * Project: bookstore 
 * Aug 1, 2014 
 * @author khoidv1
 */
require_once 'model/users.php';
$user = new Users();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = (empty($_POST['password'])) ? null : $_POST['password'];
    $mail = $_POST['email'];
    $fullname = $_POST['fullname'];

    #Nếu null thì không up ảnh
    $acceptMime = array("image/png", "image/jpeg", "image/gif", "image/bmp");
    if ($_FILES["file"]["error"] > 0) {
        $avatar = null;
    } else {
        #kiểm tra MiME
        $mime = $_FILES['file']['type'];
        if (!in_array(strtolower($mime), $acceptMime)) {
            $avatar = null;
        } else {
            $avatar = $username . "_" . md5(time()) . $_FILES["file"]["name"];
            move_uploaded_file($_FILES["file"]["tmp_name"], AVATAR_DIR . $avatar);
        }
    }
    $data = array(
        'password' => $password,
        'email' => $mail,
        'fullname' => $fullname,
        'avatar' => $avatar
    );
    $update = $user->update($data, $username);
    if ($update) {
        $msg = array("status" => true, "txt" => "Cập nhật tài khoản thành công!");
    } else {
        $msg = array("status" => false, "txt" => "Có lỗi xảy ra!");
    }
}
$u = $user->getUser(getUsername());
require_once 'view/account/account.php';
$user->conn_close();
?>
