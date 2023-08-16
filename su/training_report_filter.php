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
    <td><div align="left"><input type=button onClick="location.href='main.php'" value='Back to Main'>&nbsp;<input type=button onClick="location.href='logout.php'" value='LogOut'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>2020 Training Report Setting</strong></font></div><hr width="99%"></td>
  </tr>
</table>
</div>
<div align="center" style="border-radius: 5px; background-color: #f2f2f2; padding: 20px;">
<p>&nbsp;</p>
<div class="styled">
<form action="training_report.php" method="post">
<table width="50%">
  <tr>
    <td colspan="3">Select month(s) and display training:</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="check_list[]" value="1"><font size="5">January</font></td>
    <td><input type="checkbox" name="check_list[]" value="2"><font size="5">February</font></td>
    <td><input type="checkbox" name="check_list[]" value="3"><font size="5">March</font></td>
  </tr>
  <tr>
    <td><input type="checkbox" name="check_list[]" value="4"><font size="5">April</font></td>
    <td><input type="checkbox" name="check_list[]" value="5"><font size="5">May</font></td>
    <td><input type="checkbox" name="check_list[]" value="6"><font size="5">June</font></td>
  </tr>
  <tr>
    <td><input type="checkbox" name="check_list[]" value="7"><font size="5">July</font></td>
    <td><input type="checkbox" name="check_list[]" value="8"><font size="5">August</font></td>
    <td><input type="checkbox" name="check_list[]" value="9"><font size="5">September</font></td>
  </tr>
  <tr>
    <td><input type="checkbox" name="check_list[]" value="10"><font size="5">October</font></td>
    <td><input type="checkbox" name="check_list[]" value="11"><font size="5">November</font></td>
    <td><input type="checkbox" name="check_list[]" value="12"><font size="5">December</font></td>
  </tr>
    <tr>
    <td colspan="3"><input type="checkbox" name="check_list[]" value="99"><font size="5">NA</font></td>
  </tr>
</table>
<input type='submit' value='Display Training' />
</form>
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