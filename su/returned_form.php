<?php
include('../includefiles/sess.php');
if (!isset($_POST['employee_id'])){
die (header("location:logout.php"));
}
include('../includefiles/conn_db.php');
include('../includefiles/settings.php');
$employee_id = $_POST['employee_id'];
include('../includefiles/employee_info.php');
include('../includefiles/ObjCompPercentageSettings.php');
include('../includefiles/user_session_info.php');
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
    <td><div align="left"><input type=button onClick="location.href='cycle_report_filter.php'" value='Back to Filter'>&nbsp;<input type=button onClick="location.href='main.php'" value='Back to Main'>&nbsp;<input type=button onClick="location.href='logout.php'" value='LogOut'><form method="POST" action="cycle_report.php"><input type='hidden' name='employee_id' value='<?php echo $_POST['employee_id']; ?>'><input type='hidden' name='company_id' value='<?php echo $_POST['company_id']; ?>'><input type="submit" value="Select Another Employee"></form></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>Returned to Review</font> || <?php echo $current_session_first_name; ?> [<?php echo $current_session_employee_id; ?>]</strong></div><hr width="99%"></td>
  </tr>
</table>
</div>
<div align="center">
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
    <td width="20%"><strong>Direct Manager:</strong></td>
    <td><code><?php echo $manager_full_name; ?></code></td>
  </tr>
  <tr>
    <td width="20%"><strong>Reviewing Manager:</strong></td>
    <td><code><?php echo $reviewing_manager_full_name; ?></code></td>
  </tr>
</table>
<?php
$SelectQur = mysqli_query($conn, "SELECT full_name FROM employee_details WHERE employee_status = 'ACTIVE' AND deleted = '0' AND manager_employee_id = '".$employee_id."'");
if(mysqli_num_rows($SelectQur) == 0) {
// echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
echo "<table border='0' width='60%'>
<tr><td align= 'left'><strong>Employees Under Supervision:</strong></td></tr>
</table>";
echo "<table border='0' width='60%'>";
$n=1;
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr>";
  echo "<td  align= 'left'>" . $n . ". <code>" . $row['full_name'] . "</code></td>";
  echo "</tr>";
  $n++;
  }
  echo "</table>";
  echo "<p>&nbsp;</p>";
  }
?>
<p>&nbsp;</p>
<?php
$SelectQur = mysqli_query($conn, "SELECT employee_id FROM fc_emps WHERE employee_id = '".$employee_id."' AND cycle_year = '".$current_cycle_year."'");
if(mysqli_num_rows($SelectQur) == 0) {
// THIS IS NOT FORM C, PREPARE HIS FORM //BEGIN
$SelectQur = mysqli_query($conn, "SELECT o.*, c.*
FROM objectives o, courses c
WHERE o.course_id = c.course_id
AND obj_year = '".$current_cycle_year."'
AND employee_id = '".$employee_id."'");
if(mysqli_num_rows($SelectQur) == 0) {
//
}
else
{
echo "<table border='1' width='85%'>
<tr><td align='left'>Objectives:</td></tr></table>";
echo "<table border='1' width='85%'>
<tr>
<th>#</th>
<th>Objective</th>
<th>Weight</th>
<th>Training Needs</th>
<th>Rating</th>
</tr>";
$n=1;
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>";
  echo "<td  align= 'center'>" . $n . "</td>";
  echo "<td  align= 'left'>" . nl2br($row['obj_text']) . "</td>";
  echo "<td  align= 'left'>" . $row['obj_weight'] . "</td>";
  echo "<td  align= 'left'>" . $row['course_name'] . "</td>";
  echo "<td  align= 'center'>" . $row['obj_rating'] . "</td>";
  echo "</tr>";
  $n++;
  }
  echo "</table>";
  }
echo "<p>&nbsp;</p>";
$SelectQur = mysqli_query($conn, "SELECT c.*, empc.*
FROM competencies c, employees_competencies empc
WHERE c.comp_id = empc.comp_id
AND c.comp_year = '".$current_cycle_year."'
AND empc.employee_id = '".$employee_id."'");
if(mysqli_num_rows($SelectQur) == 0) {
//
}
else
{
echo "<table border='1' width='85%'>
<tr><td align='left'>Competencies:</td></tr></table>";
echo "<table border='1' width='85%'>
<tr>
<th>#</th>
<th>Competency</th>
<th>Rating</th>
</tr>";
$n=1;
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>";
  echo "<td  align= 'center'>" . $n . "</td>";
  echo "<td  align= 'left'>" . $row['comp_text'] . "</td>";
  echo "<td  align= 'center'>" . $row['comp_rating'] . "</td>"; 
	echo "</tr>";
  $n++;
  }
  echo "</table>";
  }
echo "<p>&nbsp;</p>";
include('../includefiles/eva_res_cal.php');
}
// THIS IS NOT FORM C, PREPARE HIS FORM //END

else
{
// THIS IS FORM C, PREPARE HIS FORM //BEGIN
$SelectQur = mysqli_query($conn, "SELECT wd.*, empwd.*
FROM work_dimensions wd, employees_work_dimensions empwd
WHERE wd.wd_id = empwd.wd_id
AND wd.wd_year = '".$current_cycle_year."'
AND empwd.employee_id = '".$employee_id."'");
if(mysqli_num_rows($SelectQur) == 0) {
//
}
else
{
echo "<table border='1' width='85%'>
<tr><td align='left'>Work Dimensions:</td></tr></table>";
echo "<table border='1' width='85%'>
<tr>
<th>#</th>
<th>Work Dimension</th>
<th>Work Dimension Arabic</th>
<th>Rating</th>
</tr>";
$n=1;
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>";
  echo "<td  align= 'center'>" . $n . "</td>";
  echo "<td  align= 'left'>" . $row['wd_text'] . "</td>";
  echo "<td  align= 'right'>" . $row['wd_text_arabic'] . "</td>";
  echo "<td  align= 'center'>" . $row['wd_rating'] . "</td>"; 
  echo "</tr>";
  $n++;
  }
  echo "</table>";
  echo "<p>&nbsp;</p>";
  }
include('../includefiles/eva_fc_res_cal.php');
  }
// THIS IS FORM C, PREPARE HIS FORM //END
?>
<p>&nbsp;</p>
<?php
$SelectQur = mysqli_query($conn, "SELECT
CASE
WHEN reviewing_manager_comment = '' THEN 'NO COMMENTS'
ELSE reviewing_manager_comment
END AS reviewing_manager_comment
FROM form_tracker
WHERE employee_id = '".$employee_id."'
AND reviewing_manager_comment IS NOT NULL");
if(mysqli_num_rows($SelectQur) == 0) {
//
}
else
{
echo "<table border='1' width='85%'>
<tr><td align='left'><strong>Comments:</strong></td></tr></table>";
echo "<table border='1' width='85%'>";
$n=1;
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr>";
  echo "<td  align= 'left'>" . $row['reviewing_manager_comment'] . "</td>";
  echo "</tr>";
  }
  echo "</table>";
  }
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
<?php
include('../includefiles/footer.php');
?>
</div>
</body>
</html>