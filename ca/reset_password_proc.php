<?php
//DATABASE CONNECTION & SESSION CHECK:
include('../includefiles/conn_db.php');
include('../includefiles/sess.php');

// CHECK THE PASSWORDS IS IT MATCHED OR NOT
if($_POST['password'] !== $_POST['re_password']) {
// echo "3";
$procstatus = "Passwords dose not matched for ".$_POST['employee_id']."";
header('Location:accounts.php?msg='.$procstatus);
}
else{
// DOING THE PROCESS
mysqli_query($conn, "UPDATE sys_users SET user_password = md5('".mysqli_real_escape_string($conn, $_POST['password'])."') WHERE employee_id = '".$_POST['employee_id']."'") or die ("<div align='center'><font color='red'><h3>SYSTEM ERROR!!...... TRANSACTION FAILED <a href='accounts.php'>click here to re-try again</a>.</h3></font></div>");
// echo "4";
$procstatus = "Password reset successfully for ".$_POST['employee_id']."";
header('Location:accounts.php?msg='.$procstatus);
}
?>