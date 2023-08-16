<?php
//DATABASE CONNECTION & SESSION CHECK:
include('../includefiles/conn_db.php');
include('../includefiles/sess.php');


mysqli_query($conn, "INSERT INTO `departments` (`department_name`, `company_id`) VALUES ('".mysqli_real_escape_string($conn, $_POST['department_name'])."', '".$_POST['company_id']."')") or die ("<div align='center'><font color='red'><h3>SYSTEM ERROR!!...... TRANSACTION FAILED <a href='insert_job.php'>click here to re-try again</a>.</h3></font></div>");
$message = "Department Added successfully";
header('Location:insert_department.php?msg='.$message);
?>