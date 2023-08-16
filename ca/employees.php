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
    <td><div align="left"><input type=button onClick="location.href='main.php'" value='Back to Main'>&nbsp;<input type=button onClick="location.href='employees_filter.php'" value='Employees Filter'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>Employees Records</strong></font></div><hr width="99%"></td>
  </tr>
</table>
</div>
<div align="center">
<div class="styled">
<p>&nbsp;</p>
<font color="blue">
<?php
if (isset($_GET['msg'])){
 error_reporting (E_ALL ^ E_NOTICE);
 echo $_GET['msg']."<br><br>";
 }
?>
</font>
<?php
if (empty($_POST['hire_date1']) OR $_POST['hire_date1'] = '0000-00-00') { $hire_date1 = '1934-01-01' ; }
else { $hire_date1 = $_POST['hire_date1']; }
if (empty($_POST['hire_date2']) OR $_POST['hire_date2'] = '0000-00-00') { $hire_date2 = date("Y-m-d") ; }
else { $hire_date2 = $_POST['hire_date2']; }
//echo $hire_date1 . "-----" . $hire_date2 . "||||||||" . $_POST['hire_date1'] . "-----" . $_POST['hire_date2'];

if (empty($_POST['department'])) { $department = "" ; }
else { $department = "AND department_name = '".$_POST['department']."'"; }

if (empty($_POST['job_type'])) { $job_type = "" ; }
else { $job_type = "AND job_type = '".$_POST['job_type']."'"; }

if (empty($_POST['job_title'])) { $job_title = "" ; }
else { $job_title = "AND job_title = '".$_POST['job_title']."'"; }

if (empty($_POST['name'])) { $name = "" ; }
else { $name = "AND full_name LIKE '%".$_POST['name']."%'"; }

if (empty($_POST['employee_id'])) { $employee_id = "" ; }
else { $employee_id = "AND employee_id = '".$_POST['employee_id']."'"; }

if (empty($_POST['employee_company_id'])) { $employee_company_id = "" ; }
else { $employee_company_id = "AND employee_company_id = '".$_POST['employee_company_id']."'"; }

if (empty($_POST['company'])) { $company_id = "SELECT company_id FROM companies WHERE company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '". $_SESSION['id']."')" ; }
else { $company_id = "'".$_POST['company']."'"; }

if (empty($_POST['job_grade'])) { $job_grade = "" ; }
else { $job_grade = "AND job_grade_id = '".$_POST['job_grade']."'"; }

if (empty($_POST['direct_manager'])) { $direct_manager = "" ; }
else { $direct_manager = "AND manager_employee_id = '".$_POST['direct_manager']."'"; }

if (empty($_POST['reviwing_manager'])) { $reviwing_manager = "" ; }
else { $reviwing_manager = "AND reviewing_manager_employee_id = '".$_POST['reviwing_manager']."'"; }


$SelectQur = mysqli_query($conn, "SELECT * FROM employee_details
WHERE company_id IN(".$company_id.")
AND IFNULL( hire_date, '1934-01-01' ) BETWEEN '".$hire_date1."' AND '".$hire_date2."'
".$department."
".$job_type."
".$job_title."
".$job_grade."
".$direct_manager."
".$reviwing_manager."
".$name."
".$employee_id."
".$employee_company_id."
AND deleted = '0'
ORDER BY employee_id");
if(mysqli_num_rows($SelectQur) == 0) {
echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
$NumberOfRecordVar = mysqli_num_rows($SelectQur);
echo "<table border='1' width='90%'>
<tr><td align='left'><strong>Records: $NumberOfRecordVar</strong></td></tr></table>";
echo "<table border='1' width='90%'>
<tr>
<th>#</th>
<th>Ref.</th>
<th>Name</th>
<th>Company</th>
<th>Department</th>
<th>Job Type</th>
<th>Job Title</th>
<th>Direct Manager</th>
<th>Reviewing Manager</th>
<th>Status</th>
<th>#</th>
<th>#</th>
<th>#</th>
</tr>";
$n=1;
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>";
  echo "<td  align= 'center'>" . $n . "</td>";
  echo "<td  align= 'left'>" . $row['employee_id'] . "</td>";
  echo "<td  align= 'left'>" . $row['full_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['company_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['department_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['job_type'] . "</td>";
  echo "<td  align= 'left'>" . $row['job_title'] . "</td>";
  echo "<td  align= 'left'>" . $row['manager_full_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['reviewing_manager_full_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['employee_status'] . "</td>";
  echo "<td  align= 'center'><form method='POST' action='disp_full_record.php'><input type='hidden' name='employee_id' value='".$row['employee_id']."'><input type='image' src='../img/icons/process.png' alt='DISPLAY this Record' title='DISPLAY this Record'></form></td>";
  echo "<td  align= 'center'><form method='POST' action='edit_employee.php'><input type='hidden' name='employee_id' value='".$row['employee_id']."'><input type='image' src='../img/icons/edit.png' alt='EDIT this Record' title='EDIT this Record'></form></td>";
  echo "<td  align= 'center'><form method='POST' action='delete_employee.php'><input type='hidden' name='employee_id' value='".$row['employee_id']."'><input onclick='return confirm();' type='image' src='../img/icons/delete.png' alt='DELETE this Record' title='DELETE this Record'></form></td>";
  echo "</tr>";
  $n++;
  }
  echo "</table>";
  echo "<p>&nbsp;</p>";
  }
?>
</div>
<div align="center">
<?php
include('../includefiles/footer.php');
?>
</div>
</body>
</html>