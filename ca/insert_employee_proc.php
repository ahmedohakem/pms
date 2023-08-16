<?php
//DATABASE CONNECTION & SESSION CHECK:
include('../includefiles/conn_db.php');
include('../includefiles/sess.php');



mysqli_query($conn, "INSERT INTO `employees` (`first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`,
`job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `religion`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`,
`extension_no`, `work_email_address`, `home_address`, `recorded_by_user_id`)

VALUES ('".mysqli_real_escape_string($conn, $_POST['first_name'])."', '".mysqli_real_escape_string($conn, $_POST['second_name'])."', '".mysqli_real_escape_string($conn, $_POST['third_name'])."', '".mysqli_real_escape_string($conn, $_POST['fourth_name'])."',
'".mysqli_real_escape_string($conn, $_POST['company_id'])."',
'".mysqli_real_escape_string($conn, $_POST['hire_date'])."',
'".mysqli_real_escape_string($conn, $_POST['department_id'])."',
'".mysqli_real_escape_string($conn, $_POST['job_type'])."',
'".mysqli_real_escape_string($conn, $_POST['job_id'])."',
'".mysqli_real_escape_string($conn, $_POST['job_grade_id'])."',
'".mysqli_real_escape_string($conn, $_POST['current_job_join_date'])."',
'".mysqli_real_escape_string($conn, $_POST['manager_employee_id'])."',
'".mysqli_real_escape_string($conn, $_POST['gender'])."',
'".mysqli_real_escape_string($conn, $_POST['nationality_country_id'])."',
'".mysqli_real_escape_string($conn, $_POST['religion'])."',
'".mysqli_real_escape_string($conn, $_POST['date_of_birth'])."',
'".mysqli_real_escape_string($conn, $_POST['national_id'])."',
'".mysqli_real_escape_string($conn, $_POST['work_mobile_no'])."',
'".mysqli_real_escape_string($conn, $_POST['personal_mobile_no'])."',
'".mysqli_real_escape_string($conn, $_POST['extension_no'])."',
'".mysqli_real_escape_string($conn, $_POST['work_email_address'])."',
'".mysqli_real_escape_string($conn, $_POST['home_address'])."',
'".$_SESSION['id']."')")
or die ("<div align='center'><font color='red'><h3>SYSTEM ERROR!!...... TRANSACTION FAILED <a href='insert_employee.php'>click here to re-try again</a>.</h3></font></div>");


header("location:insert_employee.php?msg=Record%20Inserted%20Successfully");
?>