<head>
<link rel="stylesheet" href="\style\lease.css">


<?php
//variables to define
require $_SERVER["DOCUMENT_ROOT"].'/includes/loadme.php';


$sql = "SELECT * FROM telecomPricing";
$result = $db->query($sql);

$telecomSetupFee = [0];
$telecomMonthlyFee = [0];
$telecomPackage = ['None - No Telecom Package Selected'];
while($row = $result->fetch_assoc()) {
if ($row['ProductID']<4){
  //$testvar = $row['Name']." - ".$row['Description'];
  array_push($telecomPackage, "<em>".$row['Name']."</em> - ".$row['Description']);
}

array_push($telecomSetupFee, floatval($row['SetupFee']));
array_push($telecomMonthlyFee, floatval($row['MonthlyFee']));
}

//this is going to come from $_POST
$pendingLease = $_GET['q'];


$sql = "SELECT * FROM executiveLeasePending WHERE pendingLeaseID = ".$pendingLease;
$result = $db->query($sql);
$prospectiveTenant = $result->fetch_assoc() or die("Invalid Selection, do better");
$sql = "SELECT * FROM property WHERE propertyID = ".$prospectiveTenant['Property'];
@$result = $db->query($sql);
$property = $result->fetch_assoc();

//basic info
$tenantName = $prospectiveTenant['tenantName'];
$suiteNumber = $prospectiveTenant['suiteNumber'];
$contactName = $prospectiveTenant['contactName'];
$contactAddress = $prospectiveTenant['contactAddress1']."<br>".$prospectiveTenant['contactAddress2'];
$contactPhone = $prospectiveTenant['contactPhone'];
$contactEmail = $prospectiveTenant['contactEmail'];
$baseRent = $prospectiveTenant['rent'];
$directory = $prospectiveTenant['directory'];
$doorSign = $prospectiveTenant['doorSign'];
$secruityDeposit = $baseRent * $DepositMultiplier;
$leaseTerm = $prospectiveTenant['leaseTerm'];
$telecomString = $prospectiveTenant['telecomArray'];
$furnitureCount = explode(',',$prospectiveTenant['furnitureCount']);
$furnitureRent = $prospectiveTenant['furnitureRent'];
$furniturePrebuilt = ["L Shaped Desk","Rectangle Desk","Executive Chair","Guest Chair","Filing Cabinet"];
$furnitureAdditional = explode('|',$prospectiveTenant['furnitureAdditional']);
$furnitureDescription = array_merge($furniturePrebuilt, $furnitureAdditional);
$leaseDate = date("F j, Y");
$moveInDate = date("F j, Y",strtotime($prospectiveTenant['moveInDate']));
//property information

if ($prospectiveTenant['guaranty'] == 1){
  $personalGuarantee = "Exhibit E: Personal Guaranty;";
  $absPersonalGuaranty ="Requires Personal Guaranty.  ";}else{$personalGuarantee=""; $absPersonalGuaranty ="";}


$formatter = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
$formatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal");

//suite Information
$sql = "SELECT * FROM executiveSuites WHERE suiteNumber LIKE ".$suiteNumber;
$result = $db->query($sql);
$prospectiveTenantSuite = $result->fetch_assoc();
if ($prospectiveTenant['Property'] == 1){
$suiteMailBox = $prospectiveTenantSuite['MailBox'];
} else {
$suiteMailBox = "N/A";
}

$suiteSqft = $prospectiveTenantSuite['SqFt'];
//lease term
if ($leaseTerm > 1){
$TermCommence = "The initial term of this lease shall be ".$leaseTerm." months commencing on ".$moveInDate." and ending on ".date("F j, Y")." After the initial term, this"; //function to figure out what it needs to say
}else{
  $TermCommence = "This lease is on a month to month basis commencing on ".$moveInDate.". This";

}
//Money



$date1 = date("Y-m-d",strtotime($moveInDate));
$date2 = date("Y-m-t",strtotime($moveInDate));
//$prorateDays = date_diff($date1,$date2);
$prorateDays = dateDifference($date1,$date2);

if ( $prorateDays <= 5){
  $firstMonthRent = 0;
  $prorateText = "<p><em>Tenant shall pay no rent or associate sales tax for the remainder of ".date("F Y",strtotime($moveInDate)).".</em></p>";
  $absProrateText = "No Rent for ".date("F Y",strtotime($moveInDate)).".";
}elseif($prorateDays < 25){
  $firstMonthRent = $baseRent/30*$prorateDays;
  $prorateText = "<p><em>Rent for the Month of ".date("F Y",strtotime($moveInDate))." shall be $".number_format($firstMonthRent,2)." plus Sales Tax of ".number_format($firstMonthRent*$salesTaxRate,2)." for a total of $".number_format($firstMonthRent*(1+$salesTaxRate),2).".</em></p>";
  $absProrateText = "Rent for ".date("F Y",strtotime($moveInDate))." is $".number_format($firstMonthRent,2)." plus $".number_format($firstMonthRent*$salesTaxRate,2)." Sales Tax";
}else{
  $firstMonthRent = $baseRent;
}

if ($prospectiveTenant['contactPhone'] == 1){
$absConsessions = "No Rent for ".date("F Y",strtotime($moveInDate. " + 2 months"));
$consessionText = "<p><em>Tenant shall pay no rent or associate sales tax for the month of ".date("F Y",strtotime($moveInDate. " + 2 months")).".</em></p>";

}
$firstMonthsalesTax = $firstMonthRent * $salesTaxRate;
$totalfirstRent = $firstMonthRent + $firstMonthsalesTax;


$salesTax = $baseRent * $salesTaxRate;
$totalRent = $baseRent + $salesTax;

//telecom costs

/*

0) Package
1) phone Lines
2) Phone Answering boolval
3) mirror image Devices
4) power Adapters
5) efaxes
6) static IPs
7) tvservice boolval
8) internet access boolval
9) internet access included in rents
*/





//contact INFORMATION


//telecom


$telecomArray = explode(",",$telecomString);
switch ($telecomArray[0]){
  case 0:
    $telecomNumberOfLines = 0;
    $telecomNumberOfFaxes = 0;
    $telecomNumberOfDevices = 0;
    break;
  case 1:
    $telecomNumberOfLines = 1;
    $telecomNumberOfFaxes = 1;
    $telecomNumberOfDevices = 1;
    break;
  case 2:
    $telecomNumberOfLines = 1;
    $telecomNumberOfFaxes = 1;
    $telecomNumberOfDevices = 1;
    break;
  case 3:
    $telecomNumberOfLines = 1;
    $telecomNumberOfFaxes = 0;
    $telecomNumberOfDevices = 1;
}
$telecomNumberOfLines += intval($telecomArray[1]);
$telecomNumberOfDevices += intval($telecomArray[2]) + intval($telecomArray[1]);
$telecomNumberOfFaxes += intval($telecomArray[5]);
if ($telecomArray[3]==1){
  $phoneAnswering="fa-check-square";
  $answeringSetup = number_format($telecomSetupFee[5],2);
  $answeringMonthly = number_format($telecomMonthlyFee[5],2);
}else{
  $phoneAnswering="fa-square";
  $answeringSetup = number_format(0,2);
  $answeringMonthly = number_format(0,2);
}
if ($telecomArray[7]==1){
  $tvService="fa-check-square";
  $TVSetup = number_format($telecomSetupFee[12],2);
  $TVMonthly = number_format($telecomMonthlyFee[12],2);
}else{
  $tvService="fa-square";
  $TVSetup = number_format(0,2);
  $TVMonthly = number_format(0,2);
}

$internetCheck="checked";
$internetLease="*included in rent";


$signerName = "Lefteris N. Velivasakis";
$signerTitle = "Vice President";

/*
0) Package
1) phone Lines
2) Phone Answering boolval
3) mirror image Devices
4) power Adapters
5) efaxes
6) static IPs
7) tvservice boolval
8) internet access boolval
9) internet access included in rents
                  0,1,2,3,4,5,6,7,8,9*/

$telecomOTC =
    ($telecomSetupFee[$telecomArray[0]])+//basepackage
    ($telecomArray[1]*$telecomSetupFee[4])+//phonelines
    ($telecomArray[2]*$telecomSetupFee[5])+//phone Answering
    ($telecomArray[3]*$telecomSetupFee[6])+//phone Answering
    ($telecomArray[4]*$telecomSetupFee[7])+//phone Answering
    ($telecomArray[5]*$telecomSetupFee[8])+//phone Answering
    ($telecomArray[7]*$telecomSetupFee[12]);

$telecomMRC =
    ($telecomMonthlyFee[$telecomArray[0]])+//basepackage
    ($telecomArray[1]*$telecomMonthlyFee[4])+//phonelines
    ($telecomArray[2]*$telecomMonthlyFee[5])+//phone Answering
    ($telecomArray[3]*$telecomMonthlyFee[6])+//phone Answering
    ($telecomArray[4]*$telecomMonthlyFee[7])+//phone Answering
    ($telecomArray[5]*$telecomMonthlyFee[8])+//phone Answering
    ($telecomArray[7]*$telecomMonthlyFee[12]);

if ($telecomArray[6] > 0){
  $staticSetup = $telecomSetupFee[10] + ($telecomSetupFee[11]* ($telecomArray[6]-1));
  $staticMonthly = $telecomMonthlyFee[10] + ($telecomMonthlyFee[11]* ($telecomArray[6]-1));
  $telecomOTC += $staticSetup;
  $telecomMRC += $staticMonthly;
}

$totalDueAtSigning= $totalfirstRent+$secruityDeposit+$telecomOTC+$firstMonthTelecom+$furnitureRent;

$absfirstLine = trim($absProrateText." ".$absConsessions." ".$absPersonalGuaranty);

if ($absfirstLine==""){$absfirstLine="&nbsp;";}

 ?>

 <title><?php echo $tenantName;?> - Executive Suite Lease</title>
</head>
