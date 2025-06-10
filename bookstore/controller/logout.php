<?php

/**
 * logout.php
 * Project: bookshop 
 * Jul 31, 2014 
 * @author khoidv1
 */
if (privilege() != -1){
    setcookie('account', '', time() - 3600);
    session_destroy();
}
header("location:index.php");
?>
