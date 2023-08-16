<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include('includefiles/title.php'); ?></title>

<link rel="stylesheet" href="css/style.css" />
<!-- favicon links -->
<link rel="shortcut icon" type="image/ico" href="img/icons/favicon.ico" />
<link rel="icon" type="image/ico" href="img/icons/favicon.ico" />
</head>
<body>
<div align="center">
<table width="90%" border="0">
  <tr>
    <td align="left"><img src="img/logo.png" width="122px" height="85px"></td>
  </tr>
  </table>

</div>
<div align="center" style="border-radius: 5px; background-color: #f2f2f2; padding: 20px;">
<p>&nbsp;</p>
<font color="red">
<?php
if (isset($_GET['msg'])){
 error_reporting (E_ALL ^ E_NOTICE);
 echo $_GET['msg']."<br><br>";
 }
?>
</font>
<form method="POST" action="checklogin.php">
<table width="500" height="147" border="0">
  <tr>
    <td><input type="text" name="uname" placeholder="User ID.." style="width: 100%;"></td>
  </tr>
    <tr>
    <td><input type="password" name="upassword" placeholder="Password.."></td>
  </tr>
    <tr>
    <td align="center" colspan="2"><br><input type="submit" value="LOGIN"></td>
  </tr>
</table>
</form>

<p>&nbsp;</p>
</div>
<div align="center">
<?php
include('includefiles/footer.php');
?>
</div>
</body>
</html>