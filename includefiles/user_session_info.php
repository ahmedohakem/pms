<?php
$SelectQur = mysqli_query($conn, "SELECT * FROM employee_details WHERE employee_id = (SELECT employee_id FROM sys_users WHERE sys_user_id = '".$_SESSION['id']."')");
while($row = mysqli_fetch_array($SelectQur))
{

$current_session_employee_id = $row['employee_id'];
$current_session_first_name = $row['first_name'];
$current_session_second_name = $row['second_name'];
$current_session_third_name = $row['third_name'];
$current_session_fourth_name = $row['fourth_name'];
$current_session_full_name = $row['full_name'];
$current_session_company_id = $row['company_id'];
$current_session_company_name = $row['company_name'];
$current_session_hire_date = $row['hire_date'];
$current_session_department_id = $row['department_id'];
$current_session_department_name = $row['department_name'];
$current_session_job_type = $row['job_type'];
$current_session_job_id = $row['job_id'];
$current_session_job_title = $row['job_title'];
$current_session_job_grade_id = $row['job_grade_id'];
$current_session_job_grade = $row['job_grade'];
$current_session_current_job_join_date = $row['current_job_join_date'];
$current_session_manager_employee_id = $row['manager_employee_id'];
$current_session_manager_full_name = $row['manager_full_name'];
$current_session_reviewing_manager_employee_id = $row['reviewing_manager_employee_id'];
$current_session_reviewing_manager_full_name = $row['reviewing_manager_full_name'];
$current_session_gender = $row['gender'];
$current_session_nationality_country_id = $row['nationality_country_id'];
$current_session_nationality_country_name = $row['nationality_country_name'];
$current_session_date_of_birth = $row['date_of_birth'];
$current_session_national_id = $row['national_id'];
$current_session_work_mobile_no = $row['work_mobile_no'];
$current_session_personal_mobile_no = $row['personal_mobile_no'];
$current_session_extension_no = $row['extension_no'];
$current_session_work_email_address = $row['work_email_address'];
$current_session_home_address = $row['home_address'];
$current_session_employee_status = $row['employee_status'];

}
?>