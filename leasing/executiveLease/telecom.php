<h6><Center>TELECOMMUNICATIONS AGREEMENT</center></h6>
<p>Agreement for providing phone service, high speed internet service, and television service to Suite <?php echo $suiteNumber?> at <?php echo $property['propertyAddress']?> according to the terms and conditions below.</p>

<ol>
<li><b>System Service</b></li>

<ol type="a">
<li>System setup for connecting up to <?php echo $telecomNumberOfLines?> VoIP phone station(s) and '.$numfax.' e-faxes.
<li>Port 0 phone/fax numbers from 3rd party carrier to network for direct access to phone system.
<li>Provide <?php echo $telecomNumberOfDevices?> VoIP phone station(s).  Additional phone stations may be purchased at $300.00 each.
<li>Phone stations remain the property of <?php echo $property['propertyLLC']?> and shall be returned in their original condition, normal wear and tear expected. Equipment lost, stolen, or broken shall be replaced at its replacement cost of $300.00 each.
<li>Provide 1 CAT5 Ethernet port for high-speed internet access. Tenant shall be responsible for installing firewall protection devices and other computer/ networking equipment
for attaching multiple users to the internet.  Use of a router that does not supply Power over Ethernet will result in a one-time $'.number_format((float)$setupfeearray[7],2).' charge for phone power adapter
</ol>

<li><b>Terms and Conditions</b>
<ol type = "a">
<li><?php echo $property['propertyLLC']?> will charge and Tenant acknowledges and hereby contracts for month-to-month service (the “Term”) for $<?php echo number_format($telecomMRC, 2)?> plus <?php echo $salesTaxRate*100?>% sales tax totaling $<?php echo number_format(($telecomMRC*(1+$salesTaxRate)), 2)?> for the base products and services listed above, payable monthly.
<li>Tenant agrees to pay a one time set up fee of $<?php echo number_format($telecomOTC, 2);?> and Additional products and services ordered shall be invoiced and payable upon receipt of order.</li>
<li>Should Tenant desire to cancel service, a thirty (30) day written notice shall be provided to <?php echo $property['propertyLLC']?>.
<li>You hereby designate <?php echo $property['propertyLLC']?> as its agent to request Customer Service Record information from Tenant’s current telecommunications provider.
<li>This proposal and agreement is confidential and proprietary and may not be shared with any 3rd parties.
<li>Tenant is responsible for any 3rd party vendor charges, i.e. phone system and/or communication’s vendor. 1,000 minutes are included in the monthly price; overages, as well as international calls, will be billed to Tenant at actual cost.
<li>Phone Answering, if selected, shall include screening, transferring, and taking messages only.
<li>Pricing provided herein is valid for 30 days from the date first written above.
</ol>
<br>

<!--

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
-->


<li><b>Add On Services</b>
  <div class="col-7">
  <table class="table table-sm lease">
    <tr><td><td>Quantity<td>Set up Fee<td>Monthly Fee</tr>
    <tr><td>Additional Phone Lines<td><?php echo $telecomArray[1];?><td><td></tr>
    <tr><td>Phone Answering<td><div class="form-check"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" disabled <?php echo $phoneAwnsering;?>><td><td></tr>
    <tr><td>Mirror Image Device<td><?php echo $telecomArray[2];?><td><td></tr>
    <tr><td>Power Adapter<td><?php echo $telecomArray[4];?><td><td></tr>
  </table>
</div>
<li><b>Ala Carte Services</b>
    <div class="col-7">
    <table class="table table-sm lease">
      <tr><td><td>Quantity<td>Set up Fee<td>Monthly Fee</tr>
      <tr><td>eFax<td><?php echo $telecomArray[4];?><td><td></tr>
      <tr><td>Static IP(s)<td><?php echo $telecomArray[5];?><td><td></tr>
      <tr><td><div>Business TV Service</div><font size="1">Including HD DVR Cablebox</font><td><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" disabled <?php echo $tvService;?>><td><td></tr>
    </table>
  </div>
  </table>

</ol>
