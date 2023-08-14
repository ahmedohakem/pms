<?php
if($job_type == 'Supervisor'){
$ObjPercentageVar = 60;
$CompPercentageVar = 40;
}

elseif($job_type == 'Non-Supervisor'){
$ObjPercentageVar = 70;
$CompPercentageVar = 30;
}
else{
echo "No Job Type Set!!!!";
}
?>