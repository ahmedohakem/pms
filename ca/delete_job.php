<?php
//DATABASE CONNECTION & SESSION CHECK:
include('../includefiles/conn_db.php');
include('../includefiles/sess.php');

mysqli_query($conn, "DELETE FROM jobs WHERE job_id = '".$_POST['job_id']."'") or die ("<div align='center'><font color='red'><h3>SYSTEM ERROR!!...... TRANSACTION FAILED <a href='insert_job.php'>click here to re-try again</a>.</h3></font></div>");
$message = "Record deleted successfully";
header('Location:insert_job.php?msg='.$message);
?>