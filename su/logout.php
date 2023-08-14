<?php
include('../includefiles/conn_db.php');
include('../includefiles/sess.php');

$logidqur = mysqli_query($conn, "SELECT max(log_id) AS maxlogid FROM sys_user_logs WHERE sys_user_id = '".$_SESSION['id']."'");
while($row = mysqli_fetch_array($logidqur))
{
$logidvar = $row['maxlogid'];
}

mysqli_query($conn, "UPDATE sys_user_logs SET log_out_timestamp = NOW() WHERE log_id = '$logidvar'");
unset($_SESSION['id']);
session_destroy();
header('Location:index.php');
?>