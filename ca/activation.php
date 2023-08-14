<?php
//DATABASE CONNECTION & SESSION CHECK:
include('../includefiles/conn_db.php');
include('../includefiles/sess.php');


if($_POST['user_status'] == 'ACTIVE')
{
mysqli_query($conn, "UPDATE sys_users SET user_status = 'INACTIVE' WHERE employee_id = '".$_POST['employee_id']."'");
$procstatus = "Account inactivated for ID: ".$_POST['employee_id']."";
header('Location:accounts.php?msg='.$procstatus);
}

if($_POST['user_status'] == 'INACTIVE')
{
mysqli_query($conn, "UPDATE sys_users SET user_status = 'ACTIVE' WHERE employee_id = '".$_POST['employee_id']."'");
$procstatus = "Account activated for ID: ".$_POST['employee_id']."";
header('Location:accounts.php?msg='.$procstatus);
}
?>