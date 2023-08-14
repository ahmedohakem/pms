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
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
    <td><div align="left"><input type=button onClick="location.href='main.php'" value='Back to Main'>&nbsp;<input type=button onClick="location.href='accounts.php'" value='System Accounts'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>Reset Password| ID: <?php echo $_REQUEST['employee_id']; ?></strong></font></div><hr width="99%"></td>
  </tr>
</table>
</div>
<div align="center" style="border-radius: 5px; background-color: #f2f2f2; padding: 20px;">
<font color="blue">
<?php
if (isset($_GET['pst'])){
 error_reporting (E_ALL ^ E_NOTICE);
 echo $_GET['pst']."<br><br>";
 }
?>
</font>
<form method="POST" action="reset_password_proc.php" autocomplete="off">
<input type="hidden" name="employee_id" value="<?php echo $_POST['employee_id']; ?>">
<table width="50%" border="0">

  <tr>
    <td align="center"><span id="sprytextfield1">
    <input type="text" placeholder="Password ..." name="password" size="60" value="" />
    </span></td>
  </tr>
  <tr>
    <td align="center"><span id="sprytextfield2">
    <input type="text" placeholder="Re-Type Password ..." name="re_password" size="60" value="" />
    </span></td>
  </tr>
  <tr>
    <td align="center">
	<p>&nbsp;</p>
	<input type="submit" value="RESET PASSWORD"></td>
  </tr>
</table>
</form>
</div>
<div align="center">
<?php
include('../includefiles/footer.php');
?>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {minChars:5, maxChars:30});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {minChars:3, maxChars:30});
</script>
</body>
</html>