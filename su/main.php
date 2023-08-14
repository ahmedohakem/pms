<?php
include('../includefiles/sess.php');
include('../includefiles/conn_db.php');
include('../includefiles/user_session_info.php');
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
    <td><div align="left"><input type=button onClick="location.href='logout.php'" value='LogOut'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>Performance Management System <?php echo date('Y'); ?></font> || <?php echo $current_session_first_name; ?> [<?php echo $current_session_employee_id; ?>]</strong></div><hr width="99%"></td>
  </tr>
</table>
</div>
<div align="center" style="border-radius: 5px; background-color: #f2f2f2; padding: 20px;">
<p>&nbsp;</p>

<table width="700" height="147" border="0">
  <!--<tr>
    <td align="center"><form method="POST" action="objectives_report_filter.php"><input type="submit" value="OBJECTIVES"></form></td>
  </tr> -->
  <!--<tr>
    <td align="center"><form method="POST" action="training_report_filter.php"><input type="submit" value="TRAINING"></form></td>
  </tr> -->
  <!--<tr>
    <td align="center"><form method="POST" action="mid_review_report_filter.php"><input type="submit" value="MID. REVIEW"></form></td>
  </tr> -->
  <tr>
    <td align="center"><form method="POST" action="cycle_report_filter.php"><input type="submit" value="PMS CYCLE"></form></td>
  </tr>
  <tr>
    <td align="center"><form method="POST" action="pms_report_filter.php"><input type="submit" value="PMS RESULT"></form></td>
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