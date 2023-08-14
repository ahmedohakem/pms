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
    <td><div align="left"><input type=button onClick="location.href='main.php'" value='Back to Main'>&nbsp;<input type=button onClick="location.href='logout.php'" value='LogOut'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>System Cycle Situation</strong></font></div><hr width="99%"></td>
  </tr>
</table>
</div>
<div align="center" style="border-radius: 5px; background-color: #f2f2f2; padding: 20px;">
<p>&nbsp;</p>
<form method="POST" action="cycle_report.php">
<table width="65%" border="0">
  <tr>
    <td class="form_select" align="center"><select name="company_id"><option selected value="">----- Select Company -----</option>
<?php
$SelectQur = "SELECT company_id, company_name FROM companies WHERE company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."' AND company_id <> '26')";
$SelectQurRun = mysqli_query($conn, $SelectQur);
while($row=mysqli_fetch_array($SelectQurRun))
{
echo '<option value="'.$row['company_id'].'">'.$row['company_name'].'</option>';
}
?></select></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
	<p>&nbsp;</p>
	<input type="submit" value="DISPLAY CYCLE SITUATION"></td>
  </tr>
</table>
</form>
<p>&nbsp;</p>

</div>
<div align="center">
<?php
include('../includefiles/footer.php');
?>
</div>
</body>
</html>