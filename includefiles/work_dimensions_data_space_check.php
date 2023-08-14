<?php
$SelectQur = mysqli_query($conn, "SELECT wd_id FROM employees_work_dimensions WHERE employee_id = '".$employee_id."' AND wd_id IN (SELECT wd_id FROM work_dimensions WHERE wd_year = '".$current_cycle_year."')");
if(mysqli_num_rows($SelectQur) == 0) {
mysqli_query($conn, "INSERT INTO employees_work_dimensions (employee_id, wd_id) SELECT ".$employee_id.", wd_id FROM work_dimensions WHERE wd_year = '".$current_cycle_year."'");
}
else
{
// DO NOTHING
}
?>