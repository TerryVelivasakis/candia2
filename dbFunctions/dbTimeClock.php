<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/includes/dbconfig.php';
session_start();

if ($_POST['action'] == 'change'){
  $foo = explode('/',$_POST['date']);
  $date= date('Y');
  if (intval($foo[0]) < 10){$date .='-0'.$foo[0];}else{$date .='-'.$foo[0];}
  if (intval($foo[1]) < 10){$date .='-0'.$foo[1];}else{$date .='-'.$foo[1];}

$sql = "INSERT INTO `TimeClockChanges` (`changeID`, `employeeID`, `ClockDay`, `newTimeIn`, `newLunchOut`, `newLunchIn`, `newTimeOut`) VALUES
(NULL, '".$_SESSION['empID']."', '$date', '".$_POST['newTimeIn']."', '".$_POST['newLunchOut']."', '".$_POST['newLunchIn']."', '".$_POST['newTimeOut']."')";

if ($hrDB->query($sql) === TRUE) {
  $posted = 1;
}else{
  $posted = 0;
}//*/
echo $posted;
}

if ($_POST['action'] == 'approveChange'){
  $sql = "SELECT * FROM `TimeClockChanges` WHERE `changeID`=".$_POST['changeID'];
  $result = $hrDB->query($sql);
  while($row = $result->fetch_assoc()) {
    $clockDay = $row['ClockDay'];
    $timeIn = $row['newTimeIn'];
    $timeOut = $row['newTimeOut'];
    $lunchIn = $row['newLunchIn'];
    $lunchOut=$row['newLunchOut'];
    $empID = $row['employeeID'];
}
$query = "UPDATE `TimeClock` SET `TimeIn` = '$timeIn', `LunchOut` = '$lunchOut', `LunchIn` = '$lunchIn', `TimeOut` = '$timeOut', `punchtype` = 3 WHERE `employeeID` = $empID AND `ClockDay` = '$clockDay'";
$deleteRow = "DELETE FROM `TimeClockChanges` WHERE `TimeClockChanges`.`changeID` =".$_POST['changeID'];
if ($hrDB->query($query) === TRUE) {
  $hrDB->query($deleteRow);
}
}
if ($_POST['action'] == 'denyChange'){
$deleteRow = "DELETE FROM `TimeClockChanges` WHERE `TimeClockChanges`.`changeID` =".$_POST['changeID'];
if ($hrDB->query($deleteRow) === TRUE) { echo 'Deleted';}else{echo 'problem';}
}

if ($_POST['action'] == 'clockin'){
  $query = "INSERT INTO `TimeClock` (`punchID`, `employeeID`, `ClockDay`, `TimeIn`, `LunchOut`, `LunchIn`, `TimeOut`, `punchtype`) VALUES (NULL, '".$_SESSION['empID']."', '".date('Y-m-d')."', '".date('g:i:s')."', '00:00:00', '00:00:00', '00:00:00', NULL)";
  if ($hrDB->query($query) === TRUE) {echo '1';}
}

if ($_POST['action'] == 'lunchout'){
  $query ="UPDATE `TimeClock` SET `LunchOut` = '".date('g:i:s')."' WHERE `employeeID` = ".$_SESSION['empID']." AND `ClockDay` = '".date('Y-m-d')."'";

if ($hrDB->query($query) === TRUE) {echo '1';}else{echo $query; }
}

if ($_POST['action'] == 'lunchin'){
  $query ="UPDATE `TimeClock` SET `LunchIn` = '".date('g:i:s')."' WHERE `employeeID` = ".$_SESSION['empID']." AND `ClockDay` = '".date('Y-m-d')."'";
  if ($hrDB->query($query) === TRUE) {echo '1';}
}

if ($_POST['action'] == 'clockout'){
  $query ="UPDATE `TimeClock` SET `TimeOut` = '".date('g:i:s')."' WHERE `employeeID` = ".$_SESSION['empID']." AND `ClockDay` = '".date('Y-m-d')."'";
  if ($hrDB->query($query) === TRUE) {echo '1';}
}
