<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/includes/dbconfig.php';



$status = $_POST['status'];

$tenantName = addslashes($_POST['tenantName']);
$leaseTerm = $_POST['leaseTerm'];
$Property = $_POST['Property'];
$suiteNumber = $_POST['suiteNumber'];
$moveInDate = date("Y-m-d",strtotime($_POST['moveInDate']));
$contactName = addslashes($_POST['contactName']);
$contactAddress1 = addslashes($_POST['contactAddress1']);
$contactAddress2 = addslashes($_POST['contactAddress2']);
$contactPhone = $_POST['contactPhone'];
$contactEmail = $_POST['contactEmail'];
$directory = addslashes($_POST['directory']);
$doorSign = addslashes($_POST['doorSign']);
$rent = $_POST['rent'];
$furnitureRent = $_POST['furnitureRent'];
$telecomArray = $_POST['telecomArray'];
$furnitureCount = $_POST['furnitureCount'];
$furnitureAdditional = addslashes($_POST['furnitureAdditional']);
$pendingLeaseID = $_POST['leaseID'];



if ($_POST['action']=="update"){
$sql="UPDATE `executiveLeasePending` SET
`status` = $status,
`tenantName` = '$tenantName',
`leaseTerm` = '$leaseTerm',
`Property` = '$Property',
`suiteNumber` = '$suiteNumber',
`moveInDate` = '$moveInDate',
`contactName` = '$contactName',
`contactAddress1` = '$contactAddress1',
`contactAddress2` = '$contactAddress2',
`contactPhone` = '$contactPhone',
`contactEmail` = '$contactEmail',
`directory` = '$directory',
`doorSign` = '$doorSign',
`rent` = $rent,
`telecomArray` = '$telecomArray',
`furnitureCount` = '$furnitureCount',
`furnitureAdditional` = '$furnitureAdditional'
WHERE `executiveLeasePending`.`pendingLeaseID` = $pendingLeaseID";

if ($db->query($sql) === TRUE) {
  $query= "SELECT * FROM executiveLeasePending WHERE pendingLeaseID = ".$_POST['pendingLeaseID'];
  $result = $db->query($query);
  $posted = 1;
}else{
  $posted = 0;
  $alertText = "<b>Something has gone terribly wrong!</b><br> " . $db->error;}
echo $posted."|".$alertText;
}

if ($_POST['action']=="new"){
$sql = "INSERT INTO `executiveLeasePending` (`pendingLeaseID`, `status`, `tenantName`, `leaseTerm`, `Property`, `suiteNumber`, `moveInDate`, `contactName`, `contactAddress1`, `contactAddress2`, `contactPhone`, `contactEmail`, `directory`, `doorSign`, `rent`, `furnitureRent`, `telecomArray`, `furnitureCount`, `furnitureAdditional`) VALUES (NULL, '1', '1', '1', '1', '1', '2021-07-08', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1')";
}


if ($_POST['action']=="statusUpdate"){
  $sql= "UPDATE `executiveLeasePending` SET `status` = ".$_POST['newStatus']." WHERE `executiveLeasePending`.`pendingLeaseID` = ".$_POST['pendingLeaseID'];

  if ($db->query($sql) === TRUE) {
    $query= "SELECT * FROM executiveLeasePending WHERE pendingLeaseID = ".$_POST['pendingLeaseID'];
    $result = $db->query($query);
    $posted = 1;
    while($row = $result->fetch_assoc()) {  $alertText = $row['tenantName']." has been successfully updated";}
  }else{
    $posted = 0;
    $alertText = "<b>Something has gone terribly wrong!</b><br> " . $db->error;}

    $return = $posted."|".$alertText."|".$_POST['newStatus']."|<br>".$sql;
    echo $return;
  }


//echo $sql;
