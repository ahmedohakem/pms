<?php
include('../includefiles/sess.php');
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
    <td><div align="left"><strong><font color="" size="4">&nbsp;</font></strong></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>Performance Management System <?php echo date('Y'); ?></strong></font></div><hr width="99%"></td>
  </tr>
</table>
</div>
<div align="center" style="border-radius: 5px; background-color: #f2f2f2; padding: 20px;">
<p>&nbsp;</p>

<table width="700" height="147" border="0">
  <tr>
    <td align="center"><form method="POST" action="insert_employee.php"><input type="submit" value="ADD NEW EMPLOYEE"></form></td>
  </tr>
  <tr>
    <td align="center"><form method="POST" action="insert_department.php"><input type="submit" value="ADD NEW DEPARTMENT"></form></td>
  </tr>
  <tr>
    <td align="center"><form method="POST" action="insert_job.php"><input type="submit" value="ADD NEW JOB"></form></td>
  </tr>
  <tr>
    <td align="center"><form method="POST" action="employees_filter.php"><input type="submit" value="DISPLAY & EDIT EMPLOYEES"></form></td>
  </tr>
  <tr>
    <td align="center"><form method="POST" action="create_account.php"><input type="submit" value="CREATE SYSTEM ACCOUNT"></form></td>
  </tr>
  <tr>
    <td align="center"><form method="POST" action="accounts.php"><input type="submit" value="DISPLAY & EDIT SYSTEM ACCOUNTS"></form></td>
  </tr>
  <tr>
    <td align="center"><form method="POST" action="logout.php"><input type="submit" value="LOGOUT"></form></td>
  </tr>
</table>
<p>&nbsp;</p>

</div>
<div align="center">
<?php
include('../includefiles/footer.php');
?>
</div>
</body>
</html>