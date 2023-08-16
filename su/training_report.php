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
    <td><div align="left"><input type=button onClick="location.href='main.php'" value='Back to Main'>&nbsp;<input type=button onClick="location.href='training_report_filter.php'" value='Report Setting'>&nbsp;<input type=button onClick="location.href='logout.php'" value='LogOut'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>2020 Training Report<br><?php echo date("Y-F-d"); ?></strong></font></div><hr width="99%"></td>
  </tr>
</table>

<p>&nbsp;</p>
<div class="styled">
<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_POST['check_list'])) {
// Counting number of checked checkboxes.
//$checked_count = count($_POST['check_list']);
//echo "You have selected following ".$checked_count." option(s): <br/>";
// Loop to store and display values of individual checked checkbox.
foreach($_POST['check_list'] as $selected) {
//echo "<p>".$selected ."</p>";
$CalculateQur = "SELECT month_name FROM months WHERE month_id = ".$selected."";
$CalculateQurRun = mysqli_query($conn, $CalculateQur);
while($row = mysqli_fetch_array($CalculateQurRun))
{
$CalculateOutputVar = $row['month_name'];
}
$SelectQur = mysqli_query($conn, "SELECT e.*, o.*, t.*, m.*, c.*
FROM objectives_2020 o, obj_trn_months_2020 t, months m, employee_details e, courses c
WHERE o.obj_id = t.obj_id
AND t.trn_month = m.month_id
AND o.employee_id = e.employee_id
AND c.course_id = o.course_id
AND o.obj_year = '2020'
AND m.month_id = ".$selected."
AND company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."')
ORDER BY e.company_name, e.department_name, e.full_name");
if(mysqli_num_rows($SelectQur) == 0) {
echo "<table border='1' width='90%'>
<tr><td align='left'><font color = 'red' size='3'><strong> No Records for ".$CalculateOutputVar ." !</strong></font></td></tr></table>";
echo "<p>&nbsp;</p>";
}
else
{
echo "<table border='1' width='90%'>
<tr><td align='left'><strong>Month: $CalculateOutputVar</strong></td></tr></table>";
$NumberOfRecordReturnedVar = mysqli_num_rows($SelectQur);
echo "<table border='1' width='90%'>
<tr><td align='left'><strong>Records: $NumberOfRecordReturnedVar</strong></td></tr></table>";
echo "<table border='1' width='90%'>
<tr>
<th>#</th>
<th>Ref.</th>
<th>Name</th>";
echo "<th>Company</th>";
echo "<th>Department</th>
<th>Objective</th>
<th>Training</th>
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
  echo "<td  align= 'left'>" . $row['obj_text'] . "</td>";
  echo "<td  align= 'left'>" . $row['course_name'] . "</td>";
  echo "</tr>";
  $n++;
  }
  echo "</table>";
  echo "<p>&nbsp;</p>";
  }
}
}
else{
echo "<b>Please Select Atleast One Option.</b>";
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<p>&nbsp;</p>
</div>
</div>
<div align="center">
<?php
include('../includefiles/footer.php');
?>
</div>
</body>
</html>