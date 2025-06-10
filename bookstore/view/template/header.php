<?php

require_once 'logo.php';

if (privilege() == 1) {
    require_once 'navabar_admin.php';
} elseif (privilege() == 0) {
    require_once 'navabar_user.php';
} else {
    require_once 'navabar.php';
}
?>
