<?php
include('includefiles/sess.php');
include('includefiles/conn_db.php');
include('includefiles/enc.php');
$employee_id = $_POST['employee_id'];
include('includefiles/employee_info.php');
include('includefiles/user_session_info.php');

if (isset($_POST['approve'])) {
mysqli_query($conn, "INSERT INTO form_tracker (employee_id, status_code, status_text, reviewing_manager_comment) VALUES ('".$_POST['employee_id']."', '4', 'Approved', '".mysqli_real_escape_string($conn, $_POST['reviewing_manager_comment'])."')");
include('includefiles/approved_email.php');
header("location:employees.php");
die();
}

if (isset($_POST['return_to_review'])) {
mysqli_query($conn, "INSERT INTO form_tracker (employee_id, status_code, status_text, reviewing_manager_comment) VALUES ('".$_POST['employee_id']."', '3', 'Returned to Review', '".mysqli_real_escape_string($conn, $_POST['reviewing_manager_comment'])."')");
include('includefiles/return_to_review_email.php');
header("location:employees.php");
}
?>