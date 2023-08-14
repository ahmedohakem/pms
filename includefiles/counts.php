<?php
//=========================
// APPROVED
//=========================
$SelectQur = mysqli_query($conn, "SELECT COUNT(employee_id) AS NumberOfRecord FROM `".$_SESSION['id']."_temp_tab` WHERE status_code = 4");
if(mysqli_num_rows($SelectQur) == 0) {
$NumberOfApprovedVar = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
{
$NumberOfApprovedVar = $row['NumberOfRecord'];
}
}



//=========================
// PENDING
//=========================
$SelectQur = mysqli_query($conn, "SELECT COUNT(employee_id) AS NumberOfRecord FROM `".$_SESSION['id']."_temp_tab` WHERE status_code = 2");
if(mysqli_num_rows($SelectQur) == 0) {
$NumberOfPendingVar = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
{
$NumberOfPendingVar = $row['NumberOfRecord'];
}
}


//=========================
// RETURN TO REVIEW
//=========================
$SelectQur = mysqli_query($conn, "SELECT COUNT(employee_id) AS NumberOfRecord FROM `".$_SESSION['id']."_temp_tab` WHERE status_code = 3");
if(mysqli_num_rows($SelectQur) == 0) {
$NumberOfRtrVar = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
{
$NumberOfRtrVar = $row['NumberOfRecord'];
}
}


//=========================
// NOT PROCESSED
//=========================
$SelectQur = mysqli_query($conn, "SELECT COUNT(employee_id) AS NumberOfRecord FROM `".$_SESSION['id']."_temp_tab2`");
if(mysqli_num_rows($SelectQur) == 0) {
$NumberOfNotProcessedVar = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
{
$NumberOfNotProcessedVar = $row['NumberOfRecord'];
}
}


//=========================
// NO OBJECTIVES
//=========================
$SelectQur = mysqli_query($conn, "SELECT * FROM employee_details
WHERE employee_status = 'ACTIVE'
AND deleted = '0'
AND hire_date <= '".$current_cycle_year."-07-01'
AND employee_id NOT IN (SELECT employee_id FROM objectives WHERE obj_year = '".$current_cycle_year."' GROUP BY employee_id HAVING SUM(obj_weight) = '1.00')
AND employee_id NOT IN (SELECT employee_id FROM fc_emps WHERE cycle_year = '".$current_cycle_year."')
AND company_id ".$company_id."");
if(mysqli_num_rows($SelectQur) == 0) {
$NumberOfNoObjectiveVar = 0;
}
else
{
$NumberOfNoObjectiveVar = mysqli_num_rows($SelectQur);
}


//=========================
// NOT APPLICABLE
//=========================
$SelectQur = mysqli_query($conn, "SELECT * FROM employee_details
WHERE employee_status = 'ACTIVE'
AND deleted = '0'
AND hire_date > '".$current_cycle_year."-07-01'
AND company_id ".$company_id."");
if(mysqli_num_rows($SelectQur) == 0) {
$NumberOfNAVar = 0;
}
else
{
$NumberOfNAVar = mysqli_num_rows($SelectQur);
}
?>