<?php
//DATABASE CONNECTION & SESSION CHECK:
include('../includefiles/conn_db.php');
include('../includefiles/sess.php');


$SelectQur = mysqli_query($conn, "SELECT employee_id FROM employees WHERE manager_employee_id = '".$_POST['employee_id']."' AND employee_status = 'ACTIVE' AND deleted = '0'");
if(mysqli_num_rows($SelectQur) == 0) {
mysqli_query($conn, "UPDATE employees SET deleted = 1 WHERE employee_id = '".$_POST['employee_id']."'") or die ("<div align='center'><font color='red'><h3>SYSTEM ERROR!!...... TRANSACTION FAILED <a href='employees.php'>click here to re-try again</a>.</h3></font></div>");
mysqli_query($conn, "UPDATE sys_users SET user_status = 'INACTIVE' WHERE employee_id = '".$_POST['employee_id']."'");
$procstatus = "Record Deleted Successfully for ".$_POST['employee_id']."";
header('Location:employees.php?msg='.$procstatus);
}
else
{
$procstatus = "Record cannot be deleted ..... Direct Manager's Case for ".$_POST['employee_id']."";
header('Location:employees.php?msg='.$procstatus);
}
?>