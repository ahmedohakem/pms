<?php
include('includefiles/sess.php');
include('includefiles/conn_db.php');
include('includefiles/settings.php');
include('includefiles/enc.php');
include('includefiles/user_session_info.php');


// Prepare Data for Selecting BEGIN:
//==================================================================================================================

mysqli_query($conn, "DROP TABLE IF EXISTS `".$_SESSION['id']."_employees_statuses`");
mysqli_query($conn, "CREATE TABLE `".$_SESSION['id']."_employees_statuses` (
  `employee_id` int(255) NOT NULL DEFAULT '0',
  `full_name` varchar(403) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `company_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `department_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `form_type` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `job_title` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `employee_status` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1") or die (header('Location:logout.php'));


// Employees Waiting Your Evaluation [From A/B] BEGIN
mysqli_query($conn, "INSERT INTO `".$_SESSION['id']."_employees_statuses` (
SELECT employee_id, full_name, company_name, department_name,
CASE
    WHEN job_type = 'Supervisor' THEN 'A'
    WHEN job_type = 'Non-Supervisor' THEN 'B'
    ELSE 'NOT DEFINED !!'
END AS form_type,
job_title, 'RTOP'
FROM employee_details
WHERE employee_status = 'ACTIVE'
AND deleted = '0'
AND manager_employee_id = (SELECT employee_id FROM sys_users WHERE sys_user_id = '".$_SESSION['id']."')
AND hire_date <= '".$current_cycle_year."-07-01'
AND employee_id IN (SELECT employee_id FROM objectives WHERE obj_year = '".$current_cycle_year."' GROUP BY employee_id HAVING SUM(obj_weight) = '1.00')
AND employee_id NOT IN(SELECT employee_id from form_tracker WHERE status_code <> '1')
)") or die (header('Location:logout.php'));
//==================================================================================================================

//Employees Waiting Your Evaluation [From C]
mysqli_query($conn, "INSERT INTO `".$_SESSION['id']."_employees_statuses` (
SELECT employee_id, full_name, company_name, department_name, 'C', job_title, 'RTOPC'
FROM employee_details
WHERE employee_status = 'ACTIVE'
AND deleted = '0'
AND manager_employee_id = (SELECT employee_id FROM sys_users WHERE sys_user_id = '".$_SESSION['id']."')
AND hire_date <= '".$current_cycle_year."-07-01' AND employee_id IN (SELECT employee_id FROM fc_emps WHERE cycle_year = '".$current_cycle_year."')
AND employee_id NOT IN(SELECT employee_id from form_tracker WHERE status_code <> '1')
)") or die (header('Location:logout.php'));
//==================================================================================================================

//Processed Forms [A/B/C]
mysqli_query($conn, "INSERT INTO `".$_SESSION['id']."_employees_statuses` (SELECT RealTimeTable.employee_id, RealTimeTable.full_name, RealTimeTable.company_name, RealTimeTable.department_name,
CASE
    WHEN RealTimeTable.job_type = 'Supervisor' THEN 'A'
    WHEN RealTimeTable.job_type = 'Non-Supervisor' THEN 'B'
    ELSE 'NOT DEFINED !!'
END AS form_type,
RealTimeTable.job_title, RealTimeTable2.status_code
FROM
(
SELECT * FROM employee_details
WHERE employee_status = 'ACTIVE'
AND deleted = '0' 
AND manager_employee_id = (SELECT employee_id FROM sys_users WHERE sys_user_id = '".$_SESSION['id']."')
AND hire_date <= '".$current_cycle_year."-07-01'
) RealTimeTable,
(
SELECT * FROM form_tracker WHERE record_id IN(
SELECT MAX(record_id) AS record_id FROM form_tracker WHERE status_code <> '1' GROUP BY employee_id)
) RealTimeTable2
WHERE RealTimeTable.employee_id = RealTimeTable2.employee_id)") or die (header('Location:logout.php'));
//==================================================================================================================

//Forms You Approved
mysqli_query($conn, "INSERT INTO `".$_SESSION['id']."_employees_statuses` (SELECT RealTimeTable.employee_id, RealTimeTable.full_name, RealTimeTable.company_name, RealTimeTable.department_name,
CASE
    WHEN RealTimeTable.job_type = 'Supervisor' THEN 'A'
    WHEN RealTimeTable.job_type = 'Non-Supervisor' THEN 'B'
    ELSE 'NOT DEFINED !!'
END AS form_type,
RealTimeTable.job_title, 'FYA'
FROM
(
SELECT * FROM employee_details
WHERE employee_status = 'ACTIVE'
AND deleted = '0' 
AND reviewing_manager_employee_id = (SELECT employee_id FROM sys_users WHERE sys_user_id = '".$_SESSION['id']."')
AND manager_employee_id <> (SELECT employee_id FROM sys_users WHERE sys_user_id = '".$_SESSION['id']."')
AND hire_date <= '".$current_cycle_year."-07-01'
) RealTimeTable,
(
SELECT * FROM form_tracker WHERE record_id IN(
SELECT MAX(record_id) AS record_id FROM form_tracker GROUP BY employee_id)
) RealTimeTable2
WHERE RealTimeTable.employee_id = RealTimeTable2.employee_id
AND RealTimeTable2.status_code = 4)") or die (header('Location:logout.php'));
//==================================================================================================================

//Forms Waiting Your Approval
mysqli_query($conn, "INSERT INTO `".$_SESSION['id']."_employees_statuses` (SELECT RealTimeTable.employee_id, RealTimeTable.full_name, RealTimeTable.company_name, RealTimeTable.department_name,
CASE
    WHEN RealTimeTable.job_type = 'Supervisor' THEN 'A'
    WHEN RealTimeTable.job_type = 'Non-Supervisor' THEN 'B'
    ELSE 'NOT DEFINED !!'
END AS form_type,
RealTimeTable.job_title, 'FWYA'
FROM
(
SELECT * FROM employee_details
WHERE employee_status = 'ACTIVE'
AND deleted = '0' 
AND reviewing_manager_employee_id = (SELECT employee_id FROM sys_users WHERE sys_user_id = '".$_SESSION['id']."')
AND hire_date <= '".$current_cycle_year."-07-01'
) RealTimeTable,
(
SELECT * FROM form_tracker WHERE record_id IN(
SELECT MAX(record_id) AS record_id FROM form_tracker GROUP BY employee_id)
) RealTimeTable2
WHERE RealTimeTable.employee_id = RealTimeTable2.employee_id
AND RealTimeTable2.status_code = 2)") or die (header('Location:logout.php'));
//==================================================================================================================

//Need Your Attention!! objectives not inserted
mysqli_query($conn, "INSERT INTO `".$_SESSION['id']."_employees_statuses`
(SELECT employee_id, full_name, company_name, department_name,
CASE
    WHEN job_type = 'Supervisor' THEN 'A'
    WHEN job_type = 'Non-Supervisor' THEN 'B'
    ELSE 'NOT DEFINED !!'
END AS form_type,
job_title, 'ONI'
FROM employee_details
WHERE employee_status = 'ACTIVE'
AND deleted = '0'
AND manager_employee_id = (SELECT employee_id FROM sys_users WHERE sys_user_id = '".$_SESSION['id']."')
AND hire_date <= '".$current_cycle_year."-07-01'
AND employee_id IN (SELECT employee_id FROM employees WHERE employee_id NOT IN (SELECT employee_id FROM objectives WHERE obj_year = '".$current_cycle_year."')
AND employee_id NOT IN (SELECT employee_id FROM fc_emps WHERE cycle_year = '".$current_cycle_year."')))") or die (header('Location:logout.php'));
//==================================================================================================================

//Need Your Attention!! objectives not completed
mysqli_query($conn, "INSERT INTO `".$_SESSION['id']."_employees_statuses`
(SELECT employee_id, full_name, company_name, department_name,
CASE
    WHEN job_type = 'Supervisor' THEN 'A'
    WHEN job_type = 'Non-Supervisor' THEN 'B'
    ELSE 'NOT DEFINED !!'
END AS form_type,
job_title, 'ONC'
FROM employee_details
WHERE employee_status = 'ACTIVE' AND deleted = '0' AND manager_employee_id = (SELECT employee_id FROM sys_users WHERE sys_user_id = '".$_SESSION['id']."') AND hire_date <= '".$current_cycle_year."-07-01' AND employee_id IN (SELECT employee_id FROM objectives WHERE obj_year = '".$current_cycle_year."' GROUP BY employee_id HAVING SUM(obj_weight) < '1.00'))") or die (header('Location:logout.php'));
//==================================================================================================================

//NA
mysqli_query($conn, "INSERT INTO `".$_SESSION['id']."_employees_statuses`
(SELECT employee_id, full_name, company_name, department_name,
CASE
    WHEN job_type = 'Supervisor' THEN 'A'
    WHEN job_type = 'Non-Supervisor' THEN 'B'
    ELSE 'NOT DEFINED !!'
END AS form_type,
job_title, 'NA'
FROM employee_details
WHERE employee_status = 'ACTIVE'
AND deleted = '0'
AND IFNULL(hire_date, '".$current_cycle_year."-12-31') > '".$current_cycle_year."-07-01'
AND manager_employee_id = (SELECT employee_id FROM sys_users WHERE sys_user_id = '".$_SESSION['id']."'))") or die (header('Location:logout.php'));
//==================================================================================================================







// Prepare Data for Selecting END:
//==================================================================================================================
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?php include('includefiles/title.php'); ?></title>

<link rel="stylesheet" href="css/style.css" />
<!-- favicon links -->
<link rel="shortcut icon" type="image/ico" href="img/icons/favicon.ico" />
<link rel="icon" type="image/ico" href="img/icons/favicon.ico" />

<script src="css/datetimepicker_css.js"></script>
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
    <td><div align="left"><input type=button onClick="location.href='logout.php'" value='LogOut'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>Staff Under Your Supervision</font> || <?php echo $current_session_first_name; ?> [<?php echo $current_session_employee_id; ?>]</strong></div><hr width="99%"></td>
  </tr>
</table>
</div>
<div align="center">
<div class="styled">
<?php
$SelectQur = mysqli_query($conn, "SELECT * FROM `".$_SESSION['id']."_employees_statuses`");
if(mysqli_num_rows($SelectQur) == 0) {
// echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
$NumberOfRecordVar = mysqli_num_rows($SelectQur);
echo "<table border='1' width='90%'>
<tr><td align='left'><strong>$NumberOfRecordVar</strong></td></tr></table>";
echo "<table border='1' width='90%'>
<tr>
<th>#</th>
<th>Ref.</th>
<th>Name</th>
<th>Company</th>
<th>Department</th>
<th>Job Title</th>
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
  //echo "<td  align= 'center'>" . $row['form_type'] . "</td>";
  echo "<td  align= 'left'>" . $row['job_title'] . "</td>";
  if ($row['employee_status'] == 'RTOP') {echo "<td  align= 'center'><form method='POST' action='evaluation.php'><input type='hidden' name='employee_id' value='".encrypt_decrypt('encrypt', $row['employee_id'])."'> <div class='row'><input type='submit' value='Ready to Process'></div></form></td>";}
  elseif ($row['employee_status'] == 'RTOPC') {echo "<td  align= 'center'><form method='POST' action='evaluation_fc.php'><input type='hidden' name='employee_id' value='".encrypt_decrypt('encrypt', $row['employee_id'])."'> <div class='row'><input type='submit' value='Ready to Process'></div></form></td>";}
  elseif ($row['employee_status'] == '2') {echo "<td  align= 'center'><form method='POST' action='pending_form.php'><input type='hidden' name='employee_id' value='".$row['employee_id']."'> <div class='row'><input type='submit' value='Pending for Approval'></div></form></td>";}
  elseif ($row['employee_status'] == '3') {echo "<td  align= 'center'><form method='POST' action='evaluation.php'><input type='hidden' name='employee_id' value='".encrypt_decrypt('encrypt', $row['employee_id'])."'> <div class='row'><input type='submit' value='Returned'></div></form></td>";}
  elseif ($row['employee_status'] == '4') {echo "<td  align= 'center'><form method='POST' action='approved_form.php'><input type='hidden' name='employee_id' value='".$row['employee_id']."'> <div class='row'><input type='submit' value='Approved'></div></form></td>";}
  elseif ($row['employee_status'] == 'FYA') {echo "<td  align= 'center'><form method='POST' action='form_you_approved.php'><input type='hidden' name='employee_id' value='".$row['employee_id']."'> <div class='row'><input type='submit' value='You Approved'></div></form></td>";}
  elseif ($row['employee_status'] == 'FWYA') {echo "<td  align= 'center'><form method='POST' action='approver.php'><input type='hidden' name='employee_id' value='".$row['employee_id']."'> <div class='row'><input type='submit' value='Pending for your Approval'></div></form></td>";}
  elseif ($row['employee_status'] == 'ONI') {echo "<td  align= 'center'><form method='POST' action='create_current_cycle_objective.php'><input type='hidden' name='employee_id' value='".$row['employee_id']."'> <div class='row'><input type='submit' value='Objectives Not Setted'></div></form></td>";}
  elseif ($row['employee_status'] == 'ONC') {echo "<td  align= 'center'><form method='POST' action='create_current_cycle_objective.php'><input type='hidden' name='employee_id' value='".$row['employee_id']."'> <div class='row'><input type='submit' value='Objectives Not Setted'></div></form></td>";}
  elseif ($row['employee_status'] == 'NA') {echo "<td  align= 'center'></strong>NA</strong></td>";}
  else { echo "ERROR";}
  echo "</tr>";
  $n++;
  }
  echo "</table>";
  echo "<p>&nbsp;</p>";
  }
mysqli_query($conn, "DROP TABLE IF EXISTS `".$_SESSION['id']."_employees_statuses`");
?>
</div>
<?php
include('includefiles/footer.php');
?>
</div>
</body>
</html>