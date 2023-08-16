<?php
include('../includefiles/sess.php');
include('../includefiles/conn_db.php');
include('../includefiles/user_session_info.php');
include('../includefiles/enc.php');
$MasterCompany =  $_REQUEST['company_id'];
if (empty($_REQUEST['company_id'])) { $company_name = "Elnefeidi Group" ; $company_id = "AND company_id IN (SELECT company_id FROM users_companies WHERE sys_user_id = '".$_SESSION['id']."')"; }

else
{

if ($_REQUEST['company_id'] == 22) {
$CompanySelectQur = mysqli_query($conn, "SELECT company_name FROM companies WHERE company_id = '".$_REQUEST['company_id']."'");
while($row = mysqli_fetch_array($CompanySelectQur))
{
$company_name = $row['company_name'];
}
$company_id = "AND company_id IN (3, 5, 6, 7, 8, 9, 10)";
}

elseif ($_REQUEST['company_id'] == 23) {
$CompanySelectQur = mysqli_query($conn, "SELECT company_name FROM companies WHERE company_id = '".$_REQUEST['company_id']."'");
while($row = mysqli_fetch_array($CompanySelectQur))
{
$company_name = $row['company_name'];
}
$company_id = "AND company_id IN (16, 20, 21, 24, 25)";
}

else {
$CompanySelectQur = mysqli_query($conn, "SELECT company_name FROM companies WHERE company_id = '".$_REQUEST['company_id']."'");
while($row = mysqli_fetch_array($CompanySelectQur))
{
$company_name = $row['company_name'];
}
$company_id = "AND company_id = '".$_REQUEST['company_id']."'";
}

}

// Prepare Numbers for the Graph BEGIN:
//==================================================================================================================
// INSERTED
$InsertedSelectQur = mysqli_query($conn, "SELECT * FROM employee_details
WHERE employee_id IN(
SELECT employee_id FROM objectives_2020 WHERE obj_year = '2020' GROUP BY employee_id HAVING SUM(obj_weight) = '1.00'
)
AND employee_id NOT IN(
SELECT employee_id FROM objectives_submission WHERE objectives_year = '2020'
)
".$company_id."
AND deleted = '0'
AND employee_status = 'ACTIVE'");
if(mysqli_num_rows($InsertedSelectQur) == 0) {
$InsertedNumberOfRecordVar = 0;
}
else
{
$InsertedNumberOfRecordVar = mysqli_num_rows($InsertedSelectQur);
}


// SUBMITTED
$SubmittedSelectQur = mysqli_query($conn, "SELECT * FROM employee_details
WHERE employee_id IN(
SELECT employee_id FROM objectives_2020 WHERE obj_year = '2020' GROUP BY employee_id HAVING SUM(obj_weight) = '1.00'
)
AND employee_id IN(
SELECT employee_id FROM objectives_submission WHERE objectives_year = '2020' AND filed = '0'
)
".$company_id."
AND deleted = '0'
AND employee_status = 'ACTIVE'");
if(mysqli_num_rows($SubmittedSelectQur) == 0) {
$SubmittedNumberOfRecordVar = 0;
}
else
{
$SubmittedNumberOfRecordVar = mysqli_num_rows($SubmittedSelectQur);
}

// REVIEWED
$ReviewedSelectQur = mysqli_query($conn, "SELECT * FROM employee_details
WHERE employee_id IN(
SELECT employee_id FROM objectives_submission WHERE objectives_year = '2020' AND mid_reviewed = '1'
)
".$company_id."
AND deleted = '0'
AND employee_status = 'ACTIVE'");
if(mysqli_num_rows($ReviewedSelectQur) == 0) {
$ReviewedNumberOfRecordVar = 0;
}
else
{
$ReviewedNumberOfRecordVar = mysqli_num_rows($ReviewedSelectQur);
}

// FILED
$FiledSelectQur = mysqli_query($conn, "SELECT * FROM employee_details
WHERE employee_id IN(
SELECT employee_id FROM objectives_2020 WHERE obj_year = '2020' GROUP BY employee_id HAVING SUM(obj_weight) = '1.00'
)
AND employee_id IN(
SELECT employee_id FROM objectives_submission WHERE objectives_year = '2020' AND filed = '1'
)
".$company_id."
AND deleted = '0'
AND employee_status = 'ACTIVE'");
if(mysqli_num_rows($FiledSelectQur) == 0) {
$FiledNumberOfRecordVar = 0;
}
else
{
$FiledNumberOfRecordVar = mysqli_num_rows($FiledSelectQur);
}


// NOT INSERTED
$NotInsertedSelectQur = mysqli_query($conn, "SELECT * FROM employee_details
WHERE employee_id NOT IN(
SELECT employee_id FROM objectives_2020 WHERE obj_year = '2020' GROUP BY employee_id HAVING SUM(obj_weight) = '1.00'
)
".$company_id."
AND deleted = '0'
AND employee_status = 'ACTIVE'");
if(mysqli_num_rows($NotInsertedSelectQur) == 0) {
$NotInsertedNumberOfRecordVar = 0;
}
else
{
$NotInsertedNumberOfRecordVar = mysqli_num_rows($NotInsertedSelectQur);
}


// NOT COMPLETED OR INVALID INSERTION
$NotCompletedInsertedSelectQur = mysqli_query($conn, "SELECT * FROM employee_details
WHERE employee_id IN(
SELECT employee_id FROM objectives_2020 WHERE obj_year = '2020' GROUP BY employee_id HAVING SUM(obj_weight) <> '1.00'
)
".$company_id."
AND deleted = '0'
AND employee_status = 'ACTIVE'");
if(mysqli_num_rows($NotCompletedInsertedSelectQur) == 0) {
$NotCompletedInsertedNumberOfRecordVar = 0;
}
else
{
$NotCompletedInsertedNumberOfRecordVar = mysqli_num_rows($NotCompletedInsertedSelectQur);
}

//==================================================================================================================
// Prepare Numbers for the Graph END


$SelectedRecords = $NotCompletedInsertedNumberOfRecordVar + $NotInsertedNumberOfRecordVar + $InsertedNumberOfRecordVar + $FiledNumberOfRecordVar + $SubmittedNumberOfRecordVar;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="../graph/jquery-1.12.4.min.js"></script>
<script src="../graph/canvasjs.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include('../includefiles/title.php'); ?></title>

<link rel="stylesheet" href="../css/style.css" />
<!-- favicon links -->
<link rel="shortcut icon" type="image/ico" href="../img/icons/favicon.ico" />
<link rel="icon" type="image/ico" href="../img/icons/favicon.ico" />

<script src="../css/datetimepicker_css.js"></script>
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
    <td><div align="left"><input type=button onClick="location.href='main.php'" value='Back to Main'>&nbsp;<input type=button onClick="location.href='objectives_report_filter.php'" value='Report Setting'>&nbsp;<input type=button onClick="location.href='logout.php'" value='LogOut'><p>&nbsp;</p><strong><?php echo $current_session_first_name; ?> [<?php echo $current_session_employee_id; ?>]</strong></div><div align="right"><font color="blue" style='font-family: Courier New; font-size: 15px;'><strong>2020 Objectives Report<br><?php echo date("Y-F-d"); ?></font><br><font color="#963634" size="4"><?php echo $company_name.": ".$SelectedRecords; ?></font></strong></div><hr width="99%"></td>
  </tr>
</table>
</div>
<div class="PositionFixed">
<a href="#goup" title="Go Top"><img src="../img/icons/GoUp.png"></a>
</div>
<div align="center">
<script src="https://www.do-sd.net/pms/graph/code/highcharts.js"></script>
<script src="https://www.do-sd.net/pms/graph/code/modules/data.js"></script>
<script src="https://www.do-sd.net/pms/graph/code/modules/drilldown.js"></script>

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
            name: '<a href="#Filed_list" title="Jumb to Filed List">Filed</a>',
            y: <?php echo $FiledNumberOfRecordVar; ?>
        }, {
            name: '<a href="#Submitted_list" title="Jumb to Submited List">Submited</a>',
            y: <?php echo $SubmittedNumberOfRecordVar; ?>
        }, {
            name: '<a href="#Inserted_list" title="Jumb to Inserted List">Inserted</a>',
            y: <?php echo $InsertedNumberOfRecordVar; ?>
        }, {
            name: '<a href="#Not_Valid_list" title="Jumb to Not Valid List">Not Valid</a>',
            y: <?php echo $NotCompletedInsertedNumberOfRecordVar; ?>
        },{
            name: '<a href="#Not_Inserted_list" title="Jumb to Not Inserted List">Not Inserted</a>',
            y: <?php echo $NotInsertedNumberOfRecordVar; ?>
        }]
    }],
    drilldown: {  } 
});
</script>
<?php
$Total = $InsertedNumberOfRecordVar + $NotCompletedInsertedNumberOfRecordVar + $NotInsertedNumberOfRecordVar + $SubmittedNumberOfRecordVar + $FiledNumberOfRecordVar;
echo "<strong>Total ".$Total."</strong>";
?>
<p>&nbsp;</p>
<div class="styled">
<p>&nbsp;</p>
<font color="blue">
<?php
if (isset($_GET['msg'])){
 error_reporting (E_ALL ^ E_NOTICE);
 echo $_GET['msg']."<br><br>";
 }
?>
</font>
<?php
// FILED
//===================================================================================================================================================================//

if($FiledNumberOfRecordVar == 0) {
//echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
echo "<a name='Filed_list'>";
echo "<table border='1' width='90%'>
<tr><td align='left'><strong>Filed: $FiledNumberOfRecordVar</strong></td></tr></table>";
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
<th>#</th>";
$n=1;
while($row = mysqli_fetch_array($FiledSelectQur))
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
  echo "<td  align= 'center'><form method='POST' action='objectives.php'><input type='hidden' name='employee_id' value='".encrypt_decrypt('encrypt', $row['employee_id'])."'><input type='hidden' name='company_id' value='".$MasterCompany."'><input type='image' src='../img/icons/process.png' alt='DISPLAY Objectives' title='DISPLAY Objectives'></form></td>";
  echo "</tr>";
  $n++;
  }
  echo "</table>";
  echo "<p>&nbsp;</p>";
  echo "<p>&nbsp;</p>";
  }
//===================================================================================================================================================================//


// SUBMITTED
//===================================================================================================================================================================//

if($SubmittedNumberOfRecordVar == 0) {
//echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
echo "<a name='Submitted_list'>";
echo "<table border='1' width='90%'>
<tr><td align='left'><strong>Submitted: $SubmittedNumberOfRecordVar</strong></td></tr></table>";
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
<th>#</th>";
$n=1;
while($row = mysqli_fetch_array($SubmittedSelectQur))
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
  echo "<td  align= 'center'><form method='POST' action='objectives.php'><input type='hidden' name='employee_id' value='".encrypt_decrypt('encrypt', $row['employee_id'])."'><input type='hidden' name='company_id' value='".$MasterCompany."'><input type='image' src='../img/icons/process.png' alt='DISPLAY Objectives' title='DISPLAY Objectives'></form></td>";
  echo "</tr>";
  $n++;
  }
  echo "</table>";
  echo "<p>&nbsp;</p>";
  echo "<p>&nbsp;</p>";
  }
//===================================================================================================================================================================//



// INSERTED
//===================================================================================================================================================================//

if($InsertedNumberOfRecordVar == 0) {
//echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
echo "<a name='Inserted_list'>";
echo "<table border='1' width='90%'>
<tr><td align='left'><strong>Inserted: $InsertedNumberOfRecordVar</strong></td></tr></table>";
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
<th>#</th>";
$n=1;
while($row = mysqli_fetch_array($InsertedSelectQur))
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
  echo "<td  align= 'center'><form method='POST' action='objectives.php'><input type='hidden' name='employee_id' value='".encrypt_decrypt('encrypt', $row['employee_id'])."'><input type='hidden' name='company_id' value='".$MasterCompany."'><input type='image' src='../img/icons/process.png' alt='DISPLAY Objectives' title='DISPLAY Objectives'></form></td>";
  echo "</tr>";
  $n++;
  }
  echo "</table>";
  echo "<p>&nbsp;</p>";
  echo "<p>&nbsp;</p>";
  }
//===================================================================================================================================================================//



// NOT INSERTED
//===================================================================================================================================================================//

if($NotInsertedNumberOfRecordVar == 0) {
//echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
echo "<a name='Not_Inserted_list'>";
echo "<table border='1' width='90%'>
<tr><td align='left'><strong>Not Inserted: $NotInsertedNumberOfRecordVar</strong></td></tr></table>";
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
while($row = mysqli_fetch_array($NotInsertedSelectQur))
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
  echo "<p>&nbsp;</p>";
  echo "<p>&nbsp;</p>";
  }
//===================================================================================================================================================================//


// NOT COMPLETED OR INVALID INSERTION
//===================================================================================================================================================================//

if($NotCompletedInsertedNumberOfRecordVar == 0) {
//echo "<font color = 'red'> No Records Match Your Query!</font><br>";
}
else
{
echo "<a name='Not_Valid_list'>";
echo "<table border='1' width='90%'>
<tr><td align='left'><strong>Not Completed or Invalid Insertion: $NotCompletedInsertedNumberOfRecordVar</strong></td></tr></table>";
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
<th>#</th>";
$n=1;
while($row = mysqli_fetch_array($NotCompletedInsertedSelectQur))
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
  echo "<td  align= 'center'><form method='POST' action='objectives.php'><input type='hidden' name='employee_id' value='".encrypt_decrypt('encrypt', $row['employee_id'])."'><input type='hidden' name='company_id' value='".$MasterCompany."'><input type='image' src='../img/icons/process.png' alt='DISPLAY Objectives' title='DISPLAY Objectives'></form></td>";
  echo "</tr>";
  $n++;
  }
  echo "</table>";
  echo "<p>&nbsp;</p>";
  echo "<p>&nbsp;</p>";
  }
//===================================================================================================================================================================//

// FORM C
//===================================================================================================================================================================//


//===================================================================================================================================================================//
?>
</div>
<?php
include('../includefiles/footer.php');
?>
</div>
</body>
</html>