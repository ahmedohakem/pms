<?php
include('../includefiles/sess.php');
include('../includefiles/conn_db.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include('../includefiles/title.php'); ?></title>

<link rel="stylesheet" href="../css/style.css" />
<!-- favicon links -->
<link rel="shortcut icon" type="image/ico" href="../img/icons/favicon.ico" />
<link rel="icon" type="image/ico" href="../img/icons/favicon.ico" />

<script src="../css/datetimepicker_css.js"></script>
</head>
<body>
<div align="center">
<table width="90%" border="0">
  <tr>
    <td align="left"><img src="../img/logo.png" width="208px" height="146px"></td>
  </tr>
  </table>
  <table width="60%" border="0">
    <tr>
    <td><div align="left"><input type=button onClick="location.href='main.php'" value='Back to Main'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>Employees Records Filter</strong></font></div><hr width="99%"></td>
  </tr>
</table>
</div>
<div align="center" style="border-radius: 5px; background-color: #f2f2f2; padding: 20px;">
<font color="blue">
<?php
if (isset($_GET['msg'])){
 error_reporting (E_ALL ^ E_NOTICE);
 echo $_GET['msg']."<br><br>";
 }
?>
</font>
<form method="POST" action="employees.php" autocomplete="off">
<table width="50%" border="0">
  <tr>
    <td><input type="text" name="name" placeholder="Employee Name ..." size="50">&nbsp;<input type="text" name="employee_id" placeholder="Employee ID ..." size="10"></td>
  </tr>
  <tr>
    <td class="form_select"><select name="company"><option selected value="">--- Select Company ---</option>
<?php
$SelectQur = "SELECT company_id, company_name FROM companies WHERE company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."' AND company_id NOT IN (22, 23, 26))";
$SelectQurRun = mysqli_query($conn, $SelectQur);
while($row=mysqli_fetch_array($SelectQurRun))
{
echo '<option value="'.$row['company_id'].'">'.$row['company_name'].'</option>';
}
?></select></td>
  </tr>
  <tr>
    <td><input type="text" name="hire_date1" id="hire_date1" placeholder="Hire Date From ..." size="30" readonly = "readonly">&nbsp;<img src="../img/calendar/cal.gif" onclick="javascript:NewCssCal ('hire_date1','yyyyMMdd')"  style="cursor:pointer"/> &nbsp; <input type="text" name="hire_date2" id="hire_date2" placeholder="Hire Date To ..." size="30" readonly = "readonly">&nbsp;<img src="../img/calendar/cal.gif" onclick="javascript:NewCssCal ('hire_date2','yyyyMMdd')"  style="cursor:pointer"/></td>
  </tr>
  <tr>
    <td class="form_select"><select name="department"><option selected value="">--- Select Department ---</option>
<?php
$SelectQur = "SELECT DISTINCT department_name FROM departments WHERE company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."')";
$SelectQurRun = mysqli_query($conn, $SelectQur);
while($row=mysqli_fetch_array($SelectQurRun))
{
echo '<option value="'.$row['department_name'].'">'.$row['department_name'].'</option>';
}
?></select></td>
  </tr>
  <tr>
    <td class="form_select"><select name="job_type">
	<option selected value="">--- Select Job Type ---</option>
	<option value="Supervisor">Supervisor</option>
	<option value="Non-Supervisor">Non-Supervisor</option>
</select></td>
  </tr>
  <tr>
    <td class="form_select"><select name="job_title"><option selected value="">--- Select Job Title ---</option>
<?php
$SelectQur = "SELECT DISTINCT job_title FROM jobs WHERE company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."')";
$SelectQurRun = mysqli_query($conn, $SelectQur);
while($row=mysqli_fetch_array($SelectQurRun))
{
echo '<option value="'.$row['job_title'].'">'.$row['job_title'].'</option>';
}
?></select></td>
  </tr>
  <tr>
    <td class="form_select"><select name="job_grade"><option selected value="">--- Select Job Grade ---</option>
<?php
$SelectQur = "SELECT jg.job_grade_id, CONCAT(jg.category, '-', jg.level, '- ', jg.grade_no, ' ', jg.grade_letter, '- ', c.company_name) AS GradeString
FROM jobs_grades jg, companies c
WHERE c.company_id = jg.company_id
AND c.company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."')";
$SelectQurRun = mysqli_query($conn, $SelectQur);
while($row=mysqli_fetch_array($SelectQurRun))
{
echo '<option value="'.$row['job_grade_id'].'">'.$row['GradeString'].'</option>';
}
?></select></td>
  </tr>
<!--  <tr>
    <td><input type="text" name="job_date1" id="job_date1" placeholder="Job Joining Date From ..." size="30" readonly = "readonly">&nbsp;<img src="../img/calendar/cal.gif" onclick="javascript:NewCssCal ('hire_date1','yyyyMMdd')"  style="cursor:pointer"/> &nbsp; <input type="text" name="job_date2" id="job_date2" placeholder="Job Joining Date To ..." size="30" readonly = "readonly">&nbsp;<img src="../img/calendar/cal.gif" onclick="javascript:NewCssCal ('hire_date2','yyyyMMdd')"  style="cursor:pointer"/></td>
  </tr> -->
  <tr>
    <td class="form_select"><select name="direct_manager"><option selected value="">--- Select Direct Manager ---</option>
<?php
$SelectQur = "SELECT employee_id, full_name FROM employee_details WHERE employee_id IN (SELECT manager_employee_id FROM employees) AND company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."')";
$SelectQurRun = mysqli_query($conn, $SelectQur);
while($row=mysqli_fetch_array($SelectQurRun))
{
echo '<option value="'.$row['employee_id'].'">'.$row['full_name'].'</option>';
}
?></select></td>
  </tr>
  <tr>
    <td class="form_select"><select name="reviwing_manager"><option selected value="">--- Select Reviewing Manager ---</option>
<?php
$SelectQur = "SELECT employee_id, full_name FROM employee_details WHERE employee_id IN (SELECT reviewing_manager_employee_id FROM employee_details)";
$SelectQurRun = mysqli_query($conn, $SelectQur);
while($row=mysqli_fetch_array($SelectQurRun))
{
echo '<option value="'.$row['employee_id'].'">'.$row['full_name'].'</option>';
}
?></select></td>
  </tr>
  <tr>
    <td align="center">
	<p>&nbsp;</p>
	<input type="submit" value="SEARCH"></td>
  </tr>
</table>
</form>
</div>
<div align="center">
<?php
include('../includefiles/footer.php');
?>
</div>
</body>
</html>