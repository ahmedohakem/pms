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
    <td><div align="left"><input type=button onClick="location.href='main.php'" value='Back to Main'>&nbsp;<input type=button onClick="location.href='employees_filter.php'" value='Employees Filter'>&nbsp;<input type=button onClick="location.href='employees.php'" value='Employees List'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>Employees Records</strong></font></div><hr width="99%"></td>
  </tr>
</table>
</div>
<div align="center">
<div class="styled">
<?php
$SelectQur = mysqli_query($conn, "SELECT * FROM employee_details WHERE employee_id = '".$_POST['employee_id']."'");
if(mysqli_num_rows($SelectQur) == 0) {
//echo "<font color = 'red'> No Records!</font><br>";
}
else
{
echo "<table border='1' width='90%'>";
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Ref.</strong></td>";
  echo "<td  align= 'left'>" . $row['employee_id'] . "</td>";
  echo "</tr>";
  
  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Name</strong></td>";
  echo "<td  align= 'left'>" . $row['full_name'] . "</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Company</strong></td>";
  echo "<td  align= 'left'>" . $row['company_name'] . "</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Hire Date</strong></td>";
  echo "<td  align= 'left'>" . $row['hire_date'] . "</td>";
  echo "</tr>";
  
  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Department</strong></td>";
  echo "<td  align= 'left'>" . $row['department_name'] . "</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Job Type</strong></td>";
  echo "<td  align= 'left'>" . $row['job_type'] . "</td>";
  echo "</tr>";
  
  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Job Title</strong></td>";
  echo "<td  align= 'left'>" . $row['job_title'] . "</td>";
  echo "</tr>";
 
  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Grade</strong></td>";
  echo "<td  align= 'left'>" . $row['job_grade'] . "</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Current Job Join Date</strong></td>";
  echo "<td  align= 'left'>" . $row['current_job_join_date'] . "</td>";
  echo "</tr>";
  
  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Direct Manager</strong></td>";
  echo "<td  align= 'left'>" . $row['manager_full_name'] . " [".$row['manager_employee_id']."]</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Reviewing Manager</strong></td>";
  echo "<td  align= 'left'>" . $row['reviewing_manager_full_name'] . " [".$row['reviewing_manager_employee_id']."]</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Employee Status</strong></td>";
  echo "<td  align= 'left'>" . $row['employee_status'] . "</td>";
  echo "</tr>";
  
  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Work Mobile No.</strong></td>";
  echo "<td  align= 'left'>" . $row['work_mobile_no'] . "</td>";
  echo "</tr>";
  
  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Work Email Address</strong></td>";
  echo "<td  align= 'left'>" . $row['work_email_address'] . "</td>";
  echo "</tr>";
  
  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Work Extension No.</strong></td>";
  echo "<td  align= 'left'>" . $row['extension_no'] . "</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Gender</strong></td>";
  echo "<td  align= 'left'>" . $row['gender'] . "</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Nationality</strong></td>";
  echo "<td  align= 'left'>" . $row['nationality_country_name'] . "</td>";
  echo "</tr>";
  
  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Religion</strong></td>";
  echo "<td  align= 'left'>" . $row['religion'] . "</td>";
  echo "</tr>";
  
  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Date of Birth</strong></td>";
  echo "<td  align= 'left'>" . $row['date_of_birth'] . "</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>National ID</strong></td>";
  echo "<td  align= 'left'>" . $row['national_id'] . "</td>";
  echo "</tr>";
  
  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Personal Mobile No.</strong></td>";
  echo "<td  align= 'left'>" . $row['personal_mobile_no'] . "</td>";
  echo "</tr>";
  
  echo "<tr>";
  echo "<td bgcolor='#A2BEED' width='25%'><strong>Home Address</strong></td>";
  echo "<td align= 'left'>" . $row['home_address'] . "</td>";
  echo "</tr>";
  
  echo "<tr>";
  echo "<td  colspan='2' align= 'center'>
  <p>&nbsp;</p>
  <form method='POST' action='edit_employee.php'><input type='hidden' name='employee_id' value='".$row['employee_id']."'><input type='submit' value='EDIT THIS RECORD'></form></td>";
  echo "</tr>";
  
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