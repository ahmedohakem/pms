<?php
//DATABASE CONNECTION & SESSION CHECK:
include('../includefiles/conn_db.php');
include('../includefiles/sess.php');

// CHECK THE PASSWORDS IS IT MATCHED OR NOT
if($_POST['password'] !== $_POST['re_password']) {
// echo "3";
$procstatus = "Passwords dose not matched!!";
header('Location:create_account.php?msg='.$procstatus);
}
else{
// DOING THE PROCESS
mysqli_query($conn, "INSERT INTO `sys_users` (`employee_id`, `username`, `user_password`, `user_level`) VALUES ('".$_POST['employee_id']."', '".$_POST['employee_id']."', md5('".mysqli_real_escape_string($conn, $_POST['password'])."'), '0001')") or die ("<div align='center'><font color='red'><h3>SYSTEM ERROR!!...... TRANSACTION FAILED <a href='create_account.php'>click here to re-try again</a>.</h3></font></div>");
// echo "4";
$procstatus = "Account created successfully";
header('Location:create_account.php?msg='.$procstatus);
}
?>