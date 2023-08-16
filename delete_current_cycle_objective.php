<?php
//DATABASE CONNECTION & SESSION CHECK:
include('includefiles/conn_db.php');
include('includefiles/sess.php');
include('includefiles/enc.php');


mysqli_query($conn, "DELETE FROM objectives WHERE obj_id = '".$_POST['objective_id']."'");
header("location:create_current_cycle_objective.php?employee_id=".$_POST['employee_id']);
?>