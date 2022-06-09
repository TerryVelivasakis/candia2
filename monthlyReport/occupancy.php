<?php
require $_SERVER["DOCUMENT_ROOT"].'/includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';
session_start();


require_once $_SERVER["DOCUMENT_ROOT"].'/includes/dbconfig.php';

$repDB = mysqli_connect($servername,$username,$password,'CandiaPartnerReport');

if (!$repDB) {
  echo "Error: Unable to connect to MySQL." . PHP_EOL;
  echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
  echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
  exit;
          }



$sql = "SELECT * FROM `Occupancy`";
$result = $repDB->query($sql);
//var_dump($result);
$foo = 1;
$avgTotalSF=0;
while($row = $result->fetch_assoc()) {
$avgTotalSF += intval($row['TotalSF']);
$foo+=1;
}
$avgTotalSF = intval(($avgTotalSF/$foo)*1.2);
echo $avgTotalSF;

$bar=(47526/$avgTotalSF)*100;
echo "<br>".$bar;
//echo "<hr>";
//var_dump($tableData);
?>
