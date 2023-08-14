<?php
include('../includefiles/sess.php');
include('../includefiles/conn_db.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?php include('../includefiles/title.php'); ?></title>

<link rel="stylesheet" href="../css/style.css" />
<!-- favicon links -->
<link rel="shortcut icon" type="image/ico" href="../img/icons/favicon.ico" />
<link rel="icon" type="image/ico" href="../img/icons/favicon.ico" />

<script src="../css/datetimepicker_css.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
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
    <td><div align="left"><input type=button onClick="location.href='main.php'" value='Back to Main'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>Add New Employee</strong></font></div><hr width="99%"></td>
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
<form method="POST" action="insert_employee_proc.php" autocomplete="off">
<table width="65%" border="0">
  <tr>
    <td>
<strong>NAME</strong>
	</td>
    <td><span id="sprytextfield1">
    <input type="text" name="first_name" placeholder="First Name ..." size="10" value="" />
    </span>&nbsp;
	<span id="sprytextfield2">
    <input type="text" name="second_name" placeholder="Second Name ..." size="10" value="" />
    </span>&nbsp;<span id="sprytextfield6">
    <input type="text" name="third_name" placeholder="Third Name ..." size="10" value="" />
    </span>&nbsp;
    <input type="text" name="fourth_name" placeholder="Fourth Name ..." size="10" value="" />
    &nbsp;
	</td>
  </tr>
  <tr>
    <td>
<strong>COMPANY</strong>
	</td>
    <td class="form_select"><span id="spryselect1">
      <select name="company_id">
        <option selected value="">--- Select Company ---</option>
        <?php
$SelectQur = "SELECT company_id, company_name FROM companies WHERE company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."' AND company_id NOT IN (22, 23, 26))";
$SelectQurRun = mysqli_query($conn, $SelectQur);
while($row=mysqli_fetch_array($SelectQurRun))
{
echo '<option value="'.$row['company_id'].'">'.$row['company_name'].'</option>';
}
?>
      </select>
      </span></td>
  </tr>
  <tr>
    <td>
<strong>HIRE DATE</strong>
	</td>
    <td><span id="sprytextfield3">
      <input type="text" name="hire_date" id="hire_date" size="30" value="" />
      </span>&nbsp;<img src="../img/calendar/cal.gif" onclick="javascript:NewCssCal ('hire_date','yyyyMMdd')"  style="cursor:pointer"/></td>
  </tr>
  <tr>
    <td>
<strong>DEPARTMENT</strong>
	</td>
    <td class="form_select"><span id="spryselect2">
      <select name="department_id">
        <option selected value="">--- Select Department ---</option>
        <?php
$SelectQur = "SELECT d.department_id, d.department_name, c.company_name FROM departments d, companies c
WHERE d.company_id = c.company_id
AND d.company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."')
ORDER BY c.company_name, d.department_name";
$SelectQurRun = mysqli_query($conn, $SelectQur);
while($row=mysqli_fetch_array($SelectQurRun))
{
echo '<option value="'.$row['department_id'].'">'.$row['department_name'].' || '.$row['company_name'].'</option>';
}
?>
      </select>
</span></td>
  </tr>
  <tr>
    <td>
<strong>JOB TYPE</strong>
	</td>
    <td class="form_select"><span id="spryselect3">
      <select name="job_type">
        <option selected value="">--- Select Job Type ---</option>
        <option value="Supervisor">Supervisor</option>
        <option value="Non-Supervisor">Non-Supervisor</option>
      </select>
      </span></td>
  </tr>
  <tr>
    <td>
<strong>JOB TITLE</strong>
	</td>
    <td class="form_select"><span id="spryselect4">
      <select name="job_id">
        <option selected value="">--- Select Job Title ---</option>
        <?php
$SelectQur = "SELECT j.job_id, j.job_title, c.company_name FROM jobs j, companies c
WHERE j.company_id = c.company_id
AND j.company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."')
ORDER BY c.company_name, j.job_title";
$SelectQurRun = mysqli_query($conn, $SelectQur);
while($row=mysqli_fetch_array($SelectQurRun))
{
echo '<option value="'.$row['job_id'].'">'.$row['job_title'].' || '.$row['company_name'].'</option>';
}
?>
      </select>
      </span></td>
  </tr>
  <tr>
    <td>
<strong>JOB GRADE</strong>
	</td>
    <td class="form_select"><span id="spryselect5">
      <select name="job_grade_id">
        <option selected value="">--- Select Job Grade ---</option>
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
?>
      </select>
      </span></td>
  </tr>
  <tr>
    <td>
<strong>JOB JOINING DATE</strong>
	</td>
    <td><span id="sprytextfield4">
    <input type="text" name="current_job_join_date" id="current_job_join_date" size="30" value="" />
    </span>&nbsp;<img src="../img/calendar/cal.gif" onclick="javascript:NewCssCal ('current_job_join_date','yyyyMMdd')"  style="cursor:pointer"/></td>
  </tr>
  <tr>
    <td>
<strong>MANAGER</strong>
	</td>
    <td class="form_select"><span id="spryselect6">
      <select name="manager_employee_id">
        <option selected value="">--- Select Manager ---</option>
        <?php
$SelectQur = "SELECT employee_id, full_name, company_name FROM employee_details
WHERE job_type = 'Supervisor'
AND company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."')
ORDER BY company_name, full_name";
$SelectQurRun = mysqli_query($conn, $SelectQur);
while($row=mysqli_fetch_array($SelectQurRun))
{
echo '<option value="'.$row['employee_id'].'">'.$row['full_name'].' || '.$row['company_name'].'</option>';
}
?>
      </select>
     </span><br><br></td>
  </tr>

  
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>  
  
  <tr>
    <td>
<strong>GENDER</strong>
	</td>
    <td class="form_select"><span id="spryselect7">
      <select name="gender">
        <option selected value="">--- Select Gender ---</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
      </span></td>
  </tr>
   <tr>
    <td>
<strong>NATIONALITY</strong>
	</td>
    <td class="form_select"><span id="spryselect8">
      <select name="nationality_country_id">
        <option selected value="">--- Select Nationality ---</option>
        <?php
$SelectQur = "SELECT nationality_country_id, nationality_country_name FROM nationalities_countries";
$SelectQurRun = mysqli_query($conn, $SelectQur);
while($row=mysqli_fetch_array($SelectQurRun))
{
echo '<option value="'.$row['nationality_country_id'].'">'.$row['nationality_country_name'].'</option>';
}
?>
      </select>
      </span></td>
  </tr>
  <tr>
    <td>
<strong>RELIGION</strong>
	</td>
    <td class="form_select"><span id="spryselect9">
      <select name="religion">
        <option selected value="">--- Select Religion ---</option>
        <option value="Islam">Islam</option>
        <option value="Christianity">Christianity</option>
        <option value="Other">Other</option>
      </select>
      </span></td>
  </tr>
  <tr>
    <td>
<strong>BIRTH DATE</strong>
	</td>
    <td><span id="sprytextfield8">
    <input type="text" name="date_of_birth" id="date_of_birth" size="30" value="" />
    </span>&nbsp;<img src="../img/calendar/cal.gif" onclick="javascript:NewCssCal ('date_of_birth','yyyyMMdd')"  style="cursor:pointer"/></td>
  </tr>
  <tr>
    <td>
<strong>NATIONAL ID</strong>
	</td>
    <td>
	<input type="text" name="national_id" size="20" value="">
	</td>
  </tr>
   <tr>
    <td>
<strong>WORK MOBILE NO.</strong>
	</td>
    <td>
	<input type="text" name="work_mobile_no" size="20" value="">
	</td>
  </tr>
   <tr>
    <td>
<strong>EXTENSION NO.</strong>
	</td>
    <td>
	<input type="text" name="extension_no" size="10" value="">
	</td>
  </tr>
   <tr>
    <td>
<strong>EMAIL</strong>
	</td>
    <td><span id="sprytextfield5">
    <input type="text" name="work_email_address" size="40" value="" />
    </span><br>* copy & paste this email address if not applicable: <u>na@na.na</u></td>
  </tr>
   <tr>
    <td>
<strong>ADDRESS</strong>
	</td>
    <td>
	<input type="text" name="home_address" size="80" value="">
	</td>
  </tr>
   <tr>
    <td>
<strong>PERSONAL MOBILE NO.</strong>
	</td>
    <td>
	<input type="text" name="personal_mobile_no" size="20" value="">
	</td>
  </tr>
  
  <tr>
    <td colspan="2" align="center">
	<p>&nbsp;</p>
	<input type="submit" value="SAVE EMPLOYEE"></td>
  </tr>
</table>
</form>
</div>
<div align="center">
<?php
include('../includefiles/footer.php');
?>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {minChars:3, maxChars:100});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {minChars:3, maxChars:100});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "date", {format:"yyyy-mm-dd"});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3");
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4");
var spryselect5 = new Spry.Widget.ValidationSelect("spryselect5");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "date", {format:"yyyy-mm-dd"});
var spryselect6 = new Spry.Widget.ValidationSelect("spryselect6");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "email");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {minChars:3});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {minChars:3});
var spryselect7 = new Spry.Widget.ValidationSelect("spryselect7");
var spryselect8 = new Spry.Widget.ValidationSelect("spryselect8");
var spryselect9 = new Spry.Widget.ValidationSelect("spryselect9");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "date", {format:"yyyy-mm-dd"});
</script>
</body>
</html>