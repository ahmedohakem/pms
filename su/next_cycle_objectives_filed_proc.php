<?php
//DATABASE CONNECTION & SESSION CHECK:
include('../includefiles/conn_db.php');
include('../includefiles/sess.php');
include('../includefiles/enc.php');



mysqli_query($conn, "UPDATE objectives_submission SET filed = '1', filed_timestamp = NOW(), filed_by_user_id = '".$_SESSION['id']."'
WHERE employee_id = '".$_POST['employee_id']."' AND objectives_year = '2020'")
or die ("<div align='center'><font color='red'><h3>SYSTEM ERROR!!...... TRANSACTION FAILED <a href='logout.php'>click here to re-try again</a>.</h3></font></div>");


//header("location:objectives_report.php?company_id=".encrypt_decrypt('encrypt', $_POST['company_id']));
header("location:objectives_report.php?company_id=".$_POST['company_id']);
?>