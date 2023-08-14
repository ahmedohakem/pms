<?php
$FinalResCalQur = "SELECT ver.employee_id, ver.FinalCompRait, ver.RoundedFinalCompRait, ver.FinalObjRait, ver.RoundedFinalObjRait, ver.FinalEval, ver.RoundedFinalEval,
CASE
    WHEN ver.RoundedFinalEval = 5 THEN 'Significantly Exceed Expectation'
    WHEN ver.RoundedFinalEval = 4 THEN 'Exceed Expectation'
    WHEN ver.RoundedFinalEval = 3 THEN 'Meet Expectation'
    WHEN ver.RoundedFinalEval = 2 THEN 'Below Expectation'
    WHEN ver.RoundedFinalEval = 1 THEN 'Significantly Below Expectation'
    ELSE 'NOT DEFINED !!'
END AS FinalResult,
ver.obj_year
FROM
(SELECT crabe.employee_id, crabe.comps_raits_avg, ossbe.objs_scores_sum,
(crabe.comps_raits_avg * ($CompPercentageVar / 100)) AS FinalCompRait,
ROUND((crabe.comps_raits_avg * ($CompPercentageVar / 100)), 2) AS RoundedFinalCompRait,
(ossbe.objs_scores_sum * ($ObjPercentageVar / 100)) AS FinalObjRait,
ROUND((ossbe.objs_scores_sum * ($ObjPercentageVar / 100)), 2) AS RoundedFinalObjRait,
((crabe.comps_raits_avg * ($CompPercentageVar / 100)) + (ossbe.objs_scores_sum * ($ObjPercentageVar / 100))) AS FinalEval,
ROUND((ROUND((crabe.comps_raits_avg * ($CompPercentageVar / 100)), 2) + ROUND((ossbe.objs_scores_sum * ($ObjPercentageVar / 100)), 2)), 0) AS RoundedFinalEval, ossbe.obj_year
FROM comps_raits_avg_by_emp crabe, objs_scores_sum_by_emp ossbe
WHERE crabe.employee_id = ossbe.employee_id) ver
WHERE ver.obj_year = '".$current_cycle_year."'
AND ver.employee_id = '".$employee_id."'";
$FinalResCalQurRun = mysqli_query($conn, $FinalResCalQur);
if(mysqli_num_rows($FinalResCalQurRun) == 0) {
echo "<font color = 'red'> This Evaluation Not Setted Correctly!!! <br>System Can NOT Calculate Result.</font><br>";
}
else
{
while($row=mysqli_fetch_array($FinalResCalQurRun))
{
$FinalCompRaitVar = $row['FinalCompRait'];
$RoundedFinalCompRaitVar = $row['RoundedFinalCompRait'];
$FinalObjRaitVar = $row['FinalObjRait'];
$RoundedFinalObjRaitVar = $row['RoundedFinalObjRait'];
$FinalEvalVar = $row['FinalEval'];
$RoundedFinalEvalVar = $row['RoundedFinalEval'];
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
    <td><strong>Final Objectives Rating:</strong></td>
    <td><code> $RoundedFinalObjRaitVar </code></td>
  </tr>
  <tr>
    <td><strong>Final Competencies Rating</strong></td>
    <td><code> $RoundedFinalCompRaitVar </code></td>
  </tr>
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