<?php
include('includefiles/sess.php');
if (!isset($_REQUEST['employee_id'])){
die (header("location:logout.php"));
}
include('includefiles/conn_db.php');
include('includefiles/settings.php');
include('includefiles/enc.php');
$employee_id = encrypt_decrypt('decrypt', $_REQUEST['employee_id']);
include('includefiles/employee_info.php');
include('includefiles/anti_hack.php');
include('includefiles/work_dimensions_data_space_check.php');
include('includefiles/user_session_info.php');
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
    <td><div align="left"><input type=button onClick="location.href='employees.php'" value='Staff Under Your Supervision'>&nbsp;<input type=button onClick="location.href='logout.php'" value='LogOut'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>Evaluation Process</font> || <?php echo $current_session_first_name; ?> [<?php echo $current_session_employee_id; ?>]</strong></div><hr width="99%"></td>
  </tr>
</table>
</div>
<?php
if (isset($_GET['ps'])){
$ProcStatus = $_GET['ps'];
if($ProcStatus == 1){
$ProcStatusText = "<font color='blue'>Changes Saved Successfully</font>";
}
if($ProcStatus == 3){
$ProcStatusText = "<font color='red'>This form not ready to send (check WORK DIMENSIONS)</font>";
}
}
else
{
$ProcStatusText = "";
}
?>
<div align="center">
<?php
echo $ProcStatusText;
?>
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
<table border="1" width="85%">
  <tr align="center">
    <td><strong>Overall Rating</strong></td>
    <td><strong>5</strong></td>
    <td><strong>4</strong></td>
    <td><strong>3</strong></td>
    <td><strong>2</strong></td>
    <td><strong>1</strong></td>
  </tr>
  <tr align="center">
    <td><strong>English</strong></td>
    <td>Significantly Exceed Expectation</td>
    <td>Exceed Expectation</td>
    <td>Meet Expectation</td>
    <td>Below Expectation</td>
    <td>Significantly Below Expectation</td>
  </tr>
  <tr align="center">
    <td><strong>Arabic</strong></td>
    <td><p align="center" dir="rtl">تجاوز التوقعات بشكل كبير<span dir="ltr"> </span></td>
    <td><p align="center" dir="rtl">تجاوز التوقعات</td>
    <td><p align="center" dir="rtl"><span dir="ltr">مطابق للتوقعات</span></td>
    <td><p align="center" dir="rtl">أقل من التوقعات<span dir="ltr"></span></td>
    <td><p align="center" dir="rtl"><span dir="ltr">أقل من التوقعات بشكل كبير</span></td>
  </tr>
</table>
<p>&nbsp;</p>
<form method='POST' action='evaluation_fc_save_changes.php'>
<?php
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
  echo "<td  align= 'center'><select name='".$row['wd_id']."'>
      <option selected value='".$row['wd_rating']."'> ".$row['wd_rating']." </option>
      <option value='1'>1</option>
      <option value='2'>2</option>
      <option value='3'>3</option>
      <option value='4'>4</option>
      <option value='5'>5</option>
    </select></td>";  
	echo "</tr>";
  $n++;
  }
  echo "</table>";
  }
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
<input type='hidden' name='employee_id' value='<?php echo $employee_id; ?>'>
<input type='submit' value='Save Changes' name='save_changes' />
<input type='submit' value='Save & Send to my Direct Manager' name='submit_to_dm' onclick='return confirm("you are about to send this form to your direct manager and cannot be editable again");' />
</form>
<p>&nbsp;</p>
</div>
<?php
include('includefiles/footer.php');
?>
</div>
</body>
</html>