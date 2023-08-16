<?php
include('includefiles/sess.php');
include('includefiles/conn_db.php');
include('includefiles/settings.php');
include('includefiles/enc.php');
if (isset($_GET['employee_id'])){
$employee_id = encrypt_decrypt('decrypt', $_GET['employee_id']);
$obj_id = encrypt_decrypt('decrypt', $_GET['obj_id']);


$SelectQur = mysqli_query($conn, "SELECT temp.*, m.*, cr.* FROM ".$employee_id."_curr_cycle_obj_temp_edit temp, months m, courses cr WHERE m.month_id = temp.month_id AND cr.course_id = temp.course_id");
if(mysqli_num_rows($SelectQur) == 0) {
	//
}
else{
while($row = mysqli_fetch_array($SelectQur))
{
$obj_text = $row['obj_text'];
$obj_weight = $row['obj_weight'];
$course_id = $row['course_id'];
$course_name = $row['course_name'];
$month_id = $row['month_id'];
$month_name = $row['month_name'];
}
mysqli_query($conn, "DROP TABLE IF EXISTS ".$employee_id."_curr_cycle_obj_temp_edit");
}
}
else
{
$employee_id = $_POST['employee_id'];
$obj_id = $_POST['obj_id'];

$SelectQur = mysqli_query($conn, "SELECT o.*, cr.*, trm.*, m.*
FROM courses cr, objectives o, obj_trn_months trm, months m
WHERE o.course_id = cr.course_id
AND trm.obj_id = o.obj_id
AND trm.trn_month = m.month_id
AND o.obj_id = '".$obj_id."'");
if(mysqli_num_rows($SelectQur) == 0) {

}
else{
while($row = mysqli_fetch_array($SelectQur))
{
$obj_text = $row['obj_text'];
$obj_weight = $row['obj_weight'];
$course_id = $row['course_id'];
$course_name = $row['course_name'];
$month_id = $row['month_id'];
$month_name = $row['month_name'];
}
}
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
<link rel="icon" type="image/ico" href="img/icons/favicon.ico" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
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
    <td><div align="left"><input type=button onClick="location.href='employees.php'" value='Staff Under Your Supervision'>&nbsp;<input type=button onClick="location.href='logout.php'" value='LogOut'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>Edit Objective</strong><br><?php echo $full_name; ?></font></div><hr width="99%"></td>
  </tr>
</table>
<br>
<form method="post" action="update_current_cycle_objective_proc.php">
<input type='hidden' name='employee_id' value='<?php echo $employee_id; ?>'>
<input type='hidden' name='obj_id' value='<?php echo $obj_id; ?>'>
<table width="85%" border="0">
  <tr>
    <td bgcolor="#963634"><strong>Objective</strong></td>
    <td><span id="sprytextarea1">
    <textarea name="obj_text" rows="8" cols="100"><?php echo $obj_text;?></textarea>
    <span class="textareaRequiredMsg"></span><span class="textareaMinCharsMsg"></span><span class="textareaMaxCharsMsg"></span></span><code><strong><span id="countsprytextarea1">&nbsp;</span></strong></code></td>
  </tr>
  <tr>
  <td bgcolor="#963634"><strong>Weight</strong></td>
    <td><span id="sprytextfield3">
    <input type="text" name="obj_weight" size="5" value="<?php echo $obj_weight;?>" placeholder="eg: 0.25" />
    <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span><span class="textfieldMaxValueMsg"></span><span class="textfieldMinValueMsg"></span></span> [<font color="blue"><strong><code>Consider that the sum of the Objectives' Weights is (1.00) regardless of their number.</code></strong></font>]</td>
  </tr>
  <tr>
    <td bgcolor="#963634"><strong>Training Need</strong></td>
    <td class="form_select"><select name="course_id"><option selected value="<?php echo $course_id;?>"><?php echo $course_name;?></option>
<?php
$SelectQur = "SELECT course_id, course_name FROM courses";
$SelectQurRun = mysqli_query($conn, $SelectQur);
while($row=mysqli_fetch_array($SelectQurRun))
{
echo '<option value="'.$row['course_id'].'">'.$row['course_name'].'</option>';
}
?></select></td>
  </tr>
  <tr>
    <td bgcolor="#963634"><strong>Suggested Month for Training</strong></td>
    <td class="form_select">
<select name="month_id">
<option selected value="<?php echo $month_id;?>"><?php echo $month_name;?></option>
<?php
$SelectQur = "SELECT * FROM months WHERE month_id >= DATE_FORMAT(CURDATE(), '%c')";
$SelectQurRun = mysqli_query($conn, $SelectQur);
while($row=mysqli_fetch_array($SelectQurRun))
{
echo '<option value="'.$row['month_id'].'">'.$row['month_name'].'</option>';
}
?>
</select>
</td>
  </tr>
  <tr>
    <td align="center" colspan='2'><p>&nbsp;</p><input type='submit' value='Save Changes' /></form>
	<form method="POST" action="create_current_cycle_objective.php"><input type='hidden' name='employee_id' value='<?php echo $employee_id; ?>'><input type='submit' value='Cancel' /></form></td>
  </tr>
</table>


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
echo "<font color = 'blue' size='4'><code><strong> No Objectives Recorded for This Employee!</strong></code></font><br>";
}
else
{
$SumWeightsQur = mysqli_query($conn, "SELECT SUM(obj_weight) AS WeightsSum FROM objectives WHERE employee_id = '".$employee_id."' AND obj_year = '".$current_cycle_year."'");
while($row = mysqli_fetch_array($SumWeightsQur))
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
</tr>";
$n=1;
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>";
  echo "<td  align= 'center'>" . $n . "</td>";
  if($row['obj_id'] == $obj_id)
  {
  echo "<td  align= 'left'><font color='red'>" . $row['obj_text'] . "</font></td>";
  }
  else
  {
  echo "<td  align= 'left'>" . $row['obj_text'] . "</td>";
  }
  echo "<td  align= 'left'>" . $row['obj_weight'] . "</td>";
  echo "<td  align= 'left'>" . $row['course_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['month_name'] . "</td>";
  echo "</tr>";
  $n++;
  }
  echo "<tr><td colspan='2'>&nbsp;</td><td><strong><u>".$WeightsSumVar."</u></strong></td><td colspan='3'>&nbsp;</td></tr>";
  echo "</table>";
  }
?>
</div>
<hr width='60%'>
<p>&nbsp;</p>
<p>&nbsp;</p>




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
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {invalidValue:"NULL"});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {minChars:5, maxChars:2500, counterId:"countsprytextarea1", counterType:"chars_remaining"});
</script>
</body>
</html>