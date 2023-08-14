<?php
// Significantly Exceed Expectation //
$SelectQur = mysqli_query($conn, "SELECT IFNULL(COUNT(employee_id), 0) AS Significantly_Exceed_Expectation_Count FROM `".$_SESSION['id']."_temp_tab` WHERE RoundedFinalEval = '5'");
if(mysqli_num_rows($SelectQur) == 0) {
$Significantly_Exceed_Expectation_Count = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $Significantly_Exceed_Expectation_Count = $row['Significantly_Exceed_Expectation_Count'];
  }
}

$SelectQur = mysqli_query($conn, "SELECT IFNULL(ROUND(((SELECT COUNT(employee_id) AS Significantly_Exceed_Expectation_Count FROM `".$_SESSION['id']."_temp_tab` WHERE RoundedFinalEval = '5') / (SELECT COUNT(employee_id) FROM `".$_SESSION['id']."_temp_tab`)) * 100, 1), 0) AS Significantly_Exceed_Expectation_Count_Percentage");
if(mysqli_num_rows($SelectQur) == 0) {
$Significantly_Exceed_Expectation_Count_Percentage = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $Significantly_Exceed_Expectation_Count_Percentage = $row['Significantly_Exceed_Expectation_Count_Percentage'];
  }
}


// Exceed Expectation //
$SelectQur = mysqli_query($conn, "SELECT IFNULL(COUNT(employee_id), 0) AS Exceed_Expectation_Count FROM `".$_SESSION['id']."_temp_tab` WHERE RoundedFinalEval = '4'");
if(mysqli_num_rows($SelectQur) == 0) {
$Exceed_Expectation_Count = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $Exceed_Expectation_Count = $row['Exceed_Expectation_Count'];
  }
}

$SelectQur = mysqli_query($conn, "SELECT IFNULL(ROUND(((SELECT COUNT(employee_id) AS Exceed_Expectation_Count FROM `".$_SESSION['id']."_temp_tab` WHERE RoundedFinalEval = '4') / (SELECT COUNT(employee_id) FROM `".$_SESSION['id']."_temp_tab`)) * 100, 1), 0) AS Exceed_Expectation_Count_Percentage");
if(mysqli_num_rows($SelectQur) == 0) {
$Exceed_Expectation_Count_Percentage = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $Exceed_Expectation_Count_Percentage = $row['Exceed_Expectation_Count_Percentage'];
  }
}


// Meet Expectation //
$SelectQur = mysqli_query($conn, "SELECT IFNULL(COUNT(employee_id), 0) AS Meet_Expectation_Count FROM `".$_SESSION['id']."_temp_tab` WHERE RoundedFinalEval = '3'");
if(mysqli_num_rows($SelectQur) == 0) {
$Meet_Expectation_Count = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $Meet_Expectation_Count = $row['Meet_Expectation_Count'];
  }
}

$SelectQur = mysqli_query($conn, "SELECT IFNULL(ROUND(((SELECT COUNT(employee_id) AS Meet_Expectation_Count FROM `".$_SESSION['id']."_temp_tab` WHERE RoundedFinalEval = '3') / (SELECT COUNT(employee_id) FROM `".$_SESSION['id']."_temp_tab`)) * 100, 1), 0) AS Meet_Expectation_Count_Percentage");
if(mysqli_num_rows($SelectQur) == 0) {
$Meet_Expectation_Count_Percentage = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $Meet_Expectation_Count_Percentage = $row['Meet_Expectation_Count_Percentage'];
  }
}


// Below Expectation //
$SelectQur = mysqli_query($conn, "SELECT IFNULL(COUNT(employee_id), 0) AS Below_Expectation_Count FROM `".$_SESSION['id']."_temp_tab` WHERE RoundedFinalEval = '2'");
if(mysqli_num_rows($SelectQur) == 0) {
$Below_Expectation_Count = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $Below_Expectation_Count = $row['Below_Expectation_Count'];
  }
}

$SelectQur = mysqli_query($conn, "SELECT IFNULL(ROUND(((SELECT COUNT(employee_id) AS Below_Expectation_Count FROM `".$_SESSION['id']."_temp_tab` WHERE RoundedFinalEval = '2') / (SELECT COUNT(employee_id) FROM `".$_SESSION['id']."_temp_tab`)) * 100, 1), 0) AS Below_Expectation_Count_Percentage");
if(mysqli_num_rows($SelectQur) == 0) {
$Below_Expectation_Count_Percentage = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $Below_Expectation_Count_Percentage = $row['Below_Expectation_Count_Percentage'];
  }
}


// Significantly Below Expectation //
$SelectQur = mysqli_query($conn, "SELECT IFNULL(COUNT(employee_id), 0) AS Significantly_Below_Expectation_Count FROM `".$_SESSION['id']."_temp_tab` WHERE RoundedFinalEval = '1'");
if(mysqli_num_rows($SelectQur) == 0) {
$Significantly_Below_Expectation_Count = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $Significantly_Below_Expectation_Count = $row['Significantly_Below_Expectation_Count'];
  }
}

$SelectQur = mysqli_query($conn, "SELECT IFNULL(ROUND(((SELECT COUNT(employee_id) AS Significantly_Below_Expectation_Count FROM `".$_SESSION['id']."_temp_tab` WHERE RoundedFinalEval = '1') / (SELECT COUNT(employee_id) FROM `".$_SESSION['id']."_temp_tab`)) * 100, 1), 0) AS Significantly_Below_Expectation_Count_Percentage");
if(mysqli_num_rows($SelectQur) == 0) {
$Significantly_Below_Expectation_Count_Percentage = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $Significantly_Below_Expectation_Count_Percentage = $row['Significantly_Below_Expectation_Count_Percentage'];
  }
}

// Total Count //
$SelectQur = mysqli_query($conn, "SELECT IFNULL(COUNT(employee_id), 0) AS TotalCount FROM `".$_SESSION['id']."_temp_tab`");
if(mysqli_num_rows($SelectQur) == 0) {
$TotalCount = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $TotalCount = $row['TotalCount'];
  }
}


// Total Percentage //
$SelectQur = mysqli_query($conn, "SELECT IFNULL(ROUND(('$Significantly_Exceed_Expectation_Count_Percentage' + '$Exceed_Expectation_Count_Percentage' + '$Meet_Expectation_Count_Percentage' + '$Below_Expectation_Count_Percentage' + '$Significantly_Below_Expectation_Count_Percentage'), 0), 0) AS TotalPercentage");
if(mysqli_num_rows($SelectQur) == 0) {
$TotalPercentage = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $TotalPercentage = $row['TotalPercentage'];
  }
}

// Report Footer //
$SelectQur = mysqli_query($conn, "SELECT IFNULL(COUNT(employee_id), 0) AS employees_count FROM employees WHERE employee_status = 'ACTIVE' AND deleted = '0' ".$company_id."");
if(mysqli_num_rows($SelectQur) == 0) {
$employees_count = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $employees_count = $row['employees_count'];
  }
}

$SelectQur = mysqli_query($conn, "SELECT IFNULL(COUNT(employee_id), 0) AS assessed_employees_count FROM `".$_SESSION['id']."_temp_tab`");
if(mysqli_num_rows($SelectQur) == 0) {
$assessed_employees_count = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $assessed_employees_count = $row['assessed_employees_count'];
  }
}

$SelectQur = mysqli_query($conn, "SELECT IFNULL(ROUND(('".$assessed_employees_count."' / '".$employees_count."') * 100, 0), 0) AS assessed_percentage");
if(mysqli_num_rows($SelectQur) == 0) {
$assessed_percentage = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $assessed_percentage = $row['assessed_percentage'];
  }
}



$SelectQur = mysqli_query($conn, "SELECT SUM(RealTimeTable3.assessed_employees_count_per_company) AS total_assessed_employees_count, SUM(RealTimeTable3.employees_count_per_company) AS total_employees_count, SUM(RealTimeTable3.not_assessed_employees_count_per_company) AS total_not_assessed_employees_count,
ROUND((SUM(RealTimeTable3.assessed_employees_count_per_company) / SUM(RealTimeTable3.employees_count_per_company) * 100), 1) AS assessed_employees_percentage
FROM (
SELECT RealTimeTable1.company_id, RealTimeTable1.company_name, RealTimeTable1.employees_count_per_company,
IFNULL(RealTimeTable2.assessed_employees_count_per_company, '0') AS assessed_employees_count_per_company,
(IFNULL(RealTimeTable1.employees_count_per_company, '0') - IFNULL(RealTimeTable2.assessed_employees_count_per_company, '0')) AS not_assessed_employees_count_per_company,
ROUND((IFNULL(RealTimeTable2.assessed_employees_count_per_company, '0') / IFNULL(RealTimeTable1.employees_count_per_company, '0')) * 100, 1) AS assessed_employees_percentage_per_company
FROM (
SELECT company_id, company_name, COUNT(employee_id) AS employees_count_per_company
FROM employee_details
WHERE employee_status = 'ACTIVE' AND deleted = '0'
".$company_id."
GROUP BY company_id) AS RealTimeTable1
LEFT JOIN
(SELECT COUNT(employee_id) AS assessed_employees_count_per_company, company_id
FROM `".$_SESSION['id']."_temp_tab`
GROUP BY company_id) AS RealTimeTable2
ON RealTimeTable2.company_id = RealTimeTable1.company_id) RealTimeTable3");
if(mysqli_num_rows($SelectQur) == 0) {
//$assessed_percentage = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $total_assessed_employees_count = $row['total_assessed_employees_count'];
  $total_employees_count = $row['total_employees_count'];
  $total_not_assessed_employees_count = $row['total_not_assessed_employees_count'];
  $assessed_employees_percentage = $row['assessed_employees_percentage'];
  }
}




$SelectQur = mysqli_query($conn, "SELECT IFNULL(COUNT(employee_id), 0) AS applicable_employees_count FROM employee_details
WHERE employee_status = 'ACTIVE'
AND deleted = '0'
AND hire_date <= '".$current_cycle_year."-07-01'
".$company_id."");
if(mysqli_num_rows($SelectQur) == 0) {
$applicable_employees_count = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $applicable_employees_count = $row['applicable_employees_count'];
  }
}



$SelectQur = mysqli_query($conn, "SELECT ROUND(('".$assessed_employees_count."' / '".$applicable_employees_count."') * 100, 0) AS assessed_percentage");
if(mysqli_num_rows($SelectQur) == 0) {
$assessed_percentage = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $assessed_percentage = $row['assessed_percentage'];
  }
}





$SelectQur = mysqli_query($conn, "SELECT IFNULL((".$total_employees_count." - ".$applicable_employees_count."), 0) AS not_applicable_employees_count");
if(mysqli_num_rows($SelectQur) == 0) {
$not_applicable_employees_count = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $not_applicable_employees_count = $row['not_applicable_employees_count'];
  }
}









// Percentages for Bell Curve//
$SelectQur = mysqli_query($conn, "SELECT IFNULL(ROUND(((".$applicable_employees_count." * 5) / 100), 0), 0) AS applicable_employees_5_percentage");
if(mysqli_num_rows($SelectQur) == 0) {
$applicable_employees_5_percentage = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $applicable_employees_5_percentage = $row['applicable_employees_5_percentage'];
  }
}
$SelectQur = mysqli_query($conn, "SELECT IFNULL(ROUND(((".$applicable_employees_count." * 17.5) / 100), 0), 0) AS applicable_employees_17_point_percentage");
if(mysqli_num_rows($SelectQur) == 0) {
$applicable_employees_17_point_percentage = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $applicable_employees_17_point_percentage = $row['applicable_employees_17_point_percentage'];
  }
}
$SelectQur = mysqli_query($conn, "SELECT IFNULL(ROUND(((".$applicable_employees_count." * 55) / 100), 0), 0) AS applicable_employees_55_percentage");
if(mysqli_num_rows($SelectQur) == 0) {
$applicable_employees_55_percentage = 0;
}
else
{
while($row = mysqli_fetch_array($SelectQur))
  {
  $applicable_employees_55_percentage = $row['applicable_employees_55_percentage'];
  }
}
?>