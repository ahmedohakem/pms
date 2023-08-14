<?php
//DATABASE CONNECTION & SESSION CHECK:
include('../includefiles/conn_db.php');
include('../includefiles/sess.php');

mysqli_query($conn, "DELETE FROM departments WHERE department_id = '".$_POST['department_id']."'") or die ("<div align='center'><font color='red'><h3>SYSTEM ERROR!!...... TRANSACTION FAILED <a href='insert_job.php'>click here to re-try again</a>.</h3></font></div>");
$message = "Record deleted successfully";
header('Location:insert_department.php?msg='.$message);
?>