<?php
$conn = mysqli_connect ("217.199.187.72", "cl53-pms", "BstcBstc@70") or die ('000');
mysqli_select_db($conn, "cl53-pms") or die ('0000');
mysqli_query($conn, "SET NAMES utf8;");
mysqli_query($conn, "SET CHARACTER_SET utf8;");
?>