<?php

/**
 * usermanager.php
 * Project: bookstore 
 * Aug 1, 2014 
 * @author khoidv1
 */
require_once 'model/books.php';

$book = new Books();
$action = "list";

#edit
if (isset($_GET['edit'])) {
    $bookId = $_GET['edit'];
    $bookDetail = $book->getBook($bookId);
    $action = ($bookId) ? "edit" : "list";
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        #Nếu null thì không up ảnh
        if ($_FILES["file"]["error"] > 0) {
            $image = null;
        } else {
            $image = $bookId . "_" . md5(time()) . $_FILES["file"]["name"];
            move_uploaded_file($_FILES["file"]["tmp_name"], BOOK_DIR . $image);
        }
        $data = array(
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'image' => $image
        );
        $update = $book->update($data, $bookId);
        if ($update) {
            $action = 'list';
        } else {
            $msg = array("status" => false, "txt" => "Có lỗi xảy ra");
        }
    }
}

#add
if (isset($_GET['add'])) {
    $action = "add";
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        #Nếu null thì không up ảnh
        if ($_FILES["file"]["error"] > 0) {
            $image = null;
        } else {
            $image = md5(time()) . $_FILES["file"]["name"];
            move_uploaded_file($_FILES["file"]["tmp_name"], BOOK_DIR . $image);
        }
        $data = array(
            'title' => $title,
            'price' => $price,
            'description' => $description,
            'image' => $image
        );
        $update = $book->insert($data);
        if ($update) {
            $action = 'list';
        } else {
            $msg = array("status" => false, "txt" => "Có lỗi xảy ra");
        }
    }
}
#delete
if (isset($_GET['del'])) {
    if (isset($_POST['bookId'])) {
        if ($book->remove($_POST['bookId']))
            echo json_encode(array("status" => true, "msg" => "Xóa thành công!"));
        else
            echo json_encode(array("status" => false, "msg" => "Có lỗi xảy ra!"));
    }
    exit();
}

if ($action == "list")
    $listBooks = $book->select();

#close connection mysql
$book->conn_close();
require_once 'view/books/index.php';
?>
