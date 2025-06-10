<?php

/**
 * users_model.php
 * Project: bookshop 
 * Jul 30, 2014 
 * @author khoidv1
 */
require_once 'database.php';

class Books {

    private $conn;

    function __construct() {
        $this->conn = db_connect();  
    }

    function select($keyword = null) {
        if (is_null($keyword)) {
            $sql = "SELECT * FROM `books` ORDER BY `bookid`";
        } else {
            $keyword = mysqli_real_escape_string($this->conn, $keyword); 
            $sql = "SELECT * FROM `books` WHERE `title` LIKE '%{$keyword}%' OR `description` LIKE '%{$keyword}%' ORDER BY `bookid`";
        }

        $query = mysqli_query($this->conn, $sql);  
        $result = array();
        while ($row = mysqli_fetch_assoc($query)) {  
            array_push($result, $row);
        }
        return $result;
    }

    function getBook($bookId) {
        $sql = "SELECT * FROM `books` WHERE `bookid` = '{$bookId}'";
        $query = mysqli_query($this->conn, $sql);  
        if ($query) {
            return mysqli_fetch_assoc($query);  
        }
        return false;
    }

    
    function update($data = array(), $bookId) {
        $bookId = intval($bookId);  
        $sql = "UPDATE `books` SET ";
        $tmp = array();

        foreach ($data as $key => $value) {
            $data[$key] = mysqli_real_escape_string($this->conn, $value);  
            if (!is_null($value)) {
                array_push($tmp, "`{$key}`='{$value}'");
            }
        }

        $sql .= implode(", ", $tmp);
        $sql .= " WHERE `bookid` = '{$bookId}'";

        if (mysqli_query($this->conn, $sql)) {  
            return 1;
        }
        return 0;
    }

    function insert($data) {
        foreach ($data as $key => $value) {
            if (!is_null($value)) {
                $data[$key] = mysqli_real_escape_string($this->conn, $value);  
            }
        }

        $sql = "INSERT INTO `books` (`title`,`price`,`description`,`image`) 
                VALUES ('{$data['title']}', '{$data['price']}', '{$data['description']}', '{$data['image']}')";

        if (mysqli_query($this->conn, $sql)) {  
            return 1;
        }
        return 0;
    }

    function remove($bookId) {
        $bookId = intval($bookId);  
        $sql = "DELETE FROM `books` WHERE `bookid` = '{$bookId}'";
        if (mysqli_query($this->conn, $sql)) {  
            return 1;
        }
        return 0;
    }
 
    function conn_close() {
        mysqli_close($this->conn);  
    }

}

?>
