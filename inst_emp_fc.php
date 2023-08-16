<?php
//DATABASE CONNECTION & SESSION CHECK:
include('includefiles/sess.php');
include('includefiles/conn_db.php');
include('includefiles/settings.php');

mysqli_query($conn, "INSERT INTO fc_emps (employee_id, cycle_year) VALUES (".$_POST['employee_id'].", '".$current_cycle_year."')");

header("location:employees.php");
?>