<?php
require $_SERVER["DOCUMENT_ROOT"].'/includes/dbconfig.php';
$sql = "SELECT * FROM `property`";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
  $property[$row['propertyID']] = $row['propertyNickname'];
}

if ($_POST['action'] == 'changeProperty' ){
session_start();
$_SESSION['property'] = $_POST['newProperty'];
echo $property[$_POST['newProperty']];
}


if ($_POST['action'] == 'logout'){
  session_start();
  session_destroy();
}
