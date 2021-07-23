<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/includes/dbconfig.php';

if ($_GET['q']==1){
  $newStatus = intval($_POST['phonestatus']);
  $sql = "UPDATE `phoneStatus` SET `phoneStatus` = '$newStatus' WHERE `phoneStatus`.`phoneStatusID` = ".$_POST['phonestatusid'];
  if ($db->query($sql) === TRUE) {
    $posted = 1;
  }else{
    $posted = 0;
  }//*/
  echo $posted;
}


if ($_GET['q']==2){
  $sql = "SELECT * FROM `phoneStatus`";
  $result = $db->query("SELECT * FROM `phoneStatus`");
  while($row = $result->fetch_assoc()) {
    $output .= $row['phoneStatus']."|";
}
echo substr($output,0,-1);
}
