<?php
$conn = mysqli_connect ("DB_SERVER_HOST", "DB_SERVER_USERNAME", "DB_SERVER_PASSWORD") or die ('000');
mysqli_select_db($conn, "DB_NAME") or die ('0000');
mysqli_query($conn, "SET NAMES utf8;");
mysqli_query($conn, "SET CHARACTER_SET utf8;");
?>
