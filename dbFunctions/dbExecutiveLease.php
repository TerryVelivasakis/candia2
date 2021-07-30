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
$contactPhone = formatPhone($_POST['contactPhone']);
$contactCell = formatPhone($_POST['contactCell']);
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
`status` = '$status',
`tenantName` = '$tenantName',
`leaseTerm` = '$leaseTerm',
`Property` = '$property',
`suiteNumber` = '$suiteNumber',
`moveInDate` = '$moveInDate',
`contactName` = '$contactName',
`contactAddress1` = '$contactAddress1',
`contactAddress2` = '$contactAddress2',
`contactPhone` = '$contactPhone',
`contactCell` = '$contactCell',
`contactEmail` = '$contactEmail',
`directory` = '$directory',
`doorSign` = '$doorSign',
`rent` = '$rent',
`furnitureRent` = '$furnitureRent',
`telecomArray` = '$telecomArray',
`furnitureCount` = '$furnitureCount',
`furnitureAdditional` = '$furnitureAdditional',
`incentives` = '$incentives',
`guaranty` = '$guaranty'
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
$sql = "INSERT INTO `executiveLeasePending` (`pendingLeaseID`, `status`, `tenantName`, `leaseTerm`, `Property`, `suiteNumber`, `moveInDate`, `contactName`, `contactAddress1`, `contactAddress2`, `contactPhone`, `contactCell`, `contactEmail`, `directory`, `doorSign`, `rent`, `furnitureRent`, `telecomArray`, `furnitureCount`, `furnitureAdditional`, `incentives`, `guaranty`) VALUES" ;
$sql.="(NULL, '1', '$tenantName', '$leaseTerm', '$Property', '$suiteNumber', '$moveInDate', '$contactName', '$contactAddress1', '$contactAddress2', '$contactPhone', '$contactCell', '$contactEmail', '$directory', '$doorSign', '$rent', '$furnitureRent', '$telecomArray', '$furnitureCount', '$furnitureAdditional', '$incentives', '$guaranty')";



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

  if ($_POST['action']=="finalize"){
      $query= "SELECT * FROM executiveLeasePending WHERE pendingLeaseID = ".$_POST['pendingLeaseID'];
      $result = $db->query($query);
      while($row = $result->fetch_assoc()) {
        $tenantName = $row['tenantName'];
        $posting = "INSERT INTO `executiveLease` (`leaseID`, `status`, `tenantName`, `leaseTerm`, `Property`, `suiteNumber`, `moveInDate`, `contactName`, `contactAddress1`,";
          $posting .= "`contactAddress2`, `contactPhone`, `contactCell`, `contactEmail`, `rent`, `furnitureRent`, `telecomArray`, `furnitureCount`, `furnitureAdditional`, `modifiers`) VALUES";
          $posting.= "(NULL, '1', '".$row['tenantName']."', '".$row['leaseTerm']."', '".$row['Property']."', '".$row['suiteNumber']."', '".$row['moveInDate']."', '".$row['contactName']."', '".$row['contactAddress1']."', '".$row['contactAddress2'];
          $posting.= "', '".$row['contactPhone']."', '".$row['contactCell']."', '".$row['contactEmail']."', '".$row['rent']."', '".$row['furnitureRent']."', '".$row['telecomArray']."', '".$row['furnitureCount']."', '".$row['furnitureAdditional']."','".$row['incentives']."&".$row['guaranty']."')";

        //  $posting = $row['moveInDate'];
        }

        if ($db->query($posting) === TRUE) {
          $posted = 1;
          $alertText = $tenantName." has been successfully finalized.";

      }else{
        $posted = 0;
        $alertText = "<b>Something has gone terribly wrong!</b><br> ".$posting."<br>" . $db->error;
      }

      $return = $posted."|".$alertText;
      echo $return;
    }



//echo $sql;
