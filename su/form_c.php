<?php
include('../includefiles/sess.php');
include('../includefiles/conn_db.php');
include('../includefiles/enc.php');
$employee_id = $_REQUEST['employee_id'];
if (isset($_REQUEST['employee_id'])){
$employee_id = encrypt_decrypt('decrypt', $_REQUEST['employee_id']);
}
include('../includefiles/employee_info.php');
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
    <td><div align="left"><input type=button onClick="location.href='main.php'" value='Back to Main'>&nbsp;<input type=button onClick="location.href='objectives_report_filter.php'" value='Report Setting'>&nbsp;<input type=button onClick="location.href='logout.php'" value='LogOut'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>2019 Objectives</strong></font></div><hr width="99%"></td>
  </tr>
</table>
</div>
<div align="center">
<div class="styled">
<p>&nbsp;</p>
<table border='1' width='50%'>
<tr>
<td bgcolor='#963634' width='25%'><strong>Ref.</strong></td>
<td  align= 'left'><?php echo $employee_id; ?> </td>
</tr>
  
<tr>
<td bgcolor='#963634' width='25%'><strong>Name</strong></td>
<td  align= 'left'><?php echo $full_name; ?> </td>
</tr>

<tr>
<td bgcolor='#963634' width='25%'><strong>Company</strong></td>
<td  align= 'left'><?php echo $company_name; ?> </td>
</tr>

<tr>
<td bgcolor='#963634' width='25%'><strong>Hire Date</strong></td>
<td  align= 'left'><?php echo $hire_date; ?> </td>
</tr>
  
<tr>
<td bgcolor='#963634' width='25%'><strong>Department</strong></td>
<td  align= 'left'><?php echo $department_name; ?> </td>
</tr>

<tr>
<td bgcolor='#963634' width='25%'><strong>Job Type</strong></td>
<td  align= 'left'><?php echo $job_type; ?> </td>
</tr>
  
<tr>
<td bgcolor='#963634' width='25%'><strong>Job Title</strong></td>
<td  align= 'left'><?php echo $job_title; ?> </td>
</tr>

<tr>
<td bgcolor='#963634' width='25%'><strong>Third Generation</strong></td>
<td  align= 'left'> <?php if ($row['third_generation'] == 1) { echo "YES"; } else { echo "NO";  } ?></td>
</tr>
 
<tr>
<td bgcolor='#963634' width='25%'><strong>Grade</strong></td>
<td  align= 'left'><?php echo $job_grade; ?> </td>
</tr>

<tr>
<td bgcolor='#963634' width='25%'><strong>Current Job Join Date</strong></td>
<td  align= 'left'><?php echo $current_job_join_date; ?> </td>
</tr>
  
<tr>
<td bgcolor='#963634' width='25%'><strong>Direct Manager</strong></td>
<td  align= 'left'><?php echo $manager_full_name . " [".$manager_employee_id . "]"; ?></td>
</tr>

<tr>
<td bgcolor='#963634' width='25%'><strong>Reviewing Manager</strong></td>
<td  align= 'left'><?php echo $reviewing_manager_full_name . " [".$reviewing_manager_employee_id . "]"; ?></td>
</tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
$SelectQur = mysqli_query($conn, "SELECT * FROM work_dimensions WHERE wd_year = '2019'");
if(mysqli_num_rows($SelectQur) == 0) {
//
}
else
{
echo "<table border='1' width='85%'>
<tr>
<th>#</th>
<th>Work Dimension</th>
<th>Work Dimension Arabic</th>
</tr>";
$n=1;
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>";
  echo "<td  align= 'center'>" . $n . "</td>";
  echo "<td  align= 'left'>" . $row['wd_text'] . "</td>";
  echo "<td  align= 'right'>" . $row['wd_text_arabic'] . "</td>";
  echo "</tr>";
  $n++;
  }
  echo "</table>";
  }
?>
</div>
<?php
include('../includefiles/footer.php');
?>
</div>
</body>
</html>