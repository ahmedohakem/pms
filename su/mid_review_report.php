<?php
include('../includefiles/sess.php');
include('../includefiles/conn_db.php');
include('../includefiles/user_session_info.php');
include('../includefiles/enc.php');
$MasterCompany =  $_REQUEST['company_id'];
if (empty($_REQUEST['company_id'])) { $company_name = "Elnefeidi Group" ; $company_id = "AND company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."')"; }

else
{

if ($_REQUEST['company_id'] == 22) {
$CompanySelectQur = mysqli_query($conn, "SELECT company_name FROM companies WHERE company_id = '".$_REQUEST['company_id']."'");
while($row = mysqli_fetch_array($CompanySelectQur))
{
$company_name = $row['company_name'];
}
$company_id = "AND company_id IN (3, 5, 6, 7, 8, 9, 10)";
}

elseif ($_REQUEST['company_id'] == 23) {
$CompanySelectQur = mysqli_query($conn, "SELECT company_name FROM companies WHERE company_id = '".$_REQUEST['company_id']."'");
while($row = mysqli_fetch_array($CompanySelectQur))
{
$company_name = $row['company_name'];
}
$company_id = "AND company_id IN (16, 20, 21, 24, 25)";
}

else {
$CompanySelectQur = mysqli_query($conn, "SELECT company_name FROM companies WHERE company_id = '".$_REQUEST['company_id']."'");
while($row = mysqli_fetch_array($CompanySelectQur))
{
$company_name = $row['company_name'];
}
$company_id = "AND company_id = '".$_REQUEST['company_id']."'";
}

}
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
<a name='goup'>
<div align="center">
<table width="90%" border="0">
  <tr>
    <td align="left"><img src="../img/logo.png" width="208px" height="146px"></td>
  </tr>
  </table>
  <table width="60%" border="0">
    <tr>
    <td><div align="left"><input type=button onClick="location.href='main.php'" value='Back to Main'>&nbsp;<input type=button onClick="location.href='mid_review_report_filter.php'" value='List Filter'>&nbsp;<input type=button onClick="location.href='logout.php'" value='LogOut'><p>&nbsp;</p><strong><?php echo $current_session_first_name; ?> [<?php echo $current_session_employee_id; ?>]</strong></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>Mid. Review List<br><?php echo date("Y-F-d"); ?></font><br><font color="#963634" size="4"><?php echo $company_name; ?></font></strong></div><hr width="99%"></td>
  </tr>
</table>
</div>
<div class="PositionFixed">
<a href="#goup" title="Go Top"><img src="../img/icons/GoUp.png"></a>
</div>
<div align="center">
<div class="styled">
<p>&nbsp;</p>
<p>&nbsp;</p>


<?php
// REVIEWED
//===================================================================================================================================================================//
$ReviewedSelectQur = mysqli_query($conn, "SELECT * FROM employee_details
WHERE employee_id IN(
SELECT employee_id FROM objectives_submission WHERE objectives_year = '2019' AND mid_reviewed = '1'
)
".$company_id."
AND deleted = '0'
AND employee_status = 'ACTIVE'");
if(mysqli_num_rows($ReviewedSelectQur) == 0) {
echo "<font color = 'red'> No Records Match Your Query!</font><br>";
$ReviewedNumberOfRecordVar = 0;
}
else
{
$ReviewedNumberOfRecordVar = mysqli_num_rows($ReviewedSelectQur);
echo "<table border='1' width='90%'>
<tr><td align='left'><strong>Reviewed: $ReviewedNumberOfRecordVar</strong></td></tr></table>";
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
<th>Reviewing Manager</th>";
$n=1;
while($row = mysqli_fetch_array($ReviewedSelectQur))
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
  echo "</tr>";
  $n++;
  }
  echo "</table>";
  echo "<p>&nbsp;</p>";
  echo "<p>&nbsp;</p>";
  }
//===================================================================================================================================================================//


?>
</div>
<?php
include('../includefiles/footer.php');
?>
</div>
</body>
</html>