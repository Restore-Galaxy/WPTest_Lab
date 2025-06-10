<?php

/**
 * booksmanager.php
 * Project: bookstore 
 * Aug 1, 2014 
 * @author khoidv1
 */
require_once 'model/users.php';
$user = new Users();
$action = "list";

#add
if (isset($_GET['add'])) {
    $action = "add";
    if (isset($_POST['submit'])) {
        #lấy giá trị $_POST data
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $isadmin = intval($_POST['isadmin']);
        if (empty($username) || empty($password) || empty($repassword)) {
            $errmsg = "Tài khoản và mật khẩu không được để trống!";
        } elseif ($password != $repassword) {
            $errmsg = "Mật khẩu không trùng nhau!";
        } else {
            $insert = $user->insert($username, $password, $isadmin);
            if ($insert == -1) {
                $errmsg = "Tài khoản <b>{$username}</b> đã tồn tại!";
            } elseif ($insert == 0) {
                $errmsg = "Có lỗi xảy ra, thêm người dùng không thành công!";
            } else {
                $action = "list";
            }
        }
        if($action == "add")
            $msg = array("status" => false, "txt" => $errmsg);
    }
}
#edit
if (isset($_GET['edit'])) {
    $username = $_GET['edit'];
    $u = $user->getUser($username);
    $action = ($username) ? "edit" : "list";
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = (empty($_POST['password'])) ? null : $_POST['password'];
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];
        $isadmin = intval($_POST['isadmin']);

        #Nếu null thì không up ảnh
        if ($_FILES["file"]["error"] > 0) {
            $avatar = null;
        } else {
            $avatar = $username . "_" . md5(time()) . $_FILES["file"]["name"];
            move_uploaded_file($_FILES["file"]["tmp_name"], AVATAR_DIR . $avatar);
        }
        $data = array(
            'password' => $password,
            'email' => $email,
            'fullname' => $fullname,
            'isadmin' => $isadmin,
            'avatar' => $avatar
        );
        $update = $user->update($data, $username);
        if ($update) {
            $action = 'list';
        } else {
            $msg = array("status" => false, "txt" => "Có lỗi xảy ra");
        }
    }
}
#delete
if (isset($_GET['del'])) {
    if (isset($_POST['username'])) {
        if ($user->remove($_POST['username']))
            echo json_encode(array("status" => true, "msg" => "Xóa thành công!"));
        else
            echo json_encode(array("status" => false, "msg" => "Có lỗi xảy ra!"));
    }
    exit();
}
#danh sách người dùng
if ($action == 'list')
    $listUser = $user->select();

require_once 'view/users/index.php';
$user->conn_close();
?>
