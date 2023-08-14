<?php
include('../includefiles/sess.php');
include('../includefiles/conn_db.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?php include('../includefiles/title.php'); ?></title>

<link rel="stylesheet" href="../css/style.css" />
<!-- favicon links -->
<link rel="shortcut icon" type="image/ico" href="../img/icons/favicon.ico" />
<link rel="icon" type="image/ico" href="../img/icons/favicon.ico" />

<script src="../css/datetimepicker_css.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
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
    <td><div align="left"><input type=button onClick="location.href='main.php'" value='Back to Main'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>Add New Department</strong></font></div><hr width="99%"></td>
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
<form method="POST" action="insert_department_proc.php" autocomplete="off">
<table width="65%" border="0">
  <tr>
    <td>
<strong>COMPANY</strong>
	</td>
    <td class="form_select"><span id="spryselect1">
      <select name="company_id">
        <option selected value="">--- Select Company ---</option>
        <?php
$SelectQur = "SELECT company_id, company_name FROM companies WHERE company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."' AND company_id NOT IN (22, 23, 26))";
$SelectQurRun = mysqli_query($conn, $SelectQur);
while($row=mysqli_fetch_array($SelectQurRun))
{
echo '<option value="'.$row['company_id'].'">'.$row['company_name'].'</option>';
}
?>
      </select>
      </span></td>
  </tr>
  <tr>
    <td>
<strong>DEPARTMENT NAME</strong>
	</td>
    <td><span id="sprytextfield1">
	<input type="text" name="department_name" size="50" value="">
	</td></span>
  </tr>  
  <tr>
    <td colspan="2" align="center">
	<p>&nbsp;</p>
	<input type="submit" value="SAVE"></td>
  </tr>
</table>
</form>
</div>
<div align="center">
<div class="styled">
<?php
$SelectQur = mysqli_query($conn, "SELECT d.department_id, d.department_name, c.company_id, c.company_name FROM departments d, companies c WHERE c.company_id = d.company_id AND c.company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."')  ORDER BY department_id, c.company_id");
if(mysqli_num_rows($SelectQur) == 0) {
echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
$NumberOfRecordVar = mysqli_num_rows($SelectQur);
echo "<p>&nbsp;</p>";
echo "<p>&nbsp;</p>";

echo "<table border='1' width='90%'>
<tr><td align='left'><strong>Records: $NumberOfRecordVar</strong></td></tr></table>";
echo "<table border='1' width='90%'>
<tr>
<th>#</th>
<th>Department Name</th>
<th>Company</th>
<th>#</th>";
$n=1;
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>";
  echo "<td  align= 'center'>" . $n . "</td>";
  echo "<td  align= 'left'>" . $row['department_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['company_name'] . "</td>";
  echo "<td  align= 'center'><form method='POST' action='delete_department.php'><input type='hidden' name='department_id' value='".$row['department_id']."'><input onclick='return confirm();' type='image' src='../img/icons/delete.png' alt='DELETE this Record' title='DELETE this Record'></form></td>";
  echo "</tr>";
  $n++;
  }
  echo "</table>";
  echo "<p>&nbsp;</p>";
  }
?>
</div>
</div>
<div align="center">
<?php
include('../includefiles/footer.php');
?>
</div>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {minChars:3, maxChars:100});
</script>
</body>
</html>