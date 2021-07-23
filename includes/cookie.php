<?php
session_start();
//echo 'from cookie.php: '. $_SERVER['PHP_SELF'];
$sql = "SELECT * from staff where userName = 'terry'";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
  $roles = explode("|",$row['role']);
  $accessLevel = 2;

}

//$accessLevel = 2;
$currentProperty = 2;
/*
if ($accessLevel == 2 ){
  $loginURL = "http://".$_SERVER['HTTP_HOST']."/login.html";
  header("Location: $loginURL");
  //echo $loginURL;
}
