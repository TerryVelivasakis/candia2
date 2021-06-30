<head>
<link rel="stylesheet" href="\style\lease.css">
<style>
.foots{
vertical-align:middle;
}

/* Add some padding on document's body to prevent the content
 to go underneath the header and footer */

 .fixed-footer{
position: fixed;
bottom: 0;
 }

 @page {
     @bottom {
 	content: "Page " counter(page) " of " counter(pages)
     }
 }
</style>

<?php

//require $_SERVER["DOCUMENT_ROOT"].'/includes/dbconfig.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/bootstrap.php';

$servername = "localhost";
$username = "terry";
$password = "nalgene2";
$dbname = "mailmerge";

$db = mysqli_connect($servername,$username,$password,$dbname);
//$configuration = array('username' => 'MAIN\Terry','password' => '9One4StupidPassword01!');
  if (!$db) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
            }
$sql="SELECT * FROM mailmerge";
$result = $db->query($sql);

while($row = $result->fetch_assoc()) {
  echo $row['tenantName']."<br>";
  echo "2435 US Highway 19<br>";
  echo "Suite ".$row['tenantSuite']."<br>";
  echo "Holiday, FL 34691<br><br>";
}
/*
while($row = $result->fetch_assoc()) {
$suiteNumber = $row['tenantSuite'];
$tenantName = $row['tenantName'];
require $_SERVER["DOCUMENT_ROOT"].'/leasing/letters/lettertotenants.php';
echo'<div style="page-break-after: always;"></div>';
require $_SERVER["DOCUMENT_ROOT"].'/leasing/letters/noticeOfTermination.php';
echo'<div style="page-break-after: always;"></div>';
}
//*/



?>

<center>
<table width ="95%" class="fixed-footer"><tr>
  <td class="foots" width="20%">Candia Tower, LLC</td>
  <td class="foots"><center>&bull;</td>
  <td class="foots"><center>Corporate Office:<br>801 West Bay Drive, Suite 104 Largo, FL 33770</center></td>
  <td class="foots"><center>&bull;</td>
  <td class="foots"style="text-align: right" width="20%">(727) 300-5040<span id="pageNumber"></span></td>
</tr></table></center>
