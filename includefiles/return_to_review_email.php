<?php
/* $SelectQur = mysqli_query($conn, "SELECT IFNULL(work_email_address, 'na@na.na') AS work_email_address FROM employee_details WHERE employee_id = '".$manager_employee_id."'");
while($row = mysqli_fetch_array($SelectQur))
{
$work_email_address = $row['work_email_address'];
}

$subject = "Notification";

$message = "
<html>
<head>
<title>PMS - Notification</title>
</head>
<body>
<p>Dear ".$manager_full_name.", this is the Performance  Management System.<br />
<strong>".$current_session_full_name."</strong> returned <strong>".$full_name."</strong> form to review. Please login to the system and do the necessary action.</p>
<p><strong>System Link:</strong> <a href='https://www.do-sd.net/pms/'>https://www.do-sd.net/pms/</a></p>
<p>&nbsp;</p>
<h4>PMS Digital Officer<br /></h4>
</body>
</html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: Elnefeidi Group Performance Management System' . "\r\n";
mail($work_email_address,$subject,$message,$headers); */
?>
