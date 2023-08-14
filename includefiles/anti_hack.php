<?php
if(! ( is_numeric($employee_id)  ))
{
header("location:logout.php");
}
$SelectQur = mysqli_query($conn, "SELECT * FROM employees WHERE manager_employee_id = (SELECT employee_id FROM sys_users WHERE sys_user_id = '".$_SESSION['id']."') AND employee_id = '".$employee_id."'");
if(mysqli_num_rows($SelectQur) == 0) {
header("location:logout.php");
}
?>