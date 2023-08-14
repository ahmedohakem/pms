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
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
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
    <td><div align="left"><input type=button onClick="location.href='main.php'" value='Back to Main'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>Create Supervisor Account</strong></font></div><hr width="99%"></td>
  </tr>
</table>
</div>
<div align="center" style="border-radius: 5px; background-color: #f2f2f2; padding: 20px;">
<font color="blue">
<?php
if (isset($_GET['msg'])){
 error_reporting (E_ALL ^ E_NOTICE);
 echo $_GET['msg']."<br><br>";
 }
?>
</font>
<form method="POST" action="create_account_proc.php" autocomplete="off">
<table width="50%" border="0">
  <tr>
    <td class="form_select"><span id="spryselect1">
      <select name="employee_id">
        <option selected value="">--- Select Supervisor ---</option>
        <?php
$SelectQur = "SELECT  employee_id, full_name, company_name FROM employee_details WHERE company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."') AND employee_id NOT IN (SELECT employee_id FROM sys_users WHERE user_level LIKE  '___1%') AND job_type = 'Supervisor' ORDER BY company_name, full_name";
$SelectQurRun = mysqli_query($conn, $SelectQur);
while($row=mysqli_fetch_array($SelectQurRun))
{
echo '<option value="'.$row['employee_id'].'">'.$row['employee_id'].' || '.$row['full_name'].' || '.$row['company_name'].'</option>';
}
?>
      </select>
      </span></td>
  </tr>
  <tr>
    <td><span id="sprytextfield1">
    <input type="text" placeholder="Password ..." name="password" size="40" value="" />
   </span></td>
  </tr>
  <tr>
    <td><span id="sprytextfield2">
    <input type="text" placeholder="Re-Type Password ..." name="re_password" size="40" value="" />
   </span></td>
  </tr>
  <tr>
    <td align="center">
	<p>&nbsp;</p>
	<input type="submit" value="CREATE ACCOUNT"></td>
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
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {minChars:5, maxChars:30});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {minChars:5, maxChars:30});
</script>
</body>
</html>