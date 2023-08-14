<?php
$SelectQur = mysqli_query($conn, "SELECT * FROM employee_details WHERE employee_id = '".$employee_id."'");
while($row = mysqli_fetch_array($SelectQur))
{

$employee_id = $row['employee_id'];
$first_name = $row['first_name'];
$second_name = $row['second_name'];
$third_name = $row['third_name'];
$fourth_name = $row['fourth_name'];
$full_name = $row['full_name'];
$company_id = $row['company_id'];
$company_name = $row['company_name'];
$hire_date = $row['hire_date'];
$department_id = $row['department_id'];
$department_name = $row['department_name'];
$job_type = $row['job_type'];
$job_id = $row['job_id'];
$job_title = $row['job_title'];
$job_grade_id = $row['job_grade_id'];
$job_grade = $row['job_grade'];
$current_job_join_date = $row['current_job_join_date'];
$manager_employee_id = $row['manager_employee_id'];
$manager_full_name = $row['manager_full_name'];
$reviewing_manager_employee_id = $row['reviewing_manager_employee_id'];
$reviewing_manager_full_name = $row['reviewing_manager_full_name'];
$gender = $row['gender'];
$nationality_country_id = $row['nationality_country_id'];
$nationality_country_name = $row['nationality_country_name'];
$date_of_birth = $row['date_of_birth'];
$national_id = $row['national_id'];
$work_mobile_no = $row['work_mobile_no'];
$personal_mobile_no = $row['personal_mobile_no'];
$extension_no = $row['extension_no'];
$work_email_address = $row['work_email_address'];
$home_address = $row['home_address'];
$employee_status = $row['employee_status'];

}
?>