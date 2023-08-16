<?php
include('includefiles/sess.php');
include('includefiles/conn_db.php');
include('includefiles/settings.php');
include('includefiles/enc.php');
$employee_id = $_POST['employee_id'];
include('includefiles/employee_info.php');
include('includefiles/user_session_info.php');

if (isset($_POST['save_changes'])) {
$SelectQur = mysqli_query($conn, "SELECT obj_id
FROM objectives
WHERE employee_id = '".$_POST['employee_id']."'");
if(mysqli_num_rows($SelectQur) == 0) {
// echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
while($row = mysqli_fetch_array($SelectQur))
{
mysqli_query($conn, "UPDATE objectives SET obj_rating = '".$_POST[$row['obj_id']]."' WHERE obj_id = '".$row['obj_id']."'");
}
}

$SelectQur = mysqli_query($conn, "SELECT c.comp_id
FROM competencies c, employees_competencies empc
WHERE c.comp_id = empc.comp_id
AND c.comp_year = '".$current_cycle_year."'
AND empc.employee_id = '".$_POST['employee_id']."'");
if(mysqli_num_rows($SelectQur) == 0) {
// echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
while($row = mysqli_fetch_array($SelectQur))
{
mysqli_query($conn, "UPDATE employees_competencies SET comp_rating = '".$_POST[$row['comp_id']]."' WHERE comp_id = '".$row['comp_id']."' AND employee_id = '".$_POST['employee_id']."'");
}
}
mysqli_query($conn, "INSERT INTO form_tracker (employee_id, status_code, status_text) VALUES ('".$_POST['employee_id']."', '1', 'Changing')");
$ProcStatus = 1;
header("location:evaluation.php?employee_id=".encrypt_decrypt('encrypt', $_POST['employee_id'])."&ps=".$ProcStatus);
}





if (isset($_POST['submit_to_dm'])) {
$SelectQur = mysqli_query($conn, "SELECT obj_id
FROM objectives
WHERE employee_id = '".$_POST['employee_id']."'");
if(mysqli_num_rows($SelectQur) == 0) {
// echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
while($row = mysqli_fetch_array($SelectQur))
{
mysqli_query($conn, "UPDATE objectives SET obj_rating = '".$_POST[$row['obj_id']]."' WHERE obj_id = '".$row['obj_id']."'");
}
$SelectQur = mysqli_query($conn, "SELECT employee_id FROM objectives WHERE obj_rating IS NULL AND obj_year = '".$current_cycle_year."' AND employee_id = '".$_POST['employee_id']."'");
if(mysqli_num_rows($SelectQur) == 0) {
// DO NOTHING
}
else
{
$ProcStatus = 2;
mysqli_query($conn, "INSERT INTO form_tracker (employee_id, status_code, status_text) VALUES ('".$_POST['employee_id']."', '1', 'Changing')");
header("location:evaluation.php?employee_id=".encrypt_decrypt('encrypt', $_POST['employee_id'])."&ps=".$ProcStatus);
die();
}
}

$SelectQur = mysqli_query($conn, "SELECT c.*, empc.*
FROM competencies c, employees_competencies empc
WHERE c.comp_id = empc.comp_id
AND c.comp_year = '".$current_cycle_year."'
AND empc.employee_id = '".$_POST['employee_id']."'");
if(mysqli_num_rows($SelectQur) == 0) {
// echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
while($row = mysqli_fetch_array($SelectQur))
{
mysqli_query($conn, "UPDATE employees_competencies SET comp_rating = '".$_POST[$row['comp_id']]."' WHERE comp_id = '".$row['comp_id']."' AND employee_id = '".$_POST['employee_id']."'");
}
$SelectQur = mysqli_query($conn, "SELECT employee_id FROM employees_competencies WHERE comp_rating IS NULL AND comp_id IN (SELECT comp_id FROM competencies WHERE comp_year = '".$current_cycle_year."') AND employee_id = '".$_POST['employee_id']."'");
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
mysqli_query($conn, "INSERT INTO form_tracker (employee_id, status_code, status_text) VALUES ('".$_POST['employee_id']."', '1', 'Changing')");
header("location:evaluation.php?employee_id=".encrypt_decrypt('encrypt', $_POST['employee_id'])."&ps=".$ProcStatus);
die();
}
}

}
?>