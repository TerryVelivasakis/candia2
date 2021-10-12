<?php
include $_SERVER['DOCUMENT_ROOT']."/includes/dirconfig.php";

$dbname = "WBdirectory";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_POST['delete']==1){
$sql = "DELETE FROM `Tenants` WHERE `Tenants`.`ID` =". $_POST['tenid'];

}else{
if ($_POST['tenid'] == 0){
$sql="INSERT INTO `Tenants` (`ID`, `Suite`, `Line1`, `Line2`) VALUES (NULL, '".$_POST['suite']."', '".addslashes($_POST['line1'])."', '".addslashes($_POST['line2'])."')";
}else{
$sql="UPDATE `Tenants` SET `Suite` = '".$_POST['suite']."', `Line1` = '".addslashes($_POST['line1'])."', `Line2` = '".addslashes($_POST['line2'])."' WHERE `Tenants`.`ID` =".$_POST['tenid'];
}
}



if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}


?>
