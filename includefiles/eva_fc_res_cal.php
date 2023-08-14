<?php
$FinalResCalQur = "SELECT ROUND(wd_raits_avg, 0) AS Roundedwd_raits_avg,
CASE
    WHEN ROUND(wd_raits_avg, 0) = 5 THEN 'Significantly Exceed Expectation'
    WHEN ROUND(wd_raits_avg, 0) = 4 THEN 'Exceed Expectation'
    WHEN ROUND(wd_raits_avg, 0) = 3 THEN 'Meet Expectation'
    WHEN ROUND(wd_raits_avg, 0) = 2 THEN 'Below Expectation'
    WHEN ROUND(wd_raits_avg, 0) = 1 THEN 'Significantly Below Expectation'
    ELSE 'NOT DEFINED !!'
END AS FinalResult
FROM wd_raits_avg_by_emp
WHERE wd_year = '".$current_cycle_year."'
AND employee_id = '".$employee_id."'";
$FinalResCalQurRun = mysqli_query($conn, $FinalResCalQur);
if(mysqli_num_rows($FinalResCalQurRun) == 0) {
echo "<font color = 'red'> This NNN Not Setted Correctly!!! <br>System Can NOT Calculate Result.</font><br>";
}
else
{
while($row=mysqli_fetch_array($FinalResCalQurRun))
{
$RoundedFinalEvalVar = $row['Roundedwd_raits_avg'];
$FinalResultVar = $row['FinalResult'];
}
echo"
<table width='40%' border='0'>
  <tr>
    <td><strong>Result:</strong></td>
  </tr>
  </table>
<table width='40%' border='0'>
  <tr>
    <td><strong>Final Rating:</strong></td>
    <td><code> $RoundedFinalEvalVar </code></td>
  </tr>
  <tr>
    <td><strong>Overall Assessment:</strong></td>
    <td><code> $FinalResultVar </code></td>
  </tr>
</table>";
}
?>