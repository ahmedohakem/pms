<?php
include('includefiles/sess.php');
include('includefiles/conn_db.php');
include('includefiles/settings.php');
include('includefiles/enc.php');


$WeightCheckQur = "SELECT ver.employee_id, ver.SumWeight FROM (
SELECT employee_id, sum(obj_weight) AS SumWeight FROM objectives WHERE obj_id <> '".$_POST['obj_id']."' AND obj_year = '".$current_cycle_year."' GROUP BY employee_id
) ver
WHERE (ver.SumWeight + '".$_POST['obj_weight']."') <= '1.00'
AND employee_id = '".$_POST['employee_id']."'";
$WeightCheckQurRun = mysqli_query($conn, $WeightCheckQur);
if(mysqli_num_rows($WeightCheckQurRun) == 0) {
mysqli_query($conn, "DROP TABLE IF EXISTS ".$_POST['employee_id']."_curr_cycle_obj_temp_edit");
mysqli_query($conn, "CREATE TABLE ".$_POST['employee_id']."_curr_cycle_obj_temp_edit
(record_id int(255) NOT NULL AUTO_INCREMENT,
employee_id int(255),
obj_weight decimal(13,2) DEFAULT NULL,
obj_text varchar(2500) CHARACTER SET utf8 COLLATE utf8_bin,
course_id int(255),
month_id int(2),
PRIMARY KEY (record_id))");
mysqli_query($conn, "INSERT INTO ".$_POST['employee_id']."_curr_cycle_obj_temp_edit (employee_id, obj_weight, obj_text, course_id, month_id)
VALUES (".$_POST['employee_id'].", '".$_POST['obj_weight']."', '".mysqli_real_escape_string($conn, $_POST['obj_text'])."', '".$_POST['course_id']."', '".$_POST['month_id']."')");
header("location:update_current_cycle_objective.php?employee_id=".encrypt_decrypt('encrypt', $_POST['employee_id'])."&obj_id=".encrypt_decrypt('encrypt', $_POST['obj_id']));
}
else
{
mysqli_query($conn, "UPDATE objectives SET obj_weight = '".$_POST['obj_weight']."', obj_text = '".mysqli_real_escape_string($conn, $_POST['obj_text'])."', course_id = '".$_POST['course_id']."' WHERE obj_id = '".$_POST['obj_id']."'");
mysqli_query($conn, "UPDATE obj_trn_months SET trn_month = '".$_POST['month_id']."' WHERE obj_id = '".$_POST['obj_id']."'");
header("location:create_current_cycle_objective.php?employee_id=".encrypt_decrypt('encrypt', $_POST['employee_id']));
}
?>