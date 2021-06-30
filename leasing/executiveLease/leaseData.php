<head>
<link rel="stylesheet" href="\style\lease.css">
</head>

<?php
//variables to define
require $_SERVER["DOCUMENT_ROOT"].'/includes/dbconfig.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/bootstrap.php';
$salesTaxRate =.065;

//this is going to come from $_POST
$pendingLease = 1;
$sql = "SELECT * FROM executiveLeasePending WHERE pendingLeaseID = ".$pendingLease;
$result = $db->query($sql);
$prospectiveTenant = $result->fetch_assoc();

//basic info
$tenantName = $prospectiveTenant['tenantName'];
$suiteNumber = $prospectiveTenant['suiteNumber'];
$contactName = $prospectiveTenant['contactName'];
$contactAddress = $prospectiveTenant['contactAddress1'].", ".$prospectiveTenant['contactAddress2'];
$contactPhone = $prospectiveTenant['contactPhone'];
$contactEmail = $prospectiveTenant['contactEmail'];
$baseRent = $prospectiveTenant['rent'];
$directory = $prospectiveTenant['directory'];
$doorSign = $prospectiveTenant['doorSign'];
$leaseTerm = $prospectiveTenant['leaseTerm'];
$telecomString = $prospectiveTenant['telecomArray'];
$leaseDate = date("F j, Y");
$moveInDate = date("F j, Y",strtotime($prospectiveTenant['moveInDate']));
//property information
$sql = "SELECT * FROM property WHERE propertyID = 1";
$result = $db->query($sql);
$property = $result->fetch_assoc();
$formatter = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
$formatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal");

//suite Information
$sql = "SELECT * FROM executiveSuites WHERE suiteNumber LIKE ".$suiteNumber;
$result = $db->query($sql);
$prospectiveTenantSuite = $result->fetch_assoc();
$suiteMailBox = $prospectiveTenantSuite['MailBox'];
$suiteSqft = $prospectiveTenantSuite['SqFt'];
//lease term
if ($leaseTerm > 1){
$TermCommence = "The initial term of this lease shall be ".$leaseTerm." months commencing on ".$moveInDate." and ending on ".date("F j, Y")." After the initial term, this"; //function to figure out what it needs to say
}else{
  $TermCommence = "This lease is on a month to month basis commencing on ".$moveInDate.". This";

}
//Money
$firstMonthRent = 300;
$firstMonthsalesTax = $firstMonthRent * $salesTaxRate;
$totalfirstRent = $firstMonthRent + $firstMonthsalesTax;


$salesTax = $baseRent * $salesTaxRate;
$totalRent = $baseRent + $salesTax;

$telecomMRC = 50;
$telecomOTC = 150;
$firstMonthTelecom = 125;
$furnitureRent = 15;
$secruityDeposit = 750.23;

$totalDueAtSigning= $totalfirstRent+$secruityDeposit+$telecomOTC+$firstMonthTelecom+$furnitureRent;

if (1==2){$personalGuarantee = " Exhibit E: Personal Gauranty;";}else{$personalGuarantee = "";}



//contact INFORMATION


//telecom
/*
0) Package
1) phone Lines
2) mirror image Devices
3) efaxes
4) power Adapters
5) static IPs
6) Phone Answering boolval
7) tvservice boolval
8) internet access boolval
9) internet access included in rents
                  0,1,2,3,4,5,6,7,8,9*/

$telecomArray = explode(",",$telecomString);
switch ($telecomArray[0]){
  case 0:
    $telecomPackage = "No Telecom Package Selected";
    $telecomNumberOfLines = 0;
    $telecomNumberOfDevices = 0;
    break;
  case 1:
    $telecomPackage = "Basic Telecom Package";
    $telecomNumberOfLines = 1;
    $telecomNumberOfDevices = 1;
    break;
  case 2:
    $telecomPackage="Business Plus Package";
    $telecomNumberOfLines = 1;
    $telecomNumberOfDevices = 1;
    break;
  case 3:
    $telecomPackage="Business VIP Package";
    $telecomNumberOfLines = 1;
    $telecomNumberOfDevices = 1;
}
$telecomNumberOfLines += intval($telecomArray[1]);
$telecomNumberOfDevices += intval($telecomArray[2]);
if ($telecomArray[6]==1){$phoneAwnsering="checked";}else{$phoneAwnsering="";}
if ($telecomArray[7]==1){$tvService="checked";}else{$tvService="";}
$internetCheck="checked";
$internetLease="*included in rent";


$signerName = "Lefteris N. Velivasakis";
$signerTitle = "Vice President";
 ?>
