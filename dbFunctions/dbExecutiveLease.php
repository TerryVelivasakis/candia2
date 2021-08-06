<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/includes/dbconfig.php';
//echo "1**something happened ".rand(1,1000000);

function needsEscape(string $string){if (is_null($string)){  return "";}else{  return mb_ereg_replace('[\x00\x0A\x0D\x1A\x22\x27\x5C]', '\\\0', $string);}}

function formatPhone($data){
$cleanNumber ='('.substr($data, 0, 3).') '.substr($data, 3, 3).'-'.substr($data,6);
return $cleannumber;
}

$status = $_POST['status'];
$pendingLeaseID = $_POST['leaseID'];


if ($_POST['action'] == "update" or $_POST['action'] == "new"){



$tenantName = needsEscape($_POST['tenantName']);
$leaseTerm = $_POST['leaseTerm'];
$property = $_POST['Property'];
$suiteNumber = $_POST['suiteNumber'];
$moveInDate = date("Y-m-d",strtotime($_POST['moveInDate']));
$contactName = needsEscape($_POST['contactName']);
$contactAddress1 = needsEscape($_POST['contactAddress1']);
$contactAddress2 = needsEscape($_POST['contactAddress2']);
$contactPhone = $_POST['contactPhone'];
$contactCell = $_POST['contactCell'];
$contactEmail = $_POST['contactEmail'];
$directory = needsEscape($_POST['directory']);
$doorSign = needsEscape($_POST['doorSign']);
$rent = $_POST['rent'];
$furnitureRent = $_POST['furnitureRent'];
$telecomArray = $_POST['telecomArray'];
$furnitureCount = $_POST['furnitureCount'];
$furnitureAdditional = needsEscape($_POST['furnitureAdditional']);
$modifiers = $_POST['modifiers'];
$term = intval($_POST['leaseTerm']);

}


if ($_POST['action']=="update"){
$sql="UPDATE `executiveLeasePending` SET
`status` = '$status',`tenantName` = '$tenantName',`leaseTerm` = $term,`Property` = '$property',
`suiteNumber` = '$suiteNumber',`moveInDate` = '$moveInDate',`contactName` = '$contactName',`contactAddress1` = '$contactAddress1',
`contactAddress2` = '$contactAddress2',`contactPhone` = '$contactPhone',`contactCell` = '$contactCell',`contactEmail` = '$contactEmail',
`directory` = '$directory',`doorSign` = '$doorSign',`rent` = '$rent',`furnitureRent` = '$furnitureRent',
`telecomArray` = '$telecomArray',`furnitureCount` = '$furnitureCount',`furnitureAdditional` = '$furnitureAdditional', `modifiers` = '$modifiers'
WHERE `executiveLeasePending`.`pendingLeaseID` = $pendingLeaseID";

if ($db->query($sql) === TRUE) {
  $posted = 1;
  $alertText ="";
}else{
  $posted = 0;
  $alertText = "<b>Something has gone terribly wrong!</b><br>" . $db->error."<br><br>".$sql;}
  //echo "<script>console.log('".var_dump($directory)."');</script>";
echo $posted."|".$alertText;
}

if ($_POST['action']=="new"){
$sql = "INSERT INTO `executiveLeasePending` (`pendingLeaseID`, `status`, `tenantName`, `leaseTerm`, `Property`, `suiteNumber`, `moveInDate`, `contactName`, `contactAddress1`, `contactAddress2`, `contactPhone`, `contactCell`, `contactEmail`, `directory`, `doorSign`, `rent`, `furnitureRent`, `telecomArray`, `furnitureCount`, `furnitureAdditional`, `modifiers`) VALUES" ;
$sql.="(NULL, 1, '$tenantName', '$term', '$property', '$suiteNumber', '$moveInDate', '$contactName', '$contactAddress1', '$contactAddress2', '$contactPhone', '$contactCell', '$contactEmail', '$directory', '$doorSign', '$rent', '$furnitureRent', '$telecomArray', '$furnitureCount', '$furnitureAdditional', '$modifiers')";
if ($db->query($sql) === TRUE) {
  $posted = 1;
  $alertText ="";
}else{
  $posted = 0;
  $alertText = "<b>Something has gone terribly wrong!</b><br>" . $db->error."/N".$sql."/N".$_POST['Property'];}
  //echo "<script>console.log('".var_dump($directory)."');</script>";
echo $posted."|".$alertText;

}


if ($_POST['action']=="statusUpdate"){
  $sql= "UPDATE `executiveLeasePending` SET `status` = ".$_POST['newStatus']." WHERE `executiveLeasePending`.`pendingLeaseID` = ".$pendingLeaseID;

  if ($db->query($sql) === TRUE) {
    $query= "SELECT * FROM executiveLeasePending WHERE pendingLeaseID = ".$pendingLeaseID;
    $result = $db->query($query);
    $posted = 1;
    while($row = $result->fetch_assoc()) {  $alertText = $row['tenantName']." has been successfully updated";}
  }else{
    $posted = 0;
    $alertText = "<b>Something has gone terribly wrong!</b><br> " . $db->error;
}
//    $return = $posted;//."**".$alertText."**".$_POST['newStatus']."**<br>".$sql;
    echo $posted ."**". $alertText."**".$_POST['newStatus'];
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

      $return = $posted."**".$alertText;
      echo $return;
    }



//echo $sql;
