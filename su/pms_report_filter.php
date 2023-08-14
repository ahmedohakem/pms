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
  <table width="60%" border="0">
    <tr>
    <td><div align="left"><input type=button onClick="location.href='main.php'" value='Back to Main'>&nbsp;<input type=button onClick="location.href='logout.php'" value='LogOut'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>PMS Report 2019<br><?php echo date("Y-F-d"); ?></strong></font></div><hr width="99%"></td>
  </tr>
</table>
<?php
$SelectQur = mysqli_query($conn, "SELECT company_id FROM users_companies WHERE company_id = '26' AND sys_user_id = '".$_SESSION['id']."'");
if(mysqli_num_rows($SelectQur) == 0) {
// echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
?>
<table width="90%" border="0">
<tr>
<td align="center">
<a href='#' class='hvr-grow'><form method='POST' action='pms_report.php'><input type='hidden' name='company_id' value=''><input type='hidden' name='company_logo' value='https://www.elnefeidi.com/images/logo.png'><input type='image' src='https://www.elnefeidi.com/images/logo.png' alt='Elnefeidi Group' title='Elnefeidi Group'></form></a>
</td>
</tr>
</table>
<?php
  }
?>





<table width="90%" border="0">
<tr>
<td align="center">
<?php
$SelectQur = mysqli_query($conn, "SELECT * FROM companies WHERE company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."' AND company_id <> '26')");
if(mysqli_num_rows($SelectQur) == 0) {
// echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<a href='#' class='hvr-grow'><form method='POST' action='pms_report.php'><input type='hidden' name='company_id' value='".$row['company_id']."'><input type='hidden' name='company_logo' value='".$row['company_logo']."'><input type='image' src='".$row['company_logo']."' alt='".$row['company_name']."' title='".$row['company_name']."'></form></a> &nbsp; &nbsp; &nbsp;";
  }
  }
?>
</td>
</tr>
</table>
</div>
<div align="center">
<?php
include('../includefiles/footer.php');
?>
</div>
</body>
</html>