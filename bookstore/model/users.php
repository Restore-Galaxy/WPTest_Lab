<?php

/**
 * users_model.php
 * Project: bookshop 
 * Jul 30, 2014 
 * @author khoidv1
 */
require_once 'database.php';

class Users {

    private $conn;

    function __construct() {
        $this->conn = db_connect();
    }

    function select() {
        $sql = "SELECT * FROM `users` ORDER BY `time` DESC";
        $query = mysqli_query($this->conn, $sql);  
        $result = array();
        while (($row = mysqli_fetch_assoc($query))) {
            array_push($result, $row);
        }
        return $result;
    }

    function checkLogin($username, $password) {
        if (!$this->checkExists($username))
            return -1;
        $hashed = sha1($password);
        $sql = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$hashed}'";
        $query = mysqli_query($this->conn, $sql);  
        $num_rows = mysqli_num_rows($query);
        if ($num_rows == 1) {
            $user = mysqli_fetch_assoc($query);
            if (privilege() == -1) {
                $_SESSION['account'] = array(
                    "username" => $user['username'],
                    "isadmin" => $user['isadmin'],
                    "timeout"=>time()
                );
            }
            return 1;
        }
        return 0;
    }

    function getUser($username) {
        $username = addslashes($username);
        $sql = "SELECT * FROM users WHERE username = '{$username}'";
        $query = mysqli_query($this->conn, $sql);  
        if ($query)
            return mysqli_fetch_assoc($query);
        return false;
    }

    function conn_close() {
        mysqli_close($this->conn);  
    }

    function insert($username, $password, $isadmin = null) {
        $username = addslashes($username);
        $hashed = sha1($password);
        if ($this->checkExists($username))
            return -1;
        if (is_null($isadmin))
            $sql = "INSERT INTO users (`username`,`password`) VALUES('{$username}','{$hashed}')";
        else {
            $isadmin = intval($isadmin);
            $sql = "INSERT INTO users (`username`,`password`,`isadmin`) VALUES('{$username}','{$hashed}',{$isadmin})";
        }

        
        if (mysqli_query($this->conn, $sql))  
            return 1;
        return 0;
    }

    function update($data = array(), $username) {
        $sql = "UPDATE `users` set ";
        $tmp = array();
        foreach ($data as $key => $value) {
            $data[$key] = addslashes($value);
            if (!is_null($value)) {
                if ($key == "password")
                    $value = sha1($value);
                array_push($tmp, "`{$key}`='{$value}'");
            }
        }
        $sql.=implode(", ", $tmp);
        $sql .= " WHERE `username` = '{$username}'";
        
        if (mysqli_query($this->conn, $sql))  
            return 1;
        return 0;
    }

    function remove($username) {
        $username = addslashes($username);
        $sql = "DELETE FROM `users` WHERE `username` = '{$username}'";
        if (mysqli_query($this->conn, $sql))  
            return 1;
        return 0;
    }

    private function checkExists($username) {
        $sql = "SELECT * FROM users WHERE username = '{$username}'";
        $query = mysqli_query($this->conn, $sql);
        $num_rows = mysqli_num_rows($query);
        if ($num_rows == 0)
            return false;
        return true;
    }

}

?>
