<?php
//variables to define

//require $_SERVER["DOCUMENT_ROOT"].'/includes/bootstrap.php';
//$suiteNumber = 500;

?>

<div class="container">
<div class="row">
  <div class="col heading"><h5>LEASE ABSTRACT</h5></div>
</div>
<br>
  <div class="row">
    <div class="col-auto border">Tenant</div>
    <div class="col border data"><?php echo $tenantName?></div>
  </div>
<div class="row">
  <div class="col-auto border">Lease Term</div>
  <div class="col border data"><?php echo $leaseTerm?></div>
  <div class="col-auto border">Suite Number</div>
  <div class="col border data"><?php echo $suiteNumber?></div>
  <div class="col-auto border">Square Feet</div>
  <div class="col border data"><?php echo $suiteSqft?></div>
  <div class="col-auto border">Mailbox</div>
  <div class="col border data"><?php echo $suiteMailBox?></div>
</div>

<div class="row">

  <div class="col-auto border">Lease Date</div>
  <div class="col border data"><?php echo $suiteNumber?></div>
  <div class="col-auto border">Move in Date</div>
  <div class="col border data"><?php echo $suiteNumber?></div>
</div>
<br>
<div class="row">
  <div class="col heading"><h5>CONTACT INFORMATION</h5></div>
</div>
<br>
<div class="row">
  <div class="col-auto border">Contact Name</div>
  <div class="col border data"><?php echo $contactName?></div>
</div>

<div class="row">
  <div class="col-auto border">Address</div>
  <div class="col border data"><?php echo $contactAddress?></div>
</div>

<div class="row">
  <div class="col-1 border">Phone</div>
  <div class="col-3 border data"><?php echo $contactPhone?></div>
  <div class="col-1 border">Email</div>
  <div class="col-7 border data"><?php echo $contactEmail?></div>
</div>
<br>
<div class="row">
  <div class="col heading"><h5>SIGNAGE</h5></div>
</div>
<br>
<div class="row">
  <div class="col-auto border">Directory</div>
  <div class="col border data"><?php echo $directory?></div>
</div>
<div class="row">
  <div class="col-auto border">Door Sign</div>
  <div class="col border data"><?php echo $doorSign?></div>
</div>
<br>
<div class="row">
  <div class="col heading"><h5>TELECOM SERVICES</h5></div>
</div>
<br>
<div class="row">
  <div class="col-auto border">Telecom Package</div>
  <div class="col border data"><?php echo $telecomPackage?></div>
</div>
<div class="row">
  <div class="col-auto border">Phone Lines</div>
  <div class="col border data"><?php echo $telecomArray[1]?></div>
  <div class="col-auto border">Mirror Image Devices</div>
  <div class="col border data"><?php echo $telecomArray[1]?></div>

  <div class="col-auto border">Efax(es)</div>
  <div class="col border data"><?php echo $telecomArray[1]?></div>
</div>
<div class="row">
  <div class="col-auto border">Power Adapters</div>
  <div class="col border data"><?php echo $telecomArray[1]?></div>
  <div class="col-auto border">Static IP(s)</div>
  <div class="col border data"><?php echo $telecomArray[1]?></div>


  <div class="col-auto border">Phone Answering</div>
  <div class="col-1 border data"><div class="form-check"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" disabled <?php echo $phoneAwnsering;?>></div></div>
  <div class="col-auto border">TV Service</div>
  <div class="col-1 border data"><div class="form-check"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" disabled <?php echo $tvService;?>></div></div>
  <div class="col-auto border">Internet Access</div>
  <div class="col-auto border "><div class="form-check"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" disabled <?php echo $internetCheck;?>><?php echo $internetLease?></div></div>
</div>
<br>
<div class="row">
  <div class="col heading"><h5>DUE AT LEASE SIGNING</h5></div>
</div>
<br>
<div class="row">
  <div class="col-auto border">First Month's Rent</div>
  <div class="col border data">$ <?php echo number_format($totalfirstRent,2)?></div>
  <div class="col-auto border">Base Rent</div>
  <div class="col border ">$ <?php echo number_format($firstMonthRent,2)?></div>
  <div class="col-auto border">Sales Tax</div>
  <div class="col border ">$ <?php echo number_format($firstMonthsalesTax,2)?></div>
</div>
<div class="row">
  <div class="col-auto border">Security Deposit</div>
  <div class="col border data">$ <?php echo number_format($secruityDeposit,2)?></div>
  <div class="col-auto border">Telecom Set Up Fee</div>
  <div class="col border ">$ <?php echo number_format($telecomOTC,2)?></div>
  <div class="col-auto border">1st Month Telecom</div>
  <div class="col border ">$ <?php echo number_format($firstMonthTelecom,2)?></div>
</div>
<div class="row">
  <div class="col-auto border">Total Due</div>
  <div class="col border data">$ <?php echo number_format($totalDueAtSigning,2)?></div>
  <div class="col-auto border">Credit Card Fee</div>
  <div class="col border ">$ <?php echo number_format($totalDueAtSigning*0.05,2)?></div>
  <div class="col-auto border">Total for Credit Card</div>
  <div class="col border ">$ <?php echo number_format($totalDueAtSigning*1.05,2)?></div>
</div>

<br>
<div class="row">
  <div class="col heading"><h5>MONTHLY RECURRING CHARGES</h5></div>
</div>
<br>

<div class="row">
  <div class="col-auto border">Rent</div>
  <div class="col border data">$ <?php echo number_format($baseRent,2)?></div>
  <div class="col-auto border">Telecom charges</div>
  <div class="col border ">$ <?php echo number_format($telecomMRC,2)?></div>
  <div class="col-auto border">Furniture rental</div>
  <div class="col border ">$ <?php echo number_format($furnitureRent,2)?></div>
</div>




</div>
