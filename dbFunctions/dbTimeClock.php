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

if ($_POST['action'] == 'HRajax'){
  $sql = "SELECT * FROM `TimeClock` WHERE `punchID`=".$_POST['punchID'];
  //$sendback = json_encode($sql);
  $result = $hrDB->query($sql);
  $row = $result->fetch_assoc();
  $sendback = json_encode($row);
  echo $sendback;
}


if ($_POST['action'] == 'HRedit'){

$sql = "UPDATE `TimeClock` SET `TimeIn` = '".$_POST['TimeIn']."', `LunchOut` = '".$_POST['LunchOut']."', `LunchIn` = '".$_POST['LunchIn']."', `TimeOut` = '".$_POST['TimeOut']."', `punchtype` = '4' WHERE `TimeClock`.`punchID` =".$_POST['punchID'];

$hours = ((strtotime($punch['TimeOut']) - strtotime($punch['TimeIn'])) - (strtotime($punch['LunchIn']) - strtotime($punch['LunchOut'])))/3600;

if ($hrDB->query($query) === TRUE) {
  echo 'gtg|'.$hours;
}else{
echo 'something is fucked up, go fix it ya knob';
}
}

if ($_POST['action'] == 'HRoverview'){
  $sql = "SELECT userName, StaffID FROM Staff";
  $query = $hrDB -> query($sql);
  while($row = $query->fetch_assoc()) {
  $name[$row['StaffID']]=ucfirst($row['userName']);
  }
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
  $sql = "SELECT StaffID FROM Staff WHERE hourly=1";
  $query = $hrDB -> query($sql);
  while($row = $query->fetch_assoc()) {
    $clockSQL = 'SELECT * FROM TimeClock WHERE employeeId = '.$row['StaffID']." AND ClockDay BETWEEN ".date("'Y-m-d'",$_POST['startDate'])." AND ".date("'Y-m-d'",$_POST['endDate'])." ORDER BY ClockDay DESC";
    $result = $hrDB -> query($clockSQL);
    $totalHours = 0; $regular = 0; $overtime = 0;
$i=0;
    while($punch = $result->fetch_assoc()) {
      $hours = ((strtotime($punch['TimeOut']) - strtotime($punch['TimeIn'])) - (strtotime($punch['LunchIn']) - strtotime($punch['LunchOut'])))/3600;
      $totalHours += $hours;
      if (date('D',strtotime($punch['ClockDay'])) == 'Mon'){
        if ($totalHours > 40){$regular += 40; $overtime += $totalHours - 40;}else{$regular += $totalHours;}
        $totalHours = 0;}
        $x[$i] = "<tr class='empTimeTotal'><td>".$name[$row['StaffID']]."<td>".number_format($regular,2)."<td>".number_format($overtime,2);
    }

  }
  $foo = json_encode($x);
  echo $foo;
}
