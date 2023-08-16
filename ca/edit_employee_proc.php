<?php
//DATABASE CONNECTION & SESSION CHECK:
include('../includefiles/conn_db.php');
include('../includefiles/sess.php');

if (empty($_POST['hire_date']) OR $_POST['hire_date'] == '0000-00-00') { $hire_date = '0000-00-00' ; }
else { $hire_date = $_POST['hire_date']; }

if (empty($_POST['current_job_join_date']) OR $_POST['current_job_join_date'] == '0000-00-00') { $current_job_join_date = '0000-00-00' ; }
else { $current_job_join_date = $_POST['current_job_join_date']; }

if (empty($_POST['date_of_birth']) OR $_POST['date_of_birth'] == '0000-00-00') { $date_of_birth = '0000-00-00' ; }
else { $date_of_birth = $_POST['date_of_birth']; }

mysqli_query($conn, "SET @usersession = '".$_SESSION['id']."'");
mysqli_query($conn, "UPDATE employees SET
first_name = '".mysqli_real_escape_string($conn, $_POST['first_name'])."',
second_name = '".mysqli_real_escape_string($conn, $_POST['second_name'])."',
third_name = '".mysqli_real_escape_string($conn, $_POST['third_name'])."',
fourth_name = '".mysqli_real_escape_string($conn, $_POST['fourth_name'])."',
company_id = '".$_POST['company_id']."',
hire_date = '".$hire_date."',
department_id = '".$_POST['department_id']."',
job_type = '".$_POST['job_type']."',
job_id = '".$_POST['job_id']."',
job_grade_id = '".$_POST['job_grade_id']."',
current_job_join_date = '".$current_job_join_date."',
manager_employee_id = '".$_POST['manager_employee_id']."',
gender = '".$_POST['gender']."',
nationality_country_id = '".$_POST['nationality_country_id']."',
religion = '".mysqli_real_escape_string($conn, $_POST['religion'])."',
date_of_birth = '".$date_of_birth."',
national_id = '".mysqli_real_escape_string($conn, $_POST['national_id'])."',
work_mobile_no = '".mysqli_real_escape_string($conn, $_POST['work_mobile_no'])."',
personal_mobile_no = '".mysqli_real_escape_string($conn, $_POST['personal_mobile_no'])."',
extension_no = '".mysqli_real_escape_string($conn, $_POST['extension_no'])."',
work_email_address = '".mysqli_real_escape_string($conn, $_POST['work_email_address'])."',
home_address = '".mysqli_real_escape_string($conn, $_POST['home_address'])."',
employee_status = '".$_POST['employee_status']."'
WHERE employee_id = '".$_POST['employee_id']."'") or die ("<div align='center'><font color='red'><h3>SYSTEM ERROR!!...... TRANSACTION FAILED <a href='employees.php'>click here to re-try again</a>.</h3></font></div>".mysqli_error($conn));

mysqli_query($conn, "UPDATE employees SET hire_date = NULL WHERE hire_date = '0000-00-00'");
mysqli_query($conn, "UPDATE employees SET current_job_join_date = NULL WHERE current_job_join_date = '0000-00-00'");
mysqli_query($conn, "UPDATE employees SET date_of_birth = NULL WHERE date_of_birth = '0000-00-00'");

$procstatus = "Record Edited Successfully for ID: ".$_POST['employee_id']."";
header('Location:employees.php?msg='.$procstatus);
?>