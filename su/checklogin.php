<?php
include('../includefiles/conn_db.php');
session_start();

$CheckQur = mysqli_query ($conn, "SELECT * FROM sys_users WHERE username = '".$_POST["uname"]."' AND user_password = '".mysqli_real_escape_string($conn, MD5($_POST['upassword']))."' AND user_status = 'ACTIVE' AND user_level LIKE  '__1_%'");
$row=mysqli_fetch_array($CheckQur);
if($row)
{
$_SESSION['id'] = $row['sys_user_id'];
mysqli_query($conn, "INSERT INTO sys_user_logs (sys_user_id, log_in_timestamp, log_in_ip) VALUES (".$row['sys_user_id'].", NOW(), '".mysqli_real_escape_string($conn, $_SERVER["REMOTE_ADDR"])."')") or die ('000'); 
header('Location:main.php');
}
else
{
header("location:index.php?msg=Wrong%20Username%20or%20Password");
}
?>