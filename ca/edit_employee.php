<?php
include('../includefiles/sess.php');
include('../includefiles/conn_db.php');

$SelectQur = mysqli_query($conn, "SELECT * FROM employee_details WHERE employee_id = '".$_POST['employee_id']."'");
while($row = mysqli_fetch_array($SelectQur))
{

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
$third_generation = $row['third_generation'];
$gender = $row['gender'];
$nationality_country_id = $row['nationality_country_id'];
$nationality_country_name = $row['nationality_country_name'];
$religion = $row['religion'];
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
    <td><div align="left"><input type=button onClick="location.href='main.php'" value='Back to Main'>&nbsp;<input type=button onClick="location.href='employees_filter.php'" value='Employees Filter'>&nbsp;<input type=button onClick="location.href='employees.php'" value='Employees List'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>Edit Employee Record| ID: <?php echo $_POST['employee_id']; ?></strong></font></div><hr width="99%"></td>
  </tr>
</table>
</div>
<div align="center" style="border-radius: 5px; background-color: #f2f2f2; padding: 20px;">
<form method="POST" action="edit_employee_proc.php" autocomplete="off">
<input type="hidden" name="employee_id" value="<?php echo $_POST['employee_id']; ?>">
<table width="65%" border="0">
  <tr>
    <td>
<strong>NAME</strong>
	</td>
    <td><span id="sprytextfield1">
    <input type="text" name="first_name" placeholder="First Name ..." size="10" value="<?php echo $first_name; ?>" />
</span>&nbsp;<span id="sprytextfield2">
<input type="text" name="second_name" placeholder="Second Name ..." size="10" value="<?php echo $second_name; ?>" />
</span>&nbsp;<span id="sprytextfield7">
<input type="text" name="third_name" placeholder="Third Name ..." size="10" value="<?php echo $third_name; ?>" />
</span>&nbsp;
<input type="text" name="fourth_name" placeholder="Fourth Name ..." size="10" value="<?php echo $fourth_name; ?>" />
&nbsp;
	</td>
  </tr>
  <tr>
    <td>
<strong>COMPANY</strong>
	</td>
    <td class="form_select"><span id="spryselect1">
      <select name="company_id">
        <option selected value="<?php echo $company_id; ?>"><?php echo $company_name; ?></option>
        <?php
$SelectQur = "SELECT company_id, company_name FROM companies WHERE company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."') AND company_id <> '".$company_id."' AND company_id NOT IN (22, 23, 26)";
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
    <td><span id="sprytextfield4">
    <input type="text" name="hire_date" id="hire_date" size="30" value="<?php echo $hire_date; ?>" />
    </span>&nbsp;<img src="../img/calendar/cal.gif" onclick="javascript:NewCssCal ('hire_date','yyyyMMdd')"  style="cursor:pointer"/></td>
  </tr>
  <tr>
    <td>
<strong>DEPARTMENT</strong>
	</td>
    <td class="form_select"><span id="spryselect2">
      <select name="department_id">
        <option selected value="<?php echo $department_id; ?>"><?php echo $department_name; ?></option>
        <?php
$SelectQur = "SELECT d.department_id, d.department_name, c.company_name FROM departments d, companies c
WHERE d.company_id = c.company_id
AND d.company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."') AND d.department_id <> '".$department_id."'
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
        <option selected value="<?php echo $job_type; ?>"><?php echo $job_type; ?></option>
        <?php if($job_type == 'Supervisor') { ?>
        <option value="Non-Supervisor">Non-Supervisor</option>
        <?php }
	else { ?>
        <option value="Supervisor">Supervisor</option>
        <?php } ?>
      </select>
      </span></td>
  </tr>
  <tr>
    <td>
<strong>JOB TITLE</strong>
	</td>
    <td class="form_select"><span id="spryselect4">
      <select name="job_id">
        <option selected value="<?php echo $job_id; ?>"><?php echo $job_title; ?></option>
        <?php
$SelectQur = "SELECT j.job_id, j.job_title, c.company_name FROM jobs j, companies c
WHERE j.company_id = c.company_id
AND j.company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."')
AND j.job_id <> '".$job_id."'
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
        <option selected value="<?php echo $job_grade_id; ?>"><?php echo $job_grade; ?></option>
        <?php
$SelectQur = "SELECT jg.job_grade_id, CONCAT(jg.category, '-', jg.level, '- ', jg.grade_no, ' ', jg.grade_letter, '- ', c.company_name) AS GradeString
FROM jobs_grades jg, companies c
WHERE c.company_id = jg.company_id
AND c.company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."')
AND jg.job_grade_id <> '".$job_grade_id."'";
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
    <td><span id="sprytextfield5">
    <input type="text" name="current_job_join_date" id="current_job_join_date" size="30" value="<?php echo $current_job_join_date; ?>" />
   </span>&nbsp;<img src="../img/calendar/cal.gif" onclick="javascript:NewCssCal ('current_job_join_date','yyyyMMdd')"  style="cursor:pointer"/></td>
  </tr>
  <tr>
    <td>
<strong>MANAGER</strong>
	</td>
    <td class="form_select"><span id="spryselect6">
      <select name="manager_employee_id">
        <option selected value="<?php echo $manager_employee_id; ?>"><?php echo $manager_full_name; ?></option>
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
      </span></td>
  </tr>
  <tr>
    <td>
<strong>STATUS</strong>
	</td>
    <td class="form_select"><select name="employee_status">
	<option selected value="<?php echo $employee_status; ?>"><?php echo $employee_status; ?></option>
	<?php if($employee_status == 'INACTIVE') { ?>
	<option value="ACTIVE">ACTIVE</option>
	<?php }
	else { ?>
	<option value="INACTIVE">INACTIVE</option>
	<?php } ?>
</select></td>
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
        <option selected value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
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
        <option selected value="<?php if ($nationality_country_id == 247) { echo ""; } else { echo $nationality_country_id;} ?>"><?php echo $nationality_country_name; ?></option>
        <?php
$SelectQur = "SELECT nationality_country_id, nationality_country_name FROM nationalities_countries WHERE nationality_country_id <> '".$nationality_country_id."'";
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
        <option selected value="<?php echo $religion; ?>"><?php echo $religion; ?></option>
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
    <td><span id="sprytextfield9">
    <input type="text" name="date_of_birth" id="date_of_birth" size="30" value="<?php echo $date_of_birth; ?>" />
    </span>&nbsp;<img src="../img/calendar/cal.gif" onclick="javascript:NewCssCal ('date_of_birth','yyyyMMdd')"  style="cursor:pointer"/></td>
  </tr>
  <tr>
    <td>
<strong>NATIONAL ID</strong>
	</td>
    <td>
	<input type="text" name="national_id" size="20" value="<?php echo $national_id; ?>">
	</td>
  </tr>
   <tr>
    <td>
<strong>WORK MOBILE NO.</strong>
	</td>
    <td>
	<input type="text" name="work_mobile_no" size="20" value="<?php echo $work_mobile_no; ?>">
	</td>
  </tr>
   <tr>
    <td>
<strong>EXTENSION NO.</strong>
	</td>
    <td>
	<input type="text" name="extension_no" size="10" value="<?php echo $extension_no; ?>">
	</td>
  </tr>
   <tr>
    <td>
<strong>EMAIL</strong>
	</td>
    <td><span id="sprytextfield6">
    <input type="text" name="work_email_address" size="40" value="<?php echo $work_email_address; ?>" />
    </span><br>* copy & paste this email address if not applicable: <u>na@na.na</u></td>
  </tr>
   <tr>
    <td>
<strong>ADDRESS</strong>
	</td>
    <td>
	<input type="text" name="home_address" size="80" value="<?php echo $home_address; ?>">
	</td>
  </tr>
   <tr>
    <td>
<strong>PERSONAL MOBILE NO.</strong>
	</td>
    <td>
	<input type="text" name="personal_mobile_no" size="20" value="<?php echo $personal_mobile_no; ?>">
	</td>
  </tr>
  
  <tr>
    <td align="center" colspan='2'><p>&nbsp;</p><input type='submit' value='SAVE CHANGES' /></form>
	<form method="POST" action="employees.php"><input type='hidden' name='employee_id' value=''><input type='submit' value='Cancel' /></form></td>
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
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {minChars:3, maxChars:100});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "date", {format:"yyyy-mm-dd"});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4");
var spryselect5 = new Spry.Widget.ValidationSelect("spryselect5");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "date", {format:"yyyy-mm-dd"});
var spryselect6 = new Spry.Widget.ValidationSelect("spryselect6");
var spryselect7 = new Spry.Widget.ValidationSelect("spryselect7");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "email");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {minChars:3, maxChars:100});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none", {minChars:3, maxChars:100});
var spryselect8 = new Spry.Widget.ValidationSelect("spryselect8", {invalidValue:"-1"});
var spryselect9 = new Spry.Widget.ValidationSelect("spryselect9");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "date", {format:"yyyy-mm-dd"});
</script>
</body>
</html>