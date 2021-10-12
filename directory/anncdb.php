<?php


include $_SERVER['DOCUMENT_ROOT']."/includes/dirconfig.php";

$dbname = "WBdirectory";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['annc'])){

if ($_POST['annid']==0){
$sql= "INSERT INTO `Announcements` (`AnnID`, `Annimg`, `Announcement`, `RunFrom`, `RunUntil`) VALUES
(NULL, '".addslashes($_POST['annimg'])."', '".addslashes($_POST['annc'])."', '".$_POST['runfrom']."', '".$_POST['runtil']."')";
}else {
  $sql= "UPDATE `Announcements`
  SET
  `Annimg` = '".addslashes($_POST['annimg'])."',
  `Announcement` = '".addslashes($_POST['annc'])."',
  `RunFrom` = '".$_POST['runfrom']."',
  `RunUntil` = '".$_POST['runtil']."'
  WHERE `Announcements`.`AnnID` =". $_POST['annid'];

}
if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

}

if (isset($_POST['greeting'])){





$sql= "UPDATE `Contact` SET `Greeting` = '".addslashes($_POST['greeting'])."' WHERE `Contact`.`ID` = 1";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

}


?>
