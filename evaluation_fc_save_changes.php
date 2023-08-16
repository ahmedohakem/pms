<?php
include('includefiles/sess.php');
include('includefiles/conn_db.php');
include('includefiles/settings.php');
include('includefiles/enc.php');
$employee_id = $_POST['employee_id'];
include('includefiles/employee_info.php');
include('includefiles/user_session_info.php');



if (isset($_POST['save_changes'])) {

$SelectQur = mysqli_query($conn, "SELECT wd.wd_id
FROM work_dimensions wd, employees_work_dimensions empwd
WHERE wd.wd_id = empwd.wd_id
AND wd.wd_year = '".$current_cycle_year."'
AND empwd.employee_id = '".$_POST['employee_id']."'");
if(mysqli_num_rows($SelectQur) == 0) {
// 
}
else
{
while($row = mysqli_fetch_array($SelectQur))
{
mysqli_query($conn, "UPDATE employees_work_dimensions SET wd_rating = '".$_POST[$row['wd_id']]."' WHERE wd_id = '".$row['wd_id']."' AND employee_id = '".$_POST['employee_id']."'");
}
mysqli_query($conn, "UPDATE employees_work_dimensions SET wd_rating = NULL WHERE wd_rating = '0' AND employee_id = '".$_POST['employee_id']."'");
}
mysqli_query($conn, "INSERT INTO form_tracker (employee_id, status_code, status_text) VALUES ('".$_POST['employee_id']."', '1', 'Changing')");
$ProcStatus = 1;
header("location:evaluation_fc.php?employee_id=".encrypt_decrypt('encrypt', $_POST['employee_id'])."&ps=".$ProcStatus);
}


if (isset($_POST['submit_to_dm'])) {

$SelectQur = mysqli_query($conn, "SELECT wd.wd_id
FROM work_dimensions wd, employees_work_dimensions empwd
WHERE wd.wd_id = empwd.wd_id
AND wd.wd_year = '".$current_cycle_year."'
AND empwd.employee_id = '".$_POST['employee_id']."'");
if(mysqli_num_rows($SelectQur) == 0) {
//
}
else
{
while($row = mysqli_fetch_array($SelectQur))
{
mysqli_query($conn, "UPDATE employees_work_dimensions SET wd_rating = '".$_POST[$row['wd_id']]."' WHERE wd_id = '".$row['wd_id']."' AND employee_id = '".$_POST['employee_id']."'");
}
$SelectQur = mysqli_query($conn, "SELECT employee_id FROM employees_work_dimensions WHERE wd_rating = '0' AND employee_id = '".$_POST['employee_id']."'");
if(mysqli_num_rows($SelectQur) == 0) {
if ($current_session_employee_id == $current_session_manager_employee_id)
{
mysqli_query($conn, "INSERT INTO form_tracker (employee_id, status_code, status_text) VALUES ('".$_POST['employee_id']."', '4', 'Approved')");
header("location:employees.php");
die();
}
else
{
mysqli_query($conn, "INSERT INTO form_tracker (employee_id, status_code, status_text) VALUES ('".$_POST['employee_id']."', '2', 'Pending for Approval')");
include('includefiles/pending_for_approval_email.php');
header("location:employees.php");
die();
}
}
else
{
$ProcStatus = 3;
mysqli_query($conn, "UPDATE employees_work_dimensions SET wd_rating = NULL WHERE wd_rating = '0' AND employee_id = '".$_POST['employee_id']."'");
mysqli_query($conn, "INSERT INTO form_tracker (employee_id, status_code, status_text) VALUES ('".$_POST['employee_id']."', '1', 'Changing')");
header("location:evaluation_fc.php?employee_id=".encrypt_decrypt('encrypt', $_POST['employee_id'])."&ps=".$ProcStatus);
die();
}
}

}
?>