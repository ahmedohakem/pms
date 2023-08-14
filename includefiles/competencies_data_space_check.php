<?php
$SelectQur = mysqli_query($conn, "SELECT comp_id FROM employees_competencies WHERE employee_id = '".$employee_id."' AND comp_id IN (SELECT comp_id FROM competencies WHERE comp_year = '".$current_cycle_year."')");
if(mysqli_num_rows($SelectQur) == 0) {
mysqli_query($conn, "INSERT INTO employees_competencies (employee_id, comp_id) SELECT ".$employee_id.", comp_id FROM competencies WHERE comp_job_type = '".$job_type."' AND comp_year = '".$current_cycle_year."'");
}
else
{
// DO NOTHING
}
?>