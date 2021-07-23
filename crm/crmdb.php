<?php require_once $_SERVER['DOCUMENT_ROOT']."/includes/config.php";



$sql = "SELECT * FROM PlanNames";
$result = $crmDB->query($sql);

  while($row = $result->fetch_assoc()) {
    $planname[$row['PlanID']]=$row['PlanName'];
  }

  $pid = $_POST['pid'];
  $date = date("Y-m-d");
  $editor = ucfirst($_SESSION['uname']);


if ($_POST['action']=="addnote"){

$note = addslashes($_POST['note']);
$sql = "INSERT INTO `notes` (`ID`, `prospect`, `ndate`, `editor`, `note`) VALUES (NULL, '$pid', '$date', '$editor', '$note')";
if ($crmDB->query($sql) === TRUE) {} else {echo "Error: " . $sql . "<br>" . $crmDB->error;}
}

if ($_POST['action']=="logcall"){

$note = addslashes($_POST['note']);
$sql = "INSERT INTO `notes` (`ID`, `prospect`, `ndate`, `editor`, `note`) VALUES (NULL, '$pid', '$date', '$editor', '$note')";
if ($crmDB->query($sql) === TRUE) {} else {echo "Error: " . $sql . "<br>" . $crmDB->error;}
$upsql = "UPDATE Prospects SET Step = Step + 1, lastcontact = '".date("Y-m-d")."' WHERE ID =".$pid;
if ($crmDB->query($upsql) === TRUE) {} else {echo "Error: " . $sql . "<br>" . $crmDB->error;}

$sql = "SELECT * FROM Prospects INNER JOIN FollowUpPlan ON Prospects.plannumber=FollowUpPlan.plannumber AND Prospects.Step=FollowUpPlan.step WHERE ID = ".$pid;
while($row = mysqli_fetch_array($result2)) {
$nextfoo = $nc = date("Y-m-d", strtotime("today + ".$row['adddays']." days"));
}
  $upsql = "UPDATE Prospects SET nextcontact = '$nextfoo' WHERE ID =".$pid;
  if ($crmDB->query($upsql) === TRUE) {} else {$log .= "Error: " . $upsql . "<br>" . $crmDB->error;}

}



if ($_POST['action']=="new"){
  $today = date("Y-m-d");
$sql='INSERT INTO `Prospects` (`ID`, `FName`, `LName`, `company`, `Phone`, `Cell`, `email`, `source`, `pdate`, `lastcontact`, `Step`, `Property`, `plannumber`, `size`) VALUES';
$sql .= "(NULL, '".addslashes($_POST['fname'])."','".addslashes($_POST['lname'])."','".addslashes($_POST['company'])."','".addslashes(formatPhoneNumber($_POST['phone']));
$sql .="','".addslashes(formatPhoneNumber($_POST['cell']))."','".addslashes($_POST['email'])."','".addslashes($_POST['source'])."','".$today."','".$today."','1', '1','".$_POST['plan']."','".addslashes($_POST['size'])."');";//*
if ($crmDB->query($sql) === TRUE) {} else {echo "Error: " . $sql . "<br>" . $crmDB->error;}

if ($_POST['note']!=""){
  $pidsql = "SELECT ID FROM Prospects WHERE ID = (SELECT MAX(ID) FROM Prospects)";
  $result = $crmDB->query($pidsql);
  while($row = $result->fetch_assoc()){$pid=$row['ID'];}
$note = addslashes($_POST['note']);
$sql = "INSERT INTO `notes` (`ID`, `prospect`, `ndate`, `editor`, `note`) VALUES (NULL, '$pid', '$date', '$editor', '$note')";
if ($crmDB->query($sql) === TRUE) {} else {echo "Error: " . $sql . "<br>" . $crmDB->error;}
}

}


if ($_POST['action']=="update"){
if ($_POST['note']!=""){
  $note = addslashes($_POST['note']);
  $sql = "INSERT INTO `notes` (`ID`, `prospect`, `ndate`, `editor`, `note`) VALUES (NULL, '$pid', '$date', '$editor', '$note')";
  if ($crmDB->query($sql) === TRUE) {} else {echo "Error: " . $sql . "<br>" . $crmDB->error;}
  }

  $sql = "SELECT * FROM Prospects WHERE ID =".$pid;
  $result = $crmDB->query($sql);
$planchange ="";
while($row = $result->fetch_assoc()) {
if ($_POST['plan'] != $row['plannumber']){

  $note = "Plan Changed from ".$planname[$row['plannumber']]." to ". $planname[$_POST['plan']];
  $sql = "INSERT INTO `notes` (`ID`, `prospect`, `ndate`, `editor`, `note`) VALUES (NULL, '$pid', '$date', '$editor', '$note')";
  if ($crmDB->query($sql) === TRUE) {} else {echo "Error: " . $sql . "<br>" . $crmDB->error;}
  $planchange ="`plannumber` = '".addslashes($_POST['plan'])."', `step` = '1',";
}
}
if ($_POST['nexttouch'] == ""){$nexttouch=date('Y-m-d', strtotime('next weekday'));}else{$nexttouch=$_POST['nexttouch'];}

$sql = "UPDATE `Prospects` SET
`FName` = '".addslashes($_POST['fname'])."',
`LName` = '".addslashes($_POST['lname'])."',
`company` = '".addslashes($_POST['company'])."',
`Phone` = '".addslashes(formatPhoneNumber($_POST['phone']))."',
`Cell` = '".addslashes(formatPhoneNumber($_POST['cell']))."',
`email` = '".addslashes($_POST['email'])."',
`source` = '".addslashes($_POST['source'])."',
`nextcontact` = '".addslashes($nexttouch)."',
$planchange
`size` = '".addslashes($_POST['size'])."'
WHERE `Prospects`.`ID` =".$_POST['pid'];
if ($crmDB->query($sql) === TRUE) {} else {echo "Error: " . $sql . "<br>" . $crmDB->error;}

}
