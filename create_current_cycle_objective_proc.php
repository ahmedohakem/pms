<?php
//DATABASE CONNECTION & SESSION CHECK:
include('includefiles/sess.php');
include('includefiles/conn_db.php');
include('includefiles/settings.php');
include('includefiles/enc.php');


$SelectQur = mysqli_query($conn, "SELECT employee_id FROM objectives WHERE obj_year = '".$current_cycle_year."' AND employee_id = '".$_POST['employee_id']."'");
if(mysqli_num_rows($SelectQur) == 0) {
mysqli_query($conn, "INSERT INTO objectives (employee_id, obj_year, obj_weight, obj_rating, obj_text, course_id) VALUES ('".$_POST['employee_id']."', '".$current_cycle_year."', '".$_POST['obj_weight']."', NULL, '".mysqli_real_escape_string($conn, $_POST['obj_text'])."', '".$_POST['course_id']."')");
mysqli_query($conn, "INSERT INTO obj_trn_months
VALUES (last_insert_id(), '".$_POST['trn_month']."')");
header("location:create_current_cycle_objective.php?employee_id=".encrypt_decrypt('encrypt', $_POST['employee_id']));
}
else
{
$SelectQur = mysqli_query($conn, "SELECT ver.employee_id, ver.SumWeight FROM (
SELECT employee_id, sum(obj_weight) AS SumWeight FROM `objectives` WHERE obj_year = '".$current_cycle_year."' GROUP BY employee_id
) ver
WHERE (ver.SumWeight + '".$_POST['obj_weight']."') <= '1.00'
AND employee_id = '".$_POST['employee_id']."'");
if(mysqli_num_rows($SelectQur) == 0) {
//
header("location:create_current_cycle_objective.php?employee_id=".encrypt_decrypt('encrypt', $_POST['employee_id']));
}
else
{
mysqli_query($conn, "INSERT INTO objectives (employee_id, obj_year, obj_weight, obj_rating, obj_text, course_id) VALUES ('".$_POST['employee_id']."', '".$current_cycle_year."', '".$_POST['obj_weight']."', NULL, '".mysqli_real_escape_string($conn, $_POST['obj_text'])."', '".$_POST['course_id']."')");
mysqli_query($conn, "INSERT INTO obj_trn_months
VALUES (last_insert_id(), '".$_POST['trn_month']."')");
header("location:create_current_cycle_objective.php?employee_id=".encrypt_decrypt('encrypt', $_POST['employee_id']));
}
}
?>