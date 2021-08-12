<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/includes/dbconfig.php';

if ($_POST['action'] == 'modalAJAX'){
if ($_POST['tbl'] == 'tenantContacts'){
$sql = "SELECT tenantContacts.*, executiveLease.tenantName, executiveLease.Property, executiveLease.suiteNumber FROM tenantContacts JOIN executiveLease ON executiveLease.leaseID = tenantContacts.leaseID WHERE active = 1 AND contactID = ".$_POST['id'];
}else{
$sql = 'SELECT * FROM `executiveLease`  WHERE leaseID = '.$_POST['id'];
}
$result = $db->query($sql);
echo json_encode($result->fetch_assoc());
}

if ($_POST['action'] == 'employeeAJAX'){
$sql = "SELECT * FROM `tenantContacts` WHERE leaseID = ".$_POST['leaseid'];
$result = $db->query($sql);
if (mysqli_num_rows($result) > 0) {
  $x=0;
while($row = $result->fetch_assoc()) {
$output[$x] = $row;
$x=$x+1;
}
} else {$output = 'noEmployees';}
echo json_encode($output);
}

if ($_POST['action']  == 'addemployee'){
$sql= "INSERT INTO `tenantContacts` (`contactID`, `leaseID`, `addContactName`, `addPhone`, `addCell`, `addEmail`, `incidentals`, `active`, `keyholder`) VALUES

(NULL, '".$_POST['id']."', '".$_POST['Name']."', '".$_POST['Phone']."', '".$_POST['Cell']."', '".$_POST['Email']."', '".$_POST['dents']."', '1', '".$_POST['keys']."')";
if ($db->query($sql) === TRUE) {
  $last_id = $db->insert_id;
  echo "gtg,$last_id";
} else {
  echo $sql . "<br>" . $db->error;
}
}

if ($_POST['action']  == 'updatecontact'){
if ($_POST['tbl']=='tenantContacts'){
$foo = explode('|', $_POST['empInfo']);
$sql = "UPDATE `tenantContacts` SET `addPhone` = '".$_POST['phone']."', `addCell` = '".$_POST['cell']."', `addEmail` = ' ".$_POST['email']."',
 `incidentals` = '".$foo[0]."', `active` = '".$foo[1]."', `keyholder` = '".$foo[2]."' WHERE `tenantContacts`.`contactID` = ".$_POST['contactID'];

}else{
  $sql = "UPDATE `executiveLease` SET `contactPhone` = '".$_POST['phone']."', `contactCell` = '".$_POST['cell']."', `contactEmail` = '".$_POST['email']."' WHERE `executiveLease`.`leaseID` =".$_POST['contactID'];

}

if ($db->query($sql) === TRUE) {
  echo "gtg";
} else {
  echo $sql . "<br>" . $db->error;
}


}
