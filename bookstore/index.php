<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'config.php';
require_once 'lib.php';
$privilege = privilege();

if (isset($_GET['action'])) {
    $page = $_GET['action'];
    require_once ("controller/{$page}.php");
} else {
    if (isset($_GET['admin']) && $privilege != -1) {
        $page = $_GET['admin'];
        require_once ("controller/admin/{$page}.php");
        exit();
    }
    require_once ("controller/home.php");
}

?>
