<?php
include('../includefiles/sess.php');
include('../includefiles/conn_db.php');
include('../includefiles/settings.php');
include('../includefiles/user_session_info.php');

if (empty($_POST['company_id'])) { $company_name = "All Companies" ; $company_id = "IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."')"; }
else { $CompanySelectQur = mysqli_query($conn, "SELECT company_name FROM companies WHERE company_id = '".$_POST['company_id']."'");
while($row = mysqli_fetch_array($CompanySelectQur))
{
$company_name = $row['company_name'];
} 
$company_id = "= '".$_POST['company_id']."'";
}


if (empty($_POST['company_id'])) { $company_name = "All Companies" ; $company_id = "IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."')"; }

else
{

if ($_POST['company_id'] == 22) {
$CompanySelectQur = mysqli_query($conn, "SELECT company_name FROM companies WHERE company_id = '".$_POST['company_id']."'");
while($row = mysqli_fetch_array($CompanySelectQur))
{
$company_name = $row['company_name'];
}
$company_id = "IN (3, 5, 6, 7, 8, 9, 10)";
}

elseif ($_POST['company_id'] == 23) {
$CompanySelectQur = mysqli_query($conn, "SELECT company_name FROM companies WHERE company_id = '".$_POST['company_id']."'");
while($row = mysqli_fetch_array($CompanySelectQur))
{
$company_name = $row['company_name'];
}
$company_id = "IN (16, 20, 21, 24, 25)";
}

else {
$CompanySelectQur = mysqli_query($conn, "SELECT company_name FROM companies WHERE company_id = '".$_POST['company_id']."'");
while($row = mysqli_fetch_array($CompanySelectQur))
{
$company_name = $row['company_name'];
}
$company_id = "= '".$_POST['company_id']."'";
}

}

// Prepare Data for Selecting BEGIN:
//==================================================================================================================

mysqli_query($conn, "DROP TABLE IF EXISTS `".$_SESSION['id']."_temp_tab`");
mysqli_query($conn, "CREATE TABLE `".$_SESSION['id']."_temp_tab` (
  `employee_id` int(255) NOT NULL DEFAULT '0',
  `full_name` varchar(400) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `company_id` int(255) NOT NULL,
  `company_name` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `department_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `job_title` varchar(150) CHARACTER SET utf8 NOT NULL,
  `job_type` enum('Supervisor','Non-Supervisor') NOT NULL,
  `manager_full_name` varchar(403) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `reviewing_manager_full_name` varchar(400) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `form_type` varchar(1) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `status_code` int(1) NOT NULL,
  `status_text` varchar(100) CHARACTER SET utf8 NOT NULL,
  `status_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `RoundedFinalEval` decimal(38,0) DEFAULT NULL,
  `FinalResult` varchar(35) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1") or die (header('Location:logout.php'));

// PROCESSED Form A, B
mysqli_query($conn, "INSERT INTO `".$_SESSION['id']."_temp_tab` (SELECT ed.employee_id, ed.full_name, ed.company_id, ed.company_name, ed.department_name, ed.job_title, ed.job_type, ed.manager_full_name, ed.reviewing_manager_full_name,
CASE
WHEN ed.job_type = 'Supervisor' THEN 'A'
WHEN ed.job_type = 'Non-Supervisor' THEN 'B'
ELSE 'NOT DEFINED !!'
END AS form_type,
ft.status_code, ft.status_text, ft.status_timestamp,
RealTimeTable.RoundedFinalEval, RealTimeTable.FinalResult
FROM form_tracker ft, employee_details ed,
(SELECT ver.employee_id, ver.RoundedFinalEval, ver.obj_year,
CASE
    WHEN ver.RoundedFinalEval = 5 THEN 'Significantly Exceed Expectation'
    WHEN ver.RoundedFinalEval = 4 THEN 'Exceed Expectation'
    WHEN ver.RoundedFinalEval = 3 THEN 'Meet Expectation'
    WHEN ver.RoundedFinalEval = 2 THEN 'Below Expectation'
    WHEN ver.RoundedFinalEval = 1 THEN 'Significantly Below Expectation'
    ELSE 'NOT DEFINED !!'
END AS FinalResult
FROM
(SELECT crabe.employee_id,
CASE
WHEN ed.job_type = 'Supervisor' THEN ROUND((ROUND((crabe.comps_raits_avg * (40 / 100)), 2) + ROUND((ossbe.objs_scores_sum * (60 / 100)), 2)), 0)
WHEN ed.job_type = 'Non-Supervisor' THEN ROUND((ROUND((crabe.comps_raits_avg * (30 / 100)), 2) + ROUND((ossbe.objs_scores_sum * (70 / 100)), 2)), 0)
ELSE ''
END AS RoundedFinalEval,
ossbe.obj_year
FROM comps_raits_avg_by_emp crabe, objs_scores_sum_by_emp ossbe, employee_details ed
WHERE crabe.employee_id = ossbe.employee_id
AND crabe.employee_id = ed.employee_id) ver) RealTimeTable
WHERE ft.employee_id = ed.employee_id
AND RealTimeTable.employee_id = ed.employee_id
AND ft.record_id IN(SELECT MAX(record_id) AS max_record_id
FROM form_tracker
WHERE status_code <> 1
GROUP BY employee_id)
AND RealTimeTable.obj_year = '".$current_cycle_year."'
AND ed.company_id ".$company_id.")") or die (header('Location:logout.php'));


// PROCESSED Form C
mysqli_query($conn, "INSERT INTO `".$_SESSION['id']."_temp_tab` (SELECT ed.employee_id, ed.full_name, ed.company_id, ed.company_name, ed.department_name, ed.job_title, ed.job_type, ed.manager_full_name, ed.reviewing_manager_full_name,
'C' AS form_type,
ft.status_code, ft.status_text, ft.status_timestamp,
RealTimeTable.Roundedwd_raits_avg, RealTimeTable.FinalResult
FROM form_tracker ft, employee_details ed,
(SELECT employee_id, ROUND(wd_raits_avg, 0) AS Roundedwd_raits_avg, wd_year,
CASE
    WHEN ROUND(wd_raits_avg, 0) = 5 THEN 'Significantly Exceed Expectation'
    WHEN ROUND(wd_raits_avg, 0) = 4 THEN 'Exceed Expectation'
    WHEN ROUND(wd_raits_avg, 0) = 3 THEN 'Meet Expectation'
    WHEN ROUND(wd_raits_avg, 0) = 2 THEN 'Below Expectation'
    WHEN ROUND(wd_raits_avg, 0) = 1 THEN 'Significantly Below Expectation'
    ELSE 'NOT DEFINED !!'
END AS FinalResult
FROM wd_raits_avg_by_emp) RealTimeTable
WHERE ft.employee_id = ed.employee_id
AND RealTimeTable.employee_id = ed.employee_id
AND ft.record_id IN(SELECT MAX(record_id) AS max_record_id
FROM form_tracker
WHERE status_code <> 1
GROUP BY employee_id)
AND RealTimeTable.wd_year = '".$current_cycle_year."'
AND ed.company_id ".$company_id.")") or die (header('Location:logout.php'));


//  NOT PROCESSED FORM A, B
mysqli_query($conn, "DROP TABLE IF EXISTS `".$_SESSION['id']."_temp_tab2`");
mysqli_query($conn, "CREATE TABLE `".$_SESSION['id']."_temp_tab2` (
  `employee_id` int(255) NOT NULL DEFAULT '0',
  `full_name` varchar(400) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `company_id` int(255) NOT NULL,
  `company_name` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `department_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `job_title` varchar(150) CHARACTER SET utf8 NOT NULL,
  `job_type` enum('Supervisor','Non-Supervisor') NOT NULL,
  `manager_full_name` varchar(403) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `reviewing_manager_full_name` varchar(400) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `form_type` varchar(14) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1") or die (header('Location:logout.php'));

mysqli_query($conn, "INSERT INTO `".$_SESSION['id']."_temp_tab2` (SELECT employee_id, full_name, company_id, company_name, department_name, job_title, job_type, manager_full_name, reviewing_manager_full_name,
CASE
WHEN job_type = 'Supervisor' THEN 'A'
WHEN job_type = 'Non-Supervisor' THEN 'B'
ELSE 'NOT DEFINED !!'
END AS form_type
FROM employee_details
WHERE employee_id IN (SELECT employee_id
FROM objectives
WHERE employee_id NOT IN (SELECT employee_id FROM form_tracker WHERE status_code <> 1)
AND obj_year = '".$current_cycle_year."'
AND company_id ".$company_id."
GROUP BY employee_id, obj_year
HAVING SUM(obj_weight) = '1.00'))") or die (header('Location:logout.php'));



//  NOT PROCESSED FORM C
mysqli_query($conn, "INSERT INTO `".$_SESSION['id']."_temp_tab2` (SELECT employee_id, full_name, company_id, company_name, department_name, job_title, job_type, manager_full_name, reviewing_manager_full_name, 'C' AS form_type
FROM employee_details
WHERE employee_id IN (SELECT employee_id FROM fc_emps WHERE cycle_year = '".$current_cycle_year."')
AND employee_id NOT IN(SELECT employee_id FROM form_tracker WHERE status_code <> '1')
AND company_id ".$company_id.")") or die (header('Location:logout.php'));

// Prepare Data for Selecting END:
//==================================================================================================================


include('../includefiles/counts.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?php include('../includefiles/title.php'); ?></title>

<link rel="stylesheet" href="../css/style.css" />
<!-- favicon links -->
<link rel="shortcut icon" type="image/ico" href="../img/icons/favicon.ico" />
<link rel="icon" type="image/ico" href="../img/icons/favicon.ico" />
</head>
<body>
<a name='goup'>
<div align="center">
<table width="90%" border="0">
  <tr>
    <td align="left"><img src="../img/logo.png" width="208px" height="146px"></td>
  </tr>
  </table>
  <table width="60%" border="0">
    <tr>
    <td><div align="left"><input type=button onClick="location.href='cycle_report_filter.php'" value='Back to Filter'>&nbsp;<input type=button onClick="location.href='main.php'" value='Back to Main'>&nbsp;<input type=button onClick="location.href='logout.php'" value='LogOut'></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong><?php echo $company_name; ?> Cycle Situation<br><?php echo date("Y-F-d"); ?></font> || <?php echo $current_session_first_name; ?> [<?php echo $current_session_employee_id; ?>]</strong></div><hr width="99%"></td>
  </tr>
</table>
</div>
<div class="PositionFixed">
<a href="#goup" title="Go Top"><img src="../img/icons/GoUp.png"></a>
</div>
<div align="center">
<script src="../graph/code/highcharts.js"></script>
<script src="../graph/code/modules/data.js"></script>
<script src="../graph/code/modules/drilldown.js"></script>
<script src="../graph/code/modules/exporting.js"></script>

<div id="chartContainer" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


		<script type="text/javascript">

// Create the chart
Highcharts.chart('chartContainer', {
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Employee Count'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
    },

    tooltip: {
        headerFormat: '',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b><br/>'
    },

    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: '<a href="#approved_list" title="Jumb to Approved List">Approved</a>',
            y: <?php echo $NumberOfApprovedVar; ?>
        }, {
            name: '<a href="#Pending_list" title="Jumb to Pending List">Pending</a>',
            y: <?php echo $NumberOfPendingVar; ?>
        }, {
            name: '<a href="#Return_to_Review_list" title="Jumb to Return to Review List">Return to Review</a>',
            y: <?php echo $NumberOfRtrVar; ?>
        },{
            name: '<a href="#Not_Processed_list" title="Jumb to Not Processed List">Not Processed</a>',
            y: <?php echo $NumberOfNotProcessedVar; ?>
        },{
            name: '<a href="#Objectives_Not_Inserted_list" title="Jumb to Objectives Not Inserted List">Objectives Not Inserted</a>',
            y: <?php echo $NumberOfNoObjectiveVar; ?>
        },{
            name: '<a href="#NA_This_Year_list" title="Jumb to NA This Year List">NA This Year</a>',
            y: <?php echo $NumberOfNAVar; ?>
        }]
    }],
    drilldown: {  } 
});
</script>
<?php
$Total = $NumberOfApprovedVar + $NumberOfPendingVar + $NumberOfRtrVar + $NumberOfNotProcessedVar + $NumberOfNoObjectiveVar + $NumberOfNAVar;
echo "<strong>Total ".$Total."</strong>";
?>
<p>&nbsp;</p>
<div class="styled">
<?php
$SelectQur = mysqli_query($conn, "SELECT * FROM `".$_SESSION['id']."_temp_tab` WHERE status_code = 4 AND employee_id <> (SELECT employee_id FROM sys_users WHERE sys_user_id = '".$_SESSION['id']."') ORDER BY RoundedFinalEval DESC");
if(mysqli_num_rows($SelectQur) == 0) {
// echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
$NumberOfRecordVar = mysqli_num_rows($SelectQur);
echo "<a name='approved_list'>";
echo "<table border='1' width='90%'>
<tr><td align='left'><strong>Approved Forms: $NumberOfRecordVar</strong></td></tr></table>";
echo "<table border='1' width='90%'>
<tr>
<th>#</th>
<th>Ref.</th>
<th>Name</th>
<th>Company</th>
<th>Department</th>
<th>Job Type</th>
<th>Job Title</th>
<th>Form Type</th>
<th>Direct Manager</th>
<th>Reviewing Manager</th>
<th>Rating</th>
<th>Assessment</th>
<th>#</th>
</tr>";
$n=1;
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>";
  echo "<td  align= 'center'>" . $n . "</td>";
  echo "<td  align= 'left'>" . $row['employee_id'] . "</td>";
  echo "<td  align= 'left'>" . $row['full_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['company_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['department_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['job_type'] . "</td>";
  echo "<td  align= 'left'>" . $row['job_title'] . "</td>";
  echo "<td  align= 'center'>" . $row['form_type'] . "</td>";
  echo "<td  align= 'left'>" . $row['manager_full_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['reviewing_manager_full_name'] . "</td>";
  echo "<td  align= 'center'>" . $row['RoundedFinalEval'] . "</td>";
  echo "<td  align= 'left'>" . $row['FinalResult'] . "</td>";
  echo "<td  align= 'center'><form method='POST' action='approved_form.php'><input type='hidden' name='company_id' value='".$_POST['company_id']."'><input type='hidden' name='employee_id' value='".$row['employee_id']."'> <div class='row'><input type='submit' value='Display'></div></form></td>";
  echo "</tr>";
  $n++;
  }
  echo "</table>";
  }
?>
<p>&nbsp;</p>
<?php
$SelectQur = mysqli_query($conn, "SELECT * FROM `".$_SESSION['id']."_temp_tab` WHERE status_code = 2 AND employee_id <> (SELECT employee_id FROM sys_users WHERE sys_user_id = '".$_SESSION['id']."')");
if(mysqli_num_rows($SelectQur) == 0) {
// echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
$NumberOfRecordVar = mysqli_num_rows($SelectQur);
echo "<a name='Pending_list'>";
echo "<table border='1' width='90%'>
<tr><td align='left'><strong>Pending Forms: $NumberOfRecordVar</strong></td></tr></table>";
echo "<table border='1' width='90%'>
<tr>
<th>#</th>
<th>Ref.</th>
<th>Name</th>
<th>Company</th>
<th>Department</th>
<th>Job Type</th>
<th>Job Title</th>
<th>Form Type</th>
<th>Direct Manager</th>
<th>Reviewing Manager</th>
<th>Rating</th>
<th>Assessment</th>
<th>#</th>
</tr>";
$n=1;
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>";
  echo "<td  align= 'center'>" . $n . "</td>";
  echo "<td  align= 'left'>" . $row['employee_id'] . "</td>";
  echo "<td  align= 'left'>" . $row['full_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['company_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['department_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['job_type'] . "</td>";
  echo "<td  align= 'left'>" . $row['job_title'] . "</td>";
  echo "<td  align= 'center'>" . $row['form_type'] . "</td>";
  echo "<td  align= 'left'>" . $row['manager_full_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['reviewing_manager_full_name'] . "</td>";
  echo "<td  align= 'center'>" . $row['RoundedFinalEval'] . "</td>";
  echo "<td  align= 'left'>" . $row['FinalResult'] . "</td>";
  echo "<td  align= 'center'><form method='POST' action='pending_form.php'><input type='hidden' name='company_id' value='".$_POST['company_id']."'><input type='hidden' name='employee_id' value='".$row['employee_id']."'> <div class='row'><input type='submit' value='Display'></div></form></td>";

  echo "</tr>";
  $n++;
  }
  echo "</table>";
  }
?>
<p>&nbsp;</p>
<?php
$SelectQur = mysqli_query($conn, "SELECT * FROM `".$_SESSION['id']."_temp_tab` WHERE status_code = 3 AND employee_id <> (SELECT employee_id FROM sys_users WHERE sys_user_id = '".$_SESSION['id']."')");
if(mysqli_num_rows($SelectQur) == 0) {
// echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
$NumberOfRecordVar = mysqli_num_rows($SelectQur);
echo "<a name='Return_to_Review_list'>";
echo "<table border='1' width='90%'>
<tr><td align='left'><strong>Returned to Review Forms: $NumberOfRecordVar</strong></td></tr></table>";
echo "<table border='1' width='90%'>
<tr>
<th>#</th>
<th>Ref.</th>
<th>Name</th>
<th>Company</th>
<th>Department</th>
<th>Job Type</th>
<th>Job Title</th>
<th>Form Type</th>
<th>Direct Manager</th>
<th>Reviewing Manager</th>
<th>Rating</th>
<th>Assessment</th>
<th>#</th>
</tr>";
$n=1;
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>";
  echo "<td  align= 'center'>" . $n . "</td>";
  echo "<td  align= 'left'>" . $row['employee_id'] . "</td>";
  echo "<td  align= 'left'>" . $row['full_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['company_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['department_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['job_type'] . "</td>";
  echo "<td  align= 'left'>" . $row['job_title'] . "</td>";
  echo "<td  align= 'center'>" . $row['form_type'] . "</td>";
  echo "<td  align= 'left'>" . $row['manager_full_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['reviewing_manager_full_name'] . "</td>";
  echo "<td  align= 'center'>" . $row['RoundedFinalEval'] . "</td>";
  echo "<td  align= 'left'>" . $row['FinalResult'] . "</td>";
  echo "<td  align= 'center'><form method='POST' action='returned_form.php'><input type='hidden' name='company_id' value='".$_POST['company_id']."'><input type='hidden' name='employee_id' value='".$row['employee_id']."'> <div class='row'><input type='submit' value='Display'></div></form></td>";

  echo "</tr>";
  $n++;
  }
  echo "</table>";
  }
?>
<p>&nbsp;</p>
<?php
$SelectQur = mysqli_query($conn, "SELECT * FROM `".$_SESSION['id']."_temp_tab2` WHERE employee_id <> (SELECT employee_id FROM sys_users WHERE sys_user_id = '".$_SESSION['id']."')");
if(mysqli_num_rows($SelectQur) == 0) {
// echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
$NumberOfRecordVar = mysqli_num_rows($SelectQur);
echo "<a name='Not_Processed_list'>";
echo "<table border='1' width='90%'>
<tr><td align='left'><strong>Forms Not Processed Yet: $NumberOfRecordVar</strong></td></tr></table>";
echo "<table border='1' width='90%'>
<tr>
<th>#</th>
<th>Ref.</th>
<th>Name</th>
<th>Company</th>
<th>Department</th>
<th>Job Type</th>
<th>Job Title</th>
<th>Form Type</th>
<th>Direct Manager</th>
<th>Reviewing Manager</th>
</tr>";
$n=1;
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>";
  echo "<td  align= 'center'>" . $n . "</td>";
  echo "<td  align= 'left'>" . $row['employee_id'] . "</td>";
  echo "<td  align= 'left'>" . $row['full_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['company_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['department_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['job_type'] . "</td>";
  echo "<td  align= 'left'>" . $row['job_title'] . "</td>";
  echo "<td  align= 'center'>" . $row['form_type'] . "</td>";
  echo "<td  align= 'left'>" . $row['manager_full_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['reviewing_manager_full_name'] . "</td>";

  echo "</tr>";
  $n++;
  }
  echo "</table>";
  }
?>
<p>&nbsp;</p>
<?php
$SelectQur = mysqli_query($conn, "SELECT * FROM employee_details
WHERE employee_status = 'ACTIVE'
AND deleted = '0'
AND hire_date <= '".$current_cycle_year."-07-01'
AND employee_id NOT IN (SELECT employee_id FROM objectives WHERE obj_year = '".$current_cycle_year."' GROUP BY employee_id HAVING SUM(obj_weight) = '1.00')
AND employee_id NOT IN (SELECT employee_id FROM fc_emps WHERE cycle_year = '".$current_cycle_year."')
AND employee_id <> (SELECT employee_id FROM sys_users WHERE sys_user_id = '".$_SESSION['id']."')
AND company_id ".$company_id."");
if(mysqli_num_rows($SelectQur) == 0) {
// echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
$NumberOfRecordVar = mysqli_num_rows($SelectQur);
echo "<a name='Objectives_Not_Inserted_list'>";
echo "<table border='1' width='90%'>
<tr><td align='left'><strong>Employees Objectives Not Inserted: $NumberOfRecordVar</strong></td></tr></table>";
echo "<table border='1' width='90%'>
<tr>
<th>#</th>
<th>Ref.</th>
<th>Name</th>
<th>Company</th>
<th>Department</th>
<th>Job Type</th>
<th>Job Title</th>
<th>Direct Manager</th>
<th>Reviewing Manager</th>
</tr>";
$n=1;
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>";
  echo "<td  align= 'center'>" . $n . "</td>";
  echo "<td  align= 'left'>" . $row['employee_id'] . "</td>";
  echo "<td  align= 'left'>" . $row['full_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['company_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['department_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['job_type'] . "</td>";
  echo "<td  align= 'left'>" . $row['job_title'] . "</td>";
  echo "<td  align= 'left'>" . $row['manager_full_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['reviewing_manager_full_name'] . "</td>";

  echo "</tr>";
  $n++;
  }
  echo "</table>";
  }
?>
<p>&nbsp;</p>
<?php
$SelectQur = mysqli_query($conn, "SELECT * FROM employee_details
WHERE employee_status = 'ACTIVE'
AND deleted = '0'
AND hire_date > '".$current_cycle_year."-07-01'
AND company_id ".$company_id."
AND employee_id <> (SELECT employee_id FROM sys_users WHERE sys_user_id = '".$_SESSION['id']."')");
if(mysqli_num_rows($SelectQur) == 0) {
// echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
$NumberOfRecordVar = mysqli_num_rows($SelectQur);
echo "<a name='NA_This_Year_list'>";
echo "<table border='1' width='90%'>
<tr><td align='left'><strong>Employees Not Applicable in This Year Evaluation: $NumberOfRecordVar</strong></td></tr></table>";
echo "<table border='1' width='90%'>
<tr>
<th>#</th>
<th>Ref.</th>
<th>Name</th>
<th>Company</th>
<th>Department</th>
<th>Job Type</th>
<th>Job Title</th>
<th>Direct Manager</th>
<th>Hire Date</th>
</tr>";
$n=1;
while($row = mysqli_fetch_array($SelectQur))
  {
  echo "<tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>";
  echo "<td  align= 'center'>" . $n . "</td>";
  echo "<td  align= 'left'>" . $row['employee_id'] . "</td>";
  echo "<td  align= 'left'>" . $row['full_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['company_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['department_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['job_type'] . "</td>";
  echo "<td  align= 'left'>" . $row['job_title'] . "</td>";
  echo "<td  align= 'left'>" . $row['manager_full_name'] . "</td>";
  echo "<td  align= 'left'>" . $row['hire_date'] . "</td>";

  echo "</tr>";
  $n++;
  }
  echo "</table>";
  echo "<p>&nbsp;</p>";
  }
?>
<p>&nbsp;</p>
</div>
</div>
<div align="center">
<?php
include('../includefiles/footer.php');
?>
<?php
mysqli_query($conn, "DROP TABLE IF EXISTS `".$_SESSION['id']."_temp_tab`");
mysqli_query($conn, "DROP TABLE IF EXISTS `".$_SESSION['id']."_temp_tab2`");
?>
</div>
</body>
</html>