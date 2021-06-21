<head>
<link rel="stylesheet" href="\style\lease.css">
</head>

<?php
//variables to define
require $_SERVER["DOCUMENT_ROOT"].'/includes/dbconfig.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/bootstrap.php';
$salesTaxRate =.065;


//basic info
$tenantName = "Jimmy J. Tenant";
$suiteNumber = 200;
$suiteMailBox = 22;
$suiteSqft = 400;

//property information
$sql = "SELECT * FROM property WHERE propertyID = 1";
$result = $db->query($sql);
$property = $result->fetch_assoc();
$formatter = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
$formatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal");

//lease term
$leaseTerm = "M2M";
$TermCommence = "month to month lease or 6 month or year or whatever"; //function to figure out what it needs to say



//Money
$firstMonthRent = 300;
$firstMonthsalesTax = $firstMonthRent * $salesTaxRate;
$totalfirstRent = $firstMonthRent + $firstMonthsalesTax;

$baseRent = 500;
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
$contactName = "James Jonathan Tenant";
$contactAddress = "123 Main Street, Anywhere, USA 10303";
$contactPhone = "(914) 471-5828";
$contactEmail = "jjtentant@tenantcorp.com";

$directory = "James Jonathan poop";
$doorSign = "James Jonathan poopy";

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
$telecomString = "0,1,1,1,1,1,0,0,1,1";
$telecomArray = explode(",",$telecomString);
switch ($telecomArray[0]){
  case 0:
    $telecomPackage = "No Telecom Package Selected";
    break;
  case 1:
    $telecomPackage = "Basic Telecom Package";
    break;
  case 2:
    $telecomPackage="Business Plus Package";
    break;
  case 3:
    $telecomPackage="Business VIP Package";
}

if ($telecomArray[6]==1){$phoneAwnsering="checked";}else{$phoneAwnsering="";}
if ($telecomArray[7]==1){$tvService="checked";}else{$tvService="";}
$internetCheck="checked";
$internetLease="*included in rent"
 ?>
