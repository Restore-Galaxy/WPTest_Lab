<?php
/**
 * install.php
 * Project: bookstore 
 * Aug 1, 2014 
 * @author khoidv1
 */

// Destroy cookie and session
session_start();
if (isset($_SESSION['account'])) {
    session_destroy();
}
if (isset($_COOKIE['account'])) {
    setcookie('account', '', time() - 3600);
}

require_once 'config.php';
require_once 'model/database.php';

// Create the database if it doesn't exist
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
}

// Check if the database exists, and create it if it doesn't
$db_select = mysqli_select_db($conn, DB_DATA);
if (!$db_select) {
    $create_db_sql = "CREATE DATABASE " . DB_DATA;
    if (mysqli_query($conn, $create_db_sql)) {
        echo "Database created successfully<br />";
    } else {
        echo "Error creating database: " . mysqli_error($conn) . "<br />";
        exit;
    }
    mysqli_select_db($conn, DB_DATA);
}

// Drop tables
echo "#############################DROP TABLE#############################<br/>";
$tables = array("comments", "users", "books");
foreach ($tables as $value) {
    $sql = "DROP TABLE IF EXISTS `{$value}`;";
    $status = (mysqli_query($conn, $sql)) ? "OK" : "NOK";
    echo "Drop table `{$value}`........................{$status}<br />";
}
echo "<br/>";
echo "#############################CREATE TABLE#############################<br/>";

// Table structure for table `books`
$sql = <<<EOD
CREATE TABLE IF NOT EXISTS `books` (
  `bookid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`bookid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5;
EOD;
$status = (mysqli_query($conn, $sql)) ? "OK" : "NOK";
echo "Create table `books`........................{$status}<br />";

// Insert data into table `books`
$sql = <<<EOD
INSERT INTO `books` (`bookid`, `title`, `price`, `description`, `image`) VALUES
(5, 'Truyện Ngắn Nam Cao', 72000, 'Nam Cao (1917-1951) là nhà văn thuộc dòng văn học hiện thực phê phán...', 'ebb574e70c28dfcb25bd0fa496db903ftruyenngannamcao.jpg'),
(6, 'Truyện Trạng Lợn & Truyện Xiển Bột', 17500, 'Trạng Lợn, Xiển Bột là những nhân vật chính trong hệ thống truyện...', 'da31c5e8c0698587f3a4d43bdbef8a68P58677Mbt.jpg'),
(7, 'Truyện Ngắn Hay', 40000, 'Truyện Ngắn Hay 2010 - 2011 là tập 16 truyện ngắn của 16 tác giả...', 'f7d96f63c7420936487efacf8494841cP58584Mbt.jpg'),
(8, 'Truyện Trạng Quỳnh', 30000, 'Tiếng cười nảy sinh từ những trò nghịch ngợm của Trạng Quỳnh...', 'b6c8bee0cc72f2a8ebef7b39d4a6a3eaP58047Mxx611.jpg');
EOD;
$status = (mysqli_query($conn, $sql)) ? "OK" : "NOK";
echo "Insert table `books`........................{$status}<br />";

// Table structure for table `comments`
$sql = <<<EOD
CREATE TABLE IF NOT EXISTS `comments` (
  `commentid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `bookid` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`commentid`),
  KEY `fk_comments_books_idx` (`bookid`),
  KEY `fk_comments_users_idx` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
EOD;
$status = (mysqli_query($conn, $sql)) ? "OK" : "NOK";
echo "Create table `comments`........................{$status}<br />";

// Table structure for table `users`
$sql = <<<EOD
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isadmin` tinyint(1) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
EOD;
$status = (mysqli_query($conn, $sql)) ? "OK" : "NOK";
echo "Create table `users`........................{$status}<br />";

echo "<br/>";
echo "#############################INSERT TABLE#############################<br/>";
// Dumping data for table `users`
$sql = <<<EOD
INSERT INTO `users` (`username`, `password`, `email`, `fullname`, `avatar`, `isadmin`, `time`) VALUES
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@sach.vn', 'BookStore Admin', NULL, 1, '2014-08-01 10:17:35');
EOD;
$status = (mysqli_query($conn, $sql)) ? "OK" : "NOK";
echo "Insert table `users`........................{$status}<br />";

echo "<br/>";
echo "#############################OTHER#############################<br/>";
// Constraints for table `comments`
$sql = <<<EOD
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_books` FOREIGN KEY (`bookid`) REFERENCES `books` (`bookid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_users` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;
EOD;
$status = (mysqli_query($conn, $sql)) ? "OK" : "NOK";
echo "Alter table `comments`........................{$status}<br />";

// Close the connection
mysqli_close($conn);
?>
<a href="index.php">Click here!</a>
