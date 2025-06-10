<?php

function db_connect() {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATA);

    if (!$conn) {
        die('Could not connect: ' . mysqli_connect_error());
    }

    mysqli_set_charset($conn, "UTF8"); 

    return $conn;
}

function db_closed($conn){
    mysqli_close($conn);
}
?>
