<head>
<link rel="stylesheet" href="\style\lease.css">

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
            /*
$sql="SELECT * FROM mailmerge";
$result = $db->query($sql);

while($row = $result->fetch_assoc()) {
  echo $row['tenantName']."<br>";
  echo "2435 US Highway 19<br>";
  echo "Suite ".$row['tenantSuite']."<br>";
  echo "Holiday, FL 34691<br><br>";
}

while($row = $result->fetch_assoc()) {
$suiteNumber = $row['tenantSuite'];
$tenantName = $row['tenantName'];
require $_SERVER["DOCUMENT_ROOT"].'/leasing/letters/lettertotenants.php';
echo'<div style="page-break-after: always;"></div>';
require $_SERVER["DOCUMENT_ROOT"].'/leasing/letters/noticeOfTermination.php';
echo'<div style="page-break-after: always;"></div>';
}
//*/
$tenantName = "Test Tenant";
$tenantAddress1 = "123 main street";
$tenantAddress2 = "suite 104";
$tenantAddress3 = "Largo FL 33770";
$currRent = 500;
$dueOn = "July 1, 2021";
$pastDue = 800;
$totalDue = 931.43;


echo '<center><img src="\img\logo\tower.jpg" height ="125px" ></center>';
echo "<div class=container><center><h2><u>NOTICE OF OVERDUE RENT PAYMENT</u></h2></center>";


echo "<br>".$tenantName."<br>";
echo $tenantAddress1;
if ($tenantAddress2 != ""){
echo "<br>$tenantAddress2<br>";}
echo $tenantAddress3."<br><br>";

echo date("F j, Y")."<br><br>";

echo "
<p>This letter is to inform you that as of $date is past due. According to your
lease, a late fee of $".number_format($lateFee,2)." applied to the amount due. </p>

<p><b>The balance due immediately is $".number_format($totalDue,2)."</b></p>

<p>Acceptable forms of payment include Check, Money Order, and Credit Card.</p>

<p>Your prompt attention to this matter is needed to avoid further consequence. Failure to pay the
past due balance on or before $todayplus3 could lead to eviction proceedings, and you may be responsible for charges, such as legal
fees, in addition to past-due rent. Your credit rating could also be adversely affected.</p>
Regards,<br><br>";
echo "
<img style='border-bottom:1px solid black' src='\img\sigs/terry.jpg' height ='90px' >
<br>Candia Tower, LLC";

echo "</div><br><br><br><br><br><br><br>";

echo '
<hr>
<center>
<table width ="95%" class="fixed-footer"><tr>
  <td class="foots" width="20%">Candia Tower, LLC</td>
  <td class="foots"><center>&bull;</td>
  <td class="foots"><center>Corporate Office:<br>801 West Bay Drive, Suite 104 Largo, FL 33770</center></td>
  <td class="foots"><center>&bull;</td>
  <td class="foots"style="text-align: right" width="20%">(727) 300-5040<span id="pageNumber"></span></td>
</tr></table></center>';
?>
