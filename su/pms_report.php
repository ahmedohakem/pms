<?php
include('../includefiles/sess.php');
include('../includefiles/conn_db.php');
include('../includefiles/settings.php');
include('../includefiles/user_session_info.php');



if (empty($_POST['company_id'])) { $company_name = "Elnefeidi Group" ; $company_id = "AND company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."')"; }

else
{

if ($_POST['company_id'] == 22) {
$CompanySelectQur = mysqli_query($conn, "SELECT company_name FROM companies WHERE company_id = '".$_POST['company_id']."'");
while($row = mysqli_fetch_array($CompanySelectQur))
{
$company_name = $row['company_name'];
}
$company_id = "AND company_id IN (3, 5, 6, 7, 8, 9, 10)";
}

elseif ($_POST['company_id'] == 23) {
$CompanySelectQur = mysqli_query($conn, "SELECT company_name FROM companies WHERE company_id = '".$_POST['company_id']."'");
while($row = mysqli_fetch_array($CompanySelectQur))
{
$company_name = $row['company_name'];
}
$company_id = "AND company_id IN (16, 20, 21, 24, 25)";
}

else {
$CompanySelectQur = mysqli_query($conn, "SELECT company_name FROM companies WHERE company_id = '".$_POST['company_id']."'");
while($row = mysqli_fetch_array($CompanySelectQur))
{
$company_name = $row['company_name'];
}
$company_id = "AND company_id = '".$_POST['company_id']."'";
}

}

// Prepare Data for Selecting BEGIN:
//==================================================================================================================

mysqli_query($conn, "DROP TABLE IF EXISTS `".$_SESSION['id']."_temp_tab`");
mysqli_query($conn, "CREATE TABLE `".$_SESSION['id']."_temp_tab` (
  `employee_id` int(255) NOT NULL DEFAULT '0',
  `company_id` int(255) NOT NULL,
  `job_type` enum('Supervisor','Non-Supervisor') NOT NULL,
  `RoundedFinalEval` decimal(38,0) DEFAULT NULL,
  `FinalResult` varchar(14) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1") or die (header('Location:logout.php'));


mysqli_query($conn, "INSERT INTO `".$_SESSION['id']."_temp_tab` (
SELECT RealTimeTable3.*, RealTimeTable4.RoundedFinalEval, RealTimeTable4.FinalResult
FROM(
SELECT RealTimeTable.employee_id, RealTimeTable.company_id, RealTimeTable.job_type
FROM
(
SELECT employee_id, job_type, company_id
FROM employee_details
WHERE employee_status = 'ACTIVE'
AND deleted = '0' 
AND hire_date <= '".$current_cycle_year."-07-01'
) RealTimeTable,
(
SELECT * FROM form_tracker WHERE record_id IN(
SELECT MAX(record_id) AS record_id FROM form_tracker WHERE status_code = '4' GROUP BY employee_id)
) RealTimeTable2
WHERE RealTimeTable.employee_id = RealTimeTable2.employee_id) RealTimeTable3,


(
SELECT ver.employee_id, ver.RoundedFinalEval,
CASE
    WHEN ver.RoundedFinalEval = 5 THEN 'Significantly Exceed Expectation'
    WHEN ver.RoundedFinalEval = 4 THEN 'Exceed Expectation'
    WHEN ver.RoundedFinalEval = 3 THEN 'Meet Expectation'
    WHEN ver.RoundedFinalEval = 2 THEN 'Below Expectation'
    WHEN ver.RoundedFinalEval = 1 THEN 'Significantly Below Expectation'
    ELSE 'NOT DEFINED !!'
END AS FinalResult
FROM
(SELECT crabe.employee_id, crabe.comps_raits_avg, ossbe.objs_scores_sum,
CASE
WHEN e.job_type = 'Supervisor' THEN ROUND((ROUND((crabe.comps_raits_avg * (40 / 100)), 2) + ROUND((ossbe.objs_scores_sum * (60 / 100)), 2)), 0)
WHEN e.job_type = 'Non-Supervisor' THEN ROUND((ROUND((crabe.comps_raits_avg * (30 / 100)), 2) + ROUND((ossbe.objs_scores_sum * (70 / 100)), 2)), 0)
ELSE ''
END AS RoundedFinalEval
FROM comps_raits_avg_by_emp crabe, objs_scores_sum_by_emp ossbe, employee_details e
WHERE crabe.employee_id = ossbe.employee_id
AND crabe.employee_id = e.employee_id) ver) RealTimeTable4
WHERE RealTimeTable3.employee_id = RealTimeTable4.employee_id
".$company_id.")") or die (header('Location:logout.php'));


mysqli_query($conn, "INSERT INTO `".$_SESSION['id']."_temp_tab` (SELECT RealTimeTable3.*, RealTimeTable4.RoundedFinalEval, RealTimeTable4.FinalResult
FROM(
SELECT RealTimeTable.employee_id, RealTimeTable.company_id, RealTimeTable.job_type
FROM
(
SELECT employee_id, job_type, company_id
FROM employee_details
WHERE employee_status = 'ACTIVE'
AND deleted = '0' 
AND hire_date <= '".$current_cycle_year."-07-01'
) RealTimeTable,
(
SELECT * FROM form_tracker WHERE record_id IN(
SELECT MAX(record_id) AS record_id FROM form_tracker WHERE status_code = '4' GROUP BY employee_id)
) RealTimeTable2
WHERE RealTimeTable.employee_id = RealTimeTable2.employee_id) RealTimeTable3,


(
SELECT ROUND(wd_raits_avg, 0) AS RoundedFinalEval, employee_id,
CASE
    WHEN ROUND(wd_raits_avg, 0) = 5 THEN 'Significantly Exceed Expectation'
    WHEN ROUND(wd_raits_avg, 0) = 4 THEN 'Exceed Expectation'
    WHEN ROUND(wd_raits_avg, 0) = 3 THEN 'Meet Expectation'
    WHEN ROUND(wd_raits_avg, 0) = 2 THEN 'Below Expectation'
    WHEN ROUND(wd_raits_avg, 0) = 1 THEN 'Significantly Below Expectation'
    ELSE 'NOT DEFINED !!'
END AS FinalResult
FROM wd_raits_avg_by_emp
) RealTimeTable4

WHERE RealTimeTable3.employee_id = RealTimeTable4.employee_id
".$company_id.")") or die (header('Location:logout.php'));


// Prepare Data for Selecting END:
//==================================================================================================================


include('../includefiles/pms_report_data.php');
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
<div align="center">
<table width="90%" border="0">
  <tr>
    <td align="left"><img src='<?php echo $_POST['company_logo']; ?>'></td>
  </tr>
  </table>
  <table width="60%" border="0">
    <tr>
    <td><div align="left"><input type=button onClick="location.href='pms_report_filter.php'" value='Back to Filter'>&nbsp;<input type=button onClick="location.href='main.php'" value='Back to Main'>&nbsp;<input type=button onClick="location.href='logout.php'" value='LogOut'><br><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong><?php echo $company_name; ?></strong></font></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong><?php echo $current_cycle_year; ?> PMS Report<br><?php echo date("Y-F-d"); ?></font></strong></div><hr width="99%"></td>
  </tr>
</table>
</div>
<div align="center">
<script src="https://www.do-sd.net/pms/graph/code/highcharts.js"></script>
<script src="https://www.do-sd.net/pms/graph/code/modules/data.js"></script>
<script src="https://www.do-sd.net/pms/graph/code/modules/drilldown.js"></script>
<p>&nbsp;</p>
<div class="styled">

</div>



<div class="styled">
<h3>Staff Ratings</h3>
<table width="50%" border="1">
  <tr align="center">
    <th width="60%">Rating</th>
    <th width="20%">Number  of Staff</th>
    <th width="20%"><strong>Actual  %</th>
  </tr>
  <tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>
    <td align="left">Significantly Exceed Expectation (5)</td>
    <td><?php echo $Significantly_Exceed_Expectation_Count; ?></td>
    <td><?php echo $Significantly_Exceed_Expectation_Count_Percentage; ?> %</td>
  </tr>
  <tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>
    <td align="left">Exceed Expectation (4)</td>
    <td><?php echo $Exceed_Expectation_Count; ?></td>
    <td><?php echo $Exceed_Expectation_Count_Percentage; ?> %</td>
  </tr>
  <tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>
    <td align="left">Meet Expectation (3)</td>
    <td><?php echo $Meet_Expectation_Count; ?></td>
    <td><?php echo $Meet_Expectation_Count_Percentage; ?> %</td>
  </tr>
  <tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>
    <td align="left">Below Expectation (2)</td>
    <td><?php echo $Below_Expectation_Count; ?></td>
    <td><?php echo $Below_Expectation_Count_Percentage; ?> %</td>
  </tr>
  <tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>
    <td align="left">Significantly Below Expectation (1)</td>
    <td><?php echo $Significantly_Below_Expectation_Count; ?></td>
    <td><?php echo $Significantly_Below_Expectation_Count_Percentage; ?> %</td>
  </tr>
  <tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>
    <td><strong>Total</strong></td>
    <td><strong><?php echo $TotalCount; ?></strong></td>
    <td><strong><?php echo $TotalPercentage; ?></strong> %</td>
  </tr>
</table>
</div>
<p>&nbsp;</p>

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
            name: 'Significantly Exceed Expectation',
            y: <?php echo $Significantly_Exceed_Expectation_Count; ?>
        }, {
            name: 'Exceed Expectation',
            y: <?php echo $Exceed_Expectation_Count; ?>
        }, {
            name: 'Meet Expectation',
            y: <?php echo $Meet_Expectation_Count; ?>
        },{
            name: 'Below Expectation',
            y: <?php echo $Below_Expectation_Count; ?>
        },{
            name: 'Significantly Below Expectation',
            y: <?php echo $Significantly_Below_Expectation_Count; ?>
        }]
    }],
    drilldown: {  } 
});
</script>
<script src="https://www.do-sd.net/pms/graph/code/modules/series-label.js"></script>
<script src="https://www.do-sd.net/pms/graph/code/modules/exporting.js"></script>
<p>&nbsp;</p>
<h3>Staff Ratings Bell Curve</h3>
<div id="total-container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>



		<script type="text/javascript">

Highcharts.chart('total-container', {
    chart: {
        type: 'spline'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['Significantly Exceed Expectation', 'Exceed Expectation', 'Meet Expectation', 'Below Expectation', 'Significantly Below Expectation']
    },
    yAxis: {
        title: {
            text: 'Employee Count'
        },
        labels: {
            formatter: function () {
                return this.value;
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [{
        name: 'Actual',
        marker: {
            symbol: 'square'
        },
        data: [<?php echo $Significantly_Exceed_Expectation_Count; ?>,
		<?php echo $Exceed_Expectation_Count; ?>,
		<?php echo $Meet_Expectation_Count; ?>,
		<?php echo $Below_Expectation_Count; ?>,
		<?php echo $Significantly_Below_Expectation_Count; ?>]

    }, {
        name: 'Proposed',
        marker: {
            symbol: 'diamond'
        },
        data: [<?php echo $applicable_employees_5_percentage; ?>,
		<?php echo $applicable_employees_17_point_percentage; ?>,
		<?php echo $applicable_employees_55_percentage; ?>,
		<?php echo $applicable_employees_17_point_percentage; ?>,
		<?php echo $applicable_employees_5_percentage; ?>]
    } ]
});
		</script>
<div class="styled">
<table width="50%" border="1">
  <tr>
    <td><strong>Applicable Staff: <u><?php echo $applicable_employees_count; ?></u><strong></td>
  </tr>
  <tr>
    <td><strong>Assessed Applicable Staff: <u><?php echo $assessed_employees_count; ?></u> [<?php echo $assessed_percentage; ?>%]<strong></td>
  </tr>
  <tr>
    <td><strong>Not Applicable Staff: <u><?php echo $not_applicable_employees_count; ?></u><strong></td>
  </tr>
  <tr>
    <td><strong>Staff: <u><?php echo $employees_count; ?></u><strong></td>
  </tr>
</table>
</div>
<p>&nbsp;</p>
</div>
<div align="center">
<?php
include('../includefiles/footer.php');
?>
</div>
<?php
mysqli_query($conn, "DROP TABLE IF EXISTS `".$_SESSION['id']."_temp_tab`");
?>
</body>
</html>