<?php
include('includefiles/sess.php');
include('includefiles/conn_db.php');
include('includefiles/settings.php');
include('includefiles/enc.php');
if (isset($_GET['employee_id'])){
$employee_id = encrypt_decrypt('decrypt', $_GET['employee_id']);
}
else
{
$employee_id = $_POST['employee_id'];
}
include('includefiles/employee_info.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include('includefiles/title.php'); ?></title>
<link rel="stylesheet" href="css/style.css" />
<!-- favicon links -->
<link rel="shortcut icon" type="image/ico" href="img/icons/favicon.ico" />
<link rel="icon" type="image/ico" href="favicon.ico" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div align="center">
<table width="90%" border="0">
  <tr>
    <td align="left"><img src="img/logo.png" width="208px" height="146px"></td>
  </tr>
  </table>
  <table width="60%" border="0">
    <tr>
    <td><div align="left"><input type=button onClick="location.href='employees.php'" value='Staff Under Your Supervision'>&nbsp;<input type=button onClick="location.href='logout.php'" value='LogOut'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>Add <?php echo $current_cycle_year; ?> Objective</strong></font></div><hr width="99%"></td>
  </tr>
</table>
<div class="styled">
<table width="60%" border="0">
  <tr>
    <td width="20%"><strong>Employee Name:</strong></td>
    <td><code><?php echo $full_name; ?></code></td>
  </tr>
  <tr>
    <td width="20%"><strong>Ref.</strong></td>
    <td><code><?php echo $employee_id; ?></code></td>
  </tr>
  <tr>
    <td width="20%"><strong>Company:</strong></td>
    <td><code><?php echo $company_name; ?></code></td>
  </tr>
  <tr>
    <td width="20%"><strong>Department:</strong></td>
    <td><code><?php echo $department_name; ?></code></td>
  </tr>
  <tr>
    <td width="20%"><strong>Job Title:</strong></td>
    <td><code><?php echo $job_title; ?></code></td>
  </tr>
  <tr>
    <td width="20%"><strong>Job Type:</strong></td>
    <td><code><?php echo $job_type; ?></code></td>
  </tr>
  <tr>
    <td width="20%"><strong>Job Grade:</strong></td>
    <td><code><?php echo $job_grade; ?></code></td>
  </tr>
  <tr>
    <td width="20%"><strong>Hire Date:</strong></td>
    <td><code><?php echo $hire_date; ?></code></td>
  </tr>
</table>
<?php
$SelectQur = mysqli_query($conn, "SELECT * FROM employee_details WHERE employee_status = 'ACTIVE' AND deleted = '0' AND manager_employee_id = '".$employee_id."'");
if(mysqli_num_rows($SelectQur) == 0) {
//
}
else
{
$n=1;
echo "<table border='0' width='60%'>
<tr><td align= 'left'><strong>Employees Under Supervision:</strong></td></tr>";
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr><td align= 'left'>".$n.". <code>" . $row['full_name'] . "</code></td></tr>";
$n++;
  }
  echo "</table>";
  echo "<p>&nbsp;</p>";
  }
?>
<br>
</div>

<form method="post" action="create_current_cycle_objective_proc.php">
<input type='hidden' name='employee_id' value='<?php echo $employee_id; ?>'>
<table width="85%" border="0">
  <tr>
    <td bgcolor="#A2BEED"><strong>Objective</strong></td>
    <td><span id="sprytextarea1">
    <textarea name="obj_text" rows="8" cols="100"></textarea>
    <span class="textareaRequiredMsg"></span><span class="textareaMinCharsMsg"></span><span class="textareaMaxCharsMsg"></span></span><code><strong><span id="countsprytextarea1">&nbsp;</span></strong></code></td>
  </tr>
  <tr>
  <td bgcolor="#A2BEED"><strong>Weight</strong></td>
    <td><span id="sprytextfield3">
    <input type="text" name="obj_weight" size="5" placeholder="eg: 0.25" />
    <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span><span class="textfieldMaxValueMsg"></span><span class="textfieldMinValueMsg"></span></span> [<font color="blue"><strong><code>Consider that the sum of the Objectives' Weights is (1.00) regardless of their number.</code></strong></font>]</td>
  </tr>
  <tr>
    <td bgcolor="#A2BEED"><strong>Training Need</strong></td>
    <td class="form_select"><span id="spryselect1">
      <select name="course_id">
        <option selected value="">----- Select Course/Training -----</option>
        <?php
$SelectQur = "SELECT course_id, course_name FROM courses";
$SelectQurRun = mysqli_query($conn, $SelectQur);
while($row=mysqli_fetch_array($SelectQurRun))
{
echo '<option value="'.$row['course_id'].'">'.$row['course_name'].'</option>';
}
?>
      </select>
      <span class="selectRequiredMsg"></span></span></td>
  </tr>
  <tr>
    <td bgcolor="#A2BEED"><strong>Suggested Month for Training</strong></td>
    <td class="form_select"><span id="spryselect4">
      <select name="trn_month">
        <option selected value="NULL">--- Select ---</option>
<?php
$SelectQur = mysqli_query($conn, "SELECT * FROM months WHERE month_id >= DATE_FORMAT(CURDATE(), '%c')");
if(mysqli_num_rows($SelectQur) == 0) {
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
	echo '<option value="'.$row['month_id'].'">'.$row['month_name'].'</option>';
  }
  }
?>
      </select>
      <span class="selectRequiredMsg">Please select an item.</span></span></td>
  </tr>
  <tr>
    <td align="center" colspan='2'><p>&nbsp;</p><input type='submit' value='Save Objective' /></td>
  </tr>
</table>
</form>

<p>&nbsp;</p>
<hr width='60%'>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div class='styled'>
<?php
$SelectQur = mysqli_query($conn, "SELECT o.*, cr.*, trm.*, m.*
FROM courses cr, objectives o, obj_trn_months trm, months m
WHERE o.course_id = cr.course_id
AND trm.obj_id = o.obj_id
AND trm.trn_month = m.month_id
AND o.obj_year = '".$current_cycle_year."'
AND o.employee_id = '".$employee_id."'");
if(mysqli_num_rows($SelectQur) == 0) {
//
}
else
{
$SumWeightsAndScoresQur = mysqli_query($conn, "SELECT SUM(obj_weight) AS WeightsSum FROM objectives WHERE obj_year = '".$current_cycle_year."' AND employee_id = '".$employee_id."'");
while($row = mysqli_fetch_array($SumWeightsAndScoresQur))
{
$WeightsSumVar = $row['WeightsSum'];
}
echo "<table border='1' width='85%'>
<tr><td align='left'>Saved Objectives:</td></tr></table>";
echo "<table border='1' width='85%'>
<tr>
<th>#</th>
<th>Objective</th>
<th>Weight</th>
<th>Training Needs</th>
<th>Training Month</th>
<th>#</th>
<th>#</th>
</tr>";
$n=1;
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>";
  echo "<td  align= 'center'>" . $n . "</td>";
  echo "<td  align= 'left'>" . nl2br($row['obj_text']) . "</td>";
  echo "<td  align= 'left'>" . $row['obj_weight'] . "</td>";
  echo "<td  align= 'left'>" . $row['course_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['month_name'] . "</td>";
  echo "<td  align= 'center'><form method='POST' action='update_current_cycle_objective.php'><input type='hidden' name='obj_id' value='".$row['obj_id']."'><input type='hidden' name='employee_id' value='".$row['employee_id']."'><input type='image' src='img/icons/edit.png' alt='EDIT this Objective' title='EDIT this Objective'></form></td>";
  echo "<td  align= 'center'><form method='POST' action='delete_current_cycle_objective.php'><input type='hidden' name='objective_id' value='".$row['obj_id']."'><input type='hidden' name='employee_id' value='".encrypt_decrypt('encrypt', $row['employee_id'])."'>"; ?><input onclick='return confirm("are you sure to delete this objective?");' type='image' src='img/icons/delete.png' alt='DELETE this Objective' title='DELETE this Objective'></form></td> <?php
  echo "</tr>";
  $n++;
  }
  echo "<tr><td colspan='2'>&nbsp;</td><td><strong><u>".$WeightsSumVar."</u></strong></td><td colspan='4'>&nbsp;</td></tr>";
  echo "</table>";
  if($WeightsSumVar == '1.00')
  {
  }
  
  }
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
$SelectQur = mysqli_query($conn, "SELECT employee_id FROM employees WHERE job_grade_id IN(SELECT job_grade_id FROM jobs_grades WHERE grade_no IN(1, 2)) AND employee_id = '".$employee_id."' AND employee_id NOT IN (SELECT employee_id FROM objectives WHERE obj_year = '".$current_cycle_year."')");
if(mysqli_num_rows($SelectQur) == 0) {

}
else
{
?>
<table width="85%" border="0">
  <tr>
    <td><strong>Note:</strong>

<form method='POST' action='inst_emp_fc.php'><input type='hidden' name='employee_id' value='<?php echo $employee_id; ?>'><input type='submit' value="You can Click Here and make this employee classified as Form 'C'"></form></td>
  </tr>
  </table>
<?php
}
?>

</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
include('includefiles/footer.php');
?>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "real", {maxValue:1, minValue:0.01});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {minChars:5, maxChars:2500, counterId:"countsprytextarea1", counterType:"chars_remaining"});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {invalidValue:"NULL"});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
</script>
</body>
</html>