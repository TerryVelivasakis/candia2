<?php
//variables to define

//require $_SERVER["DOCUMENT_ROOT"].'/includes/bootstrap.php';
//$suiteNumber = 500;
require $_SERVER["DOCUMENT_ROOT"].'/leasing/executiveLease/leaseData.php';
$suiteSqft = 200;
?>

<div class="container lease">
<div class="row align-items-center">
  <div class="col-2" ><img src="<?php echo $property['logo']?>" height="105px"></div>
    <div class="col" ><center><h3>LEASE ABSTRACT</h3></center></div>
  <div class="col-2" >Candia <?php echo $property['propertyNickname']?></div>
</div>
<div class = "row">
  <div class="col-auto">
    <table class="table table-sm lease">
      <tr><th colspan="2" class="table-info">Tenant Information</th></tr>
      <tr><td>Lease Name</td><td><?php echo $tenantName?></td></tr>
      <tr><td>Initial Term</td><td><?php if ($leaseTerm == 1){echo "Month to Month";}elseif ($leaseTerm == 12){echo "1 Year";}else{echo $leaseTerm. " Months";}?></td></tr>
      <tr><td>Suite Number</td><td><?php echo $suiteNumber?></td></tr>
      <tr><td>Mail Box</td><td><?php echo $suiteMailBox?></td></tr>
      <tr><td>Square Feet</td><td><?php echo $suiteSqft?></td></tr>
    </table>
  </div>
  <div class="col">
    <table class="table table-sm lease">
      <tr><th colspan="2" class="table-info">Contact Information</th></tr>
      <tr><td>Contact Name</td><td><?php echo $contactName?></td></tr>
      <tr><td style="vertical-align: top !important">Address</td><td><?php echo $contactAddress?></td></tr>
      <tr><td>Phone Number</td><td><?php echo $contactPhone?></td></tr>
      <tr><td>Email</td><td><?php echo $contactEmail?></td></tr>
    </table>
  </div>
</div>
<div class = "row">
  <div class="col-6">
    <table class="table table-sm lease">
      <tr><th colspan="4" class="table-info">Recurring Charges</th></tr>
      <tr><th>Description</th><th>Base</th><th>Sales Tax</th><th>Total</th>
      <tr><td>Rent PSF: $<?php echo number_format($baseRent/$suiteSqft*12,2)?></td>
        <td>$<?php echo number_format($baseRent,2)?></td>
        <td>$<?php echo number_format($baseRent*$salesTaxRate,2)?></td>
        <td>$<?php echo number_format($baseRent*(1+$salesTaxRate),2)?></td></tr>

      <tr><td>Telecom</td>
        <td>$<?php echo number_format($telecomMRC,2)?></td>
        <td>$<?php echo number_format($telecomMRC*$salesTaxRate,2)?></td>
        <td>$<?php echo number_format($telecomMRC*(1+$salesTaxRate),2)?></td></tr>
      <tr><td>Furniture</td>
        <td>$<?php echo number_format($furnitureRent,2)?></td>
        <td>$<?php echo number_format($furnitureRent*$salesTaxRate,2)?></td>
        <td>$<?php echo number_format($furnitureRent*(1+$salesTaxRate),2)?></tr>
      <tr><td>Total</td>
        <?php $totalMRC = $baseRent+$telecomMRC+$furnitureRent;?>
        <td>$<?php echo number_format($totalMRC,2)?></td>
        <td>$<?php echo number_format($totalMRC*$salesTaxRate,2)?></td>
        <td>$<?php echo number_format($totalMRC*(1+$salesTaxRate),2)?></tr>

    </table>
  </div>
  <div class="col">
    <table class="table table-sm lease">
      <tr><th colspan="2" class="table-info">Lease Information</th></tr>
      <tr><td>Lease Date</td><td><?php echo $leaseDate?></td></tr>
      <tr><td>Move In Date</td><td><?php echo $moveInDate?></td></tr>
      <tr><td>Security Deposit</td><td>$<?php echo number_format($secruityDeposit,2)?></td></tr>
      <tr><td>Telecom Setup Fees</td><td>$<?php echo number_format($telecomOTC,2)?></td></tr>
      <tr><td>Lease Date</td><td><?php echo $leaseDate?></td></tr>
    </table>
  </div>
</div>

<div class = "row">
  <div class="col">
    <table class="table table-sm lease">
      <tr><th colspan="2" class="table-info">Signage</th></tr>
      <tr><td  style="vertical-align: top !important" >Directory</td><td><?php $foo = explode("|",$directory); echo $foo[0]."<br><em>&emsp;".$foo[1]."</em>";?></td></tr>
      <tr><td>Door Sign</td><td><?php echo $doorSign;?></td></tr>

    </table>
    <table class="table table-sm lease">
      <tr><th colspan="3" class="table-info">Due at Lease Signing</th></tr>
      <?php $leaseTotal = ($firstMonthRent*(1+$salesTaxRate))+$telecomOTC+($telecomMRC*(1+$salesTaxRate))+$secruityDeposit;?>
      <tr><td>Total: $<?php  echo number_format($leaseTotal,2)?>
        <td>CC Fee: $<?php  echo number_format($leaseTotal*.05,2)?>
          <td>With CC Fee: $<?php  echo number_format($leaseTotal*1.05,2)?>
    </table>
  </div>
  <div class="col-auto">
    <table class="table table-sm lease">
      <tr><th colspan="2" class="table-info">Telecom Services</th></tr>
      <tr><td colspan="2">Package: <?php echo $telecomPackage[$telecomArray[0]]?>
      <tr><td>Phone Lines: <?php echo $telecomArray[1]?></td><td>EFaxes: <?php echo $telecomArray[5]?></td></tr>
      <tr><td>Phone Answering: <i class="far <?php echo $phoneAnswering;?>"></i></td><td>Power Adapters: <?php echo $telecomArray[4]?></td></tr>
      <tr><td>Internet Access: <i class="far fa-check-square"></i></td><td>Static IPs: <?php echo $telecomArray[6]?></td></tr>
      <tr><td>Mirror Devices: <?php echo $telecomArray[3]?></td><td>TV Service: <i class="far <?php echo $tvService;?>"></i></td></tr>
    </table>
  </div>
</div>

<div class = "row">
  <div class="col">

    <table class="table table-sm lease mb-2"><tr><th class="table-info">Additional Agreements, Improvements, Consessions, & Notes</th></tr></table>
    <table class="table table-sm lease">
    <tr><td><?php echo $absfirstLine;?></td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
  </table>
</div>
</div>


</div>
