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
    <td><div align="left"><input type=button onClick="location.href='main.php'" value='Back to Main'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>System Accounts</strong></font></div><hr width="99%"></td>
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


$SelectQur = mysqli_query($conn, "SELECT e.*, sys.* FROM employee_details e, sys_users sys WHERE e.employee_id = sys.employee_id AND e.company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."') AND e.deleted = '0'");
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
<th>Job Title</th>
<th>Account Status</th>
<th>Reset Password</th>
<th>Activation</th>";
$n=1;
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>";
  echo "<td  align= 'center'>" . $n . "</td>";
  echo "<td  align= 'left'>" . $row['employee_id'] . "</td>";
  echo "<td  align= 'left'>" . $row['full_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['company_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['department_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['job_title'] . "</td>";
  echo "<td  align= 'left'>" . $row['user_status'] . "</td>";
  echo "<td  align= 'center'><form method='POST' action='reset_password.php'><input type='hidden' name='employee_id' value='".$row['employee_id']."'><input type='image' src='../img/icons/res-pass.png' alt='Reset Password' title='Reset Password'></form></td>";
  echo "<td  align= 'center'><form method='POST' action='activation.php'><input type='hidden' name='user_status' value='".$row['user_status']."'><input type='hidden' name='employee_id' value='".$row['employee_id']."'><input type='image' src='../img/icons/process.png' alt='ACTIVATE/DEACTIVATE' title='ACTIVATE/DEACTIVATE'></form></td>";
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