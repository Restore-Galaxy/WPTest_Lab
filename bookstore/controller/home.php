<?php

/**
 * home.php
 * Project: bookshop 
 * Jul 31, 2014 
 * @author khoidv1
 */
#Kiểm tra nếu có cookie thì đăng nhập luôn
require_once 'model/users.php';
require_once 'model/books.php';
require_once 'model/comments.php';

$user = new Users();
$book = new Books();

if (isRemember()) {
    $account = unserialize(base64_decode($_COOKIE['account']));
    $username = $account['username'];
    $password = $account['password'];
    $check = $user->checkLogin($username, $password);
    if ($check != 1) {
        $errmsg = "Hack deleted: Lỗi Cookie";
    }
    $user->conn_close();
}

#get danh sách
$action = "list";
if (isset($_GET['book'])) {
    $action = "view";
    $bookId = $_GET['book'];
    $bookDetail = $book->getBook($bookId);
}
#ajax get comment
if (isset($_GET['comment'])) {
    $comment = new Comments();
    $bookId = intval($_GET['comment']);

    ##add comment####
    if (isset($_GET['add'])) {
        #Kiểm tra quyền comment
        if (privilege() == -1) {
            echo json_encode(array("status" => false, "msg" => "Bạn không có quyền sử dụng chức năng này"));
            exit();
        }
        #Kiểm tra comment trống
        if (!isset($_POST['cmt']) || empty($_POST['cmt'])) {
            echo json_encode(array("status" => false, "msg" => "Không được để trống!"));
            exit();
        }
        #insert comment
        $cmt = $_POST['cmt'];
        if ($comment->insert($bookId, getUsername(), $cmt))
            echo json_encode(array("status" => true, "msg" => "Comment thành công!"));
        else
            echo json_encode(array("status" => false, "msg" => "Có lỗi xảy ra"));
    }
    #delete
    elseif (isset($_GET['del'])) {
        if (isset($_POST['commentId'])) {
            $commentId = $_POST['commentId'];

            if (privilege() == 1)
                $check_del = $comment->del($commentId, $bookId);
            else
                $check_del = $comment->del($commentId, $bookId, getUsername());
            if (!$check_del)
                echo json_encode(array("status" => false, "msg" => "Bạn không có quyền sử dụng chức năng này"));
            else
                echo json_encode(array("status" => true, "msg" => "Xóa comment thành công"));
        }
    } else {
        #danh sách comment
        $listComments = $comment->getComment($bookId);
        ######Output######
        $output = array();
        foreach ($listComments as $value) {
            $isDel = false;
            if (privilege() == 1 || $value['username'] == getUsername())
                $isDel = true;
            $user = new Users();
            $userDetail = $user->getUser($value['username']);
            $avatar = ($userDetail['avatar']) ? AVATAR_DIR . $userDetail['avatar'] : AVATAR_DIR . "default.jpg";
            $tmp = array(
                'username' => $value['username'],
                'avatar' => BASE_URL . "{$avatar}",
                'comment' => $value['comment'],
                'commentID' => $value['commentid'],
                'isDel' => $isDel
            );
//            var_dump($tmp);
            array_push($output, $tmp);
        }
        require_once 'view/home/comment.php';
    }
    exit();
} else {
    if(isset($_POST['search'])){
       $keyword = $_POST['search'];
       #filter
       $keyword = str_replace("script", "", strtolower($keyword));
    }
    else{
        $keyword = null;
    }
    $listBooks = $book->select($keyword);
}

require_once "view/home/index.php";
?>
