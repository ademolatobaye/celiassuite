<?php

// DATABASE USERNAME, PASSWORD, DATABASE NAME
$conn = new mysqli("localhost", "wetinde3_demo", "Omomejih08", "wetinde3_ademola");

if(mysqli_connect_errno()){
    printf("connect failed: %s\n", mysqli_connect_error());
    exit();
}

if (!defined('MAIL_PASSWORD')) {
    define('MAIL_PASSWORD', 'celias@2026');
}

?>