<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/includes/dbconfig.php';
$_POST['status'] = 2;
$_POST['tenantName'] = '"hobbit"hole';

$Property = 2;
$suiteNumber = 200;
$leaseTerm = 2;

if ($_POST['action']=="update"){
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





$sql="UPDATE `executiveLeasePending` SET
`status` = $status,
`tenantName` = '$tenantName',
`leaseTerm` = '$leaseTerm',
`Property` = '$Property',
`suiteNumber` = '$suiteNumber',
`moveInDate` = '2021-05-22',
`contactName` = 'James Jonatha n Tenant',
`contactAddress1` = '123 Mai n Street',
`contactAddress2` = 'Anywh ere, USA 10303',
`contactPhone` = '(914) 471-5838',
`contactEmail` = 'jjtentant@tenatcorp.com',
`directory` = 'James Jonathan pop|',
`doorSign` = 'James Jonathan popy',
`rent` = '50',
`telecomArray` = '1,1,0,1,1,1,4,1,1,1',
`furnitureCount` = '1,2,3,4,5,6,7,6',
`furnitureAdditional` = 'chocolate Fo untain|Icecream Machine|Fancy Poster'
WHERE `executiveLeasePending`.`pendingLeaseID` = 2";
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
