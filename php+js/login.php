<?php
require $_SERVER["DOCUMENT_ROOT"].'/includes/dbconfig.php';
if ($_POST['action'] == 'login'){
$username =  $_POST['username'];
$password =  $_POST['password'];


$sql = "SELECT * FROM `Staff` WHERE userName = '".$username."' AND TO_BASE64(password) =
 TO_BASE64('".$password."')";

$result = $hrDB->query($sql);
if (mysqli_num_rows($result) > 0) {
while($row = $result->fetch_assoc()) {
session_start();
session_regenerate_id(true);
  $_SESSION['access'] = $row['accessLevel'];
  $_SESSION['property'] = $row['defaultProperty'];
  $_SESSION['roles'] = explode('|',$row['role']);
  $_SESSION['empID'] = $row['staffID'];
if ($row['hourly'] == 1){
$_SESSION['hourly'] = true;
} else {
$_SESSION['hourly'] = false;
}


}
$_SESSION['baby'] = 'guy';
$loginURL = "http://".$_SERVER['HTTP_HOST'];
echo $loginURL;
}else{
echo "fail";
}

}

if ($_POST['action'] == 'logout'){
  session_start();
  session_destroy();
}

?>
