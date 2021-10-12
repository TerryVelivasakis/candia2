<?php
//$suiteNumber = 500;

//function floorNumber($steNumber){echo $steNumber."asldkjfhlasjdhflajksdhf";}

 ?>

<p>This lease agreement is made this <?php echo date("jS \of F, Y")?> between <?php echo $tenantName; ?> hereinafter referred to as Tenant and <?php echo $property['propertyLLC']; ?> (hereinafter referred to as Landlord.) Now, therefore, in consideration of mutual premises, covenants, and conditions set forth below, the Landlord and Tenant agree as follows.</p>

<ol>
<li><p><b>DEMISING CLAUSE:</b> Tenant hereby leases from the Landlord the real property described as
SUITE <?php echo $suiteNumber; ?> consisting of approximately <?php echo $suiteSqft; ?> sq. ft. of the Executive
Offices at <?php echo $property['propertyName']?>, located on the <?php echo ucfirst($formatter->format(intval(substr($suiteNumber,0,1))));?> floor of <?php echo $property['propertyAddress']?>.</p></li>

<li><p><b>TERM:</b> <?php echo $TermCommence;?> lease will automatically renew on the first of each subsequent month on a month to month basis.
TERMINATION REQUIRES 30 DAYS WRITTEN NOTICE IN ADVANCE OF NEXT RENEWAL TERM.</p></li>

<li><p><b>RENT:</b> During the term of this lease, the Tenant hereby covenants and agrees to pay Landlord as rent the total sum of $<?php echo number_format($baseRent, 2)?>
 PLUS APPLICABLE SALES TAX <?php echo number_format($salesTaxRate*100, 1);?>% ($<?php echo number_format($baseRent*$salesTaxRate,2);?>) FOR A TOTAL OF $<?php echo number_format($baseRent*(1+$salesTaxRate),2);?> without request or demand. PAYABLE IN ADVANCE the first of every month. Checks are payable to <u><?php echo strtoupper($property['propertyLLC']); ?></u></p>
<?php echo $prorateText;?>


</li>
<?php echo $salesTaxClasue;?>
<!--
if ($daystoprorate > 5 and $daystoprorate < 25){
$a = $baserent/30*$daystoprorate;
$b = $a*$st;
echo '<p>Rent for the month of ' . $mdate->format('F, Y') . ' shall be $'. number_format((float) $a, 2). ' with sales tax of $'.number_format((float) $b, 2).' for a total of $'.number_format((float) $a+$b, 2);
}

if ($incentives == "3mofree"){
$freemo = date_add($mdate, date_interval_create_from_date_string('3 months'));
echo "<p>Rent for the month of ".$freemo->format('F, Y')." shall be $0.00 with sales tax of $0.00 for a total of $0.00";
}
-->
<li><p><b>TELECOM SERVICES:</b> In addition to the above stated base rent, Tenant shall pay $<?php echo number_format($telecomMRC,2)
.' plus Sales Tax of $'.number_format($telecomMRC*$salesTaxRate,2).' for a total of $'.number_format($telecomMRC*(1+$salesTaxRate),2)?> to Landlord any additional fees in the telecom agreement attached as “Exhibit B” as additional rent.  Tenant further agrees to pay a one time set up fee of $<?php echo number_format($telecomOTC,2)?></p></li>

<li><p><b>LATE PAYMENTS:</b> Should Tenant fail to pay any installment of annual rent, or any other sum payable to Landlord under the terms of this Lease by the fifth (5th) of the month, the following late charges to cover the extra expense involved in handling such delinquency shall be paid as additional rent by Tenant to Landlord at the time of payment of the delinquent sum. If the lease payment has not been made by the 15th of the month, the Lease is canceled and Tenant has Fifteen (15) days to remove their property or it is considered abandoned. Should lease be canceled as per the terms of this provision, any early termination fees shall become due immediately.
<ul>
<li>Late Fee: 15% of current month’s unpaid charges.</li>
<li>NSF CHEQUES: $50.00 plus any associated late fees</li></ul></p></li>

<li><p><b>PERMITTED USE:</b> Tenant agrees that the leased premises shall be used only as an office or sales room and for no other purposes. Tenant shall have access to the leased premises during normal working hours, and at any other time. The building is a Smoke Free building. No tampering with any phone system including wall jacks. Tenant agrees to abide by the Rules and Regulations as set forth in “Exhibit A”.  Tenant understands and agrees that the Rules and Regulations in “Exhibit A” are subject to change with or without notice. The most current rules and regulations shall be available through the online rent management system, currently Commercial Café. </p></li>

<li><p><b>SERVICES PROVIDED:</b> Subject to availability, Landlord agrees to provide the Tenant during the term of the Lease and during business hours these services: (8am-5pm, M-F) Landlord assumes no responsibility for loss of services for any reason.
<ul>
<li>Internet Service</li>
<li>Use of conference rooms eight (8) Hours per month. Subjet to the following terms and conditions:
<ol>
<li>Included Conference rooms are:
  <ul><li>At the 801 West Bay Center:</li>
  <ul><li>First Floor: Small and Large
    <li>Third Floor: Large
    <li>Fourth Floor: Small and Large
  </ul>
  <li>At Candia Tower:</li>
  <ul><li>First Floor: Large</li></ul>
<li>Refer to Paragraph 19 of the attached Rules and Regulations for each hour over 8.
  <li>All conference rooms are on a first come first serve basis and require reservation through the receptionist.</li>
</ol>

<li>Daily handling of incoming and outgoing mail.</li>
<li>Use of kitchen facilities.</li>
<li>Company name listed on building directory.</li>
<li>Free Notary and Witness Service</li>
</ul></p>


<li><p><b>SERVICES PROVIDED AT A CHARGE:</b> The Landlord shall make available to the Tenant additional services,
and the Tenant shall pay to the Landlord the charge specified for each service upon monthly invoicing by Landlord.
Landlord assumes no responsibility for any disruption of services and makes no warranty as to availablity or suitability.
Services provided during normal business hours. Prices and Services listed on Exhibit A.1.  <em>Prices are subject to change without notice.  Please call for most recent pricing.</em>

<li><p><b>FURNITURE:</b> Landlord may provide Tenant with leased furnishings subject to terms of “Exhibit C”, if requested; however, Tenant shall bear and pay to the
Landlord throughout the term of the lease a charge of $<?php echo number_format($furnitureRent,2)?> for furnishings in the Tenant's suite.</p></li>

<li><p><b>SIGNS:</b> Landlord has not conveyed to the Tenant any rights in or to the outside walls of the Building of which the Leased Premises forms a part or in windows. Tenant shall not display or erect any lettering, sign, advertising, awning, or other projection in or on the Lease Premises or in/on the Building of which it forms a part, or make any alteration, decoration, additional, or improvement in or to the Leased Premises, or in or to the building of which it forms a part, without the prior written consent of the Landlord.  Tenant may provide artwork, logo or other information no larger than 4”x 7” to be displayed in the door sign which Landlord will provide at Landlord’s cost.</p></li>

<li><p><b>INTERNET ACCESS:</b> Tenant acknowledges and agrees that Landlord is service provider that relies on connectivity and products of third party Internet Service Provider and telecommunications companies, and is therefore not responsible or liable for any part of its services, including interruptions in services, that are due to the acts or omissions of others, or that are otherwise outside of Landlord's reasonable control, and Tenant acknowledges that Landlord makes no warranty of any kind, expressed or implied, regarding the merchantability, fitness, reliability or suitability of its services or products for any particular purpose. Landlord shall have no responsibility for, and Tenant shall have sole responsibility for, any and all telecommunication equipment, computer equipment (including software) or computer network equipment to the wall Ethernet jack inside the Tenant's office, regardless of whether Hub, Router, Network Switch or cable has been supplied by Landlord to Tenant. Tenant further acknowledges that Landlord has no control over the content or reliability of the information, product and content delivered to Tenant over the Internet via Internet network. Under no circumstances shall Landlord be responsible for any damages or losses of the Tenant, including but not limited to special, incidental, consequential, or punitive damages, as a result of any interruption of service, loss of information, theft of information, or any virus, spyware, bug, or other data that reaches Tenant's computer(s) or server(s) through Landlord's network. Notwithstanding the above, in the event that Landlord is found liable to Tenant for any damages, such damages shall not exceed a sum equal to the amounts that Tenant has paid to Landlord as of the date that the liability was incurred. Tenant shall be solely responsible for maintaining all equipment from the wall Ethernet Jack inside Tenant's office to Tenant's internal LAN and computer(s). Tenant shall not have the right, without the Landlord's express written consent, to make any repairs, modifications, or alterations to any wiring, computer networking equipment or additional services beyond the wall Ethernet Jack inside the premise. Under no circumstances shall Tenant be allowed to connect any and all types of router, network switch, VoIP equipment, computer server(s), computer equipment, any computer(s) or telecommunication equipment that will use excessive bandwidth on Internet connection. In the event Tenant is found to use excessive bandwidth on Internet connection, Landlord shall have the right to (at Landlord's sole and absolute discretion) limit the bandwidth by reprogramming the network switch in which Tenant's internet connection is fed through, charge additional service fee based on bandwidth usage for permission to use such router, network switch, computer server, VoIP equipment or telecommunication equipment, suspend or terminate the internet access service or, at Landlord's sole discretion, may enforce any and all remedies as described. Tenant agrees to comply with all applicable federal and state rules and regulations in the use of Landlord's Internet services and products, as well as to comply with the rules of any network to which Tenant may gain access using Landlord's Internet services. Tenant acknowledges that any proprietary, confidential, or otherwise valuable information that Tenant desires to keep confidential should not be transmitted over any part of the Internet without effective encryption, nor should it reside without firewall protection on server(s) and computer(s) connected to the Landlord's network and/or the Internet. Tenant represents and warrants that it shall not transmit or make available over the Internet any products, information or other materials that are illegal, libelous, tortious, or that violate any third party intellectual property or other rights, or that is likely to result in action against Landlord and/or its Internet Service Provider. Landlord may, at Landlord's election, assist Tenant in resolving connectivity and configuration of IP address as a courtesy to Tenant with the understanding that the Tenant is solely responsible for the operation and configuration of any and all computers residing on the Tenant's office(s). In the event that the Tenant makes any configuration changes to the Tenant's computer and loses connectivity, Landlord shall at the Tenant's request and at Landlord's election, make all reasonable efforts to reconfigure such hardware. Such reconfiguration shall be billed to Tenant at the rate reference under Additional Service Price List. Should Tenant request repairs or support for its internal equipment and networks, such repairs and support shall also be billed to Tenant at the rate reference under Additional Service Price List.
</p></li>

<li><p><b>REPAIRS/IMPROVEMENT/MAINTENANCE:</b> The Tenant acknowledges that the premises are in good order and repair, unless otherwise indicated herein, the Landlord shall have the obligation after Tenant has taken possession of the leased premises to make any major alterations, improvements or repairs on the equipment, fixtures, plumbing, air conditioning, heating system, appliances, or machinery in, upon or serving same. The Tenant covenants and agrees at his own expense throughout the term to bear routine maintenance and repair expenses incurred in the normal course of use, for the benefit and discretion of the Tenant and Tenant shall not have the right, without the Landlord's express written consent, to paint, paper, redecorate, rewire, or make alterations to or on the leased premises. No structural permanent fixtures, or improvements shall be undertaken without Landlord's consent and all such improvements or fixtures shall become the property of the Landlord upon termination of this lease. Upon expiration of the lease, the Tenant shall at once surrender the premises in as good condition as received, ordinary wear and tear excluded.</p></li>

<li><p><b>RIGHT OF ENTRY:</b> Tenant shall permit the Landlord or Landlord's agents to enter the premises at reasonable times and upon notice for the purpose of making necessary or convenient repairs, except in case of emergency in which case no notice shall be required.</p></li>

<li><p><b>INDEMNIFICATION:</b> Landlord shall not be liable for any damage or injury to Tenant, or any other person, or in any property occurring on the premise, or any part thereof, or in common areas thereof, unless such damage is the proximate result of the negligence or unlawful act of Landlord, their agents, or their employees. Tenant agrees to hold Landlord harmless from any claims for damages and no matter how caused, except for injury or damages for which Landlord is legally responsible.</p></li>

<li><p><b>POSSESSION:</b> If Landlord is unable to deliver possession of the premises at the commencement hereof, Landlord shall not be liable for any damage caused thereby, nor shall this agreement be void or voidable, but Tenant shall not be liable for any rent until possession is delivered. Tenant may terminate this agreement if possession is not delivered within one day of the commencement of the term hereof.</p></li>

<li><p><b>CHARGES:</b> All charges above the rent shall be billed by the Landlord to Tenant on a monthly basis and Tenant shall remit payment within Five (5) days. Should Tenant fail to pay when due, the appropriate late charges as stated in Section 5, shall apply.  Any prorated charges shall be based upon a Thirty (30) day month and a Three Hundred Sixty (360) day year.</p></li>

<li><p><b>PERSONAL PROPERTY:</b> Tenant agrees that any personal property brought into the premises is done so at Tenant's expense and risk, and if any loss or damage occurs, Landlord will not be held liable.</p></li>

<li><p><b>DEFAULT:</b> If default shall be made in the payment of the rent herein reserved or any part thereof, for a period of three (3) days after the due date of any lease payments; or default shall occur in the due performance or observation of any other covenant, condition or provision of this lease on the part of the Tenant to be performed, kept or observed and if the Tenant shall not have taken and diligently continued to pursue steps to remedy the same within ten (10) days after receipt by the Tenant of written notice from the Landlord specifying the default; then, and in any such case, the Landlord may (a) (a) terminate this Lease by giving written notice to the Tenant of its election to so do, and upon service of such notice this Lease shall forthwith terminate, (b) take possession of the leased premises and re-let the premises for the Tenant's account; (c) accelerate rents due for the remainder of the term while leaving Tenant in possession; all rent to become due immediately upon term of notice by the Landlord. Upon abandonment or vacation of the premises by the Tenant while in default of the payment of rent, the Landlord, his heirs, executors, administrators or assigns shall have the right to immediately thereafter enter and take possession of the property so leased or rented, including all property of the Tenant usually kept on the premises to be thereafter disposed of as provided by law. All property on the premises is hereby subject to a lien in favor of the Tenant to the extent allowed by law. Also, Tenant throughout the remaining term hereof shall pay to the Landlord, each month during the term, the then current excess if any, of the sum of the unpaid rentals and costs, including reasonable attorney's fees, to the Landlord resulting from such default by Tenant over the proceeds, if any, from re-letting.</p></li>


<li><p><b>Tenant'S ACCESS:</b> Conditioned upon Tenant not being in default, Tenant shall have access to the Premises twenty-four (24) hours per day, seven (7) days per week, 365 days per year, subject to reasonable security measures and except in the event of an emergency,
casualty, force majeure or similar event which causes Landlord to limit access to Tenant.

<li><p><b>LIENS:</b> The Tenant agrees to save, defend, and hold the Landlord harmless from any and all liens that might attach to the leased premises on account of labor performed or for materials supplied to the leased premises at the insistence of the Tenant, and agrees to pay or discharge any such liens within thirty (30) days except any liens, the validity of which are being contested diligently by appropriate legal proceedings.</p></li>

<li><p><b>QUIET ENJOYMENT:</b> At all times during the terms of the Lease, the Tenant shall and may peaceably and quietly hold and enjoy the leased premises free from molestation, invasion or disturbance.</p></li>

<li><p><b>ASSIGNMENT / SUBLEASE:</b> Tenant shall not assign, sublet or transfer this Lease herein, without the written consent of Landlord, which shall not be unreasonably withheld.</p></li>

<li><p><b>SUCCESSORS BOUND:</b> Each and all of terms, agreements, covenants and conditions of this Lease shall induce to the benefit of and shall bind only the parties hereto but their respective successors and assigns, subject, however, to the foregoing provisions restricting assignment by the Tenant.</p></li>

<li><p><b>RELOCATION:</b> Landlord, at its expense at any time before or during the Lease Term, shall be entitled to cause Tenant to relocate from the Premises to equal or better space, containing approximately the same Rentable Area as the Premises (the "Relocation Space") within the Building or adjacent buildings within the same project at any time upon fifteen (15) days prior written notice to Tenant.  Should Tenant find the Relocation Space unacceptable in Tenant's sole and absolute discretion, Tenant's only remedy is to terminate this lease with no penalty.</p></li>

<li><p><b>TERMINATION:</b> Termination requires written notice by either party at least thirty (30) days in advance of the next automatic renewal.  This Lease shall terminate on the last day Calendar day of month thirty days following the date Tenant has given notice, or at the option of Landlord, earlier in the event of default under or breach by the Tenant of any of the provisions of this Lease. In the event of such early termination by the Landlord, the Landlord may exercise such other remedies as are set forth elsewhere in this agreement with 30 days written notice.</p></li>

<li><p><b>SURRENDER OF PREMISES:</b>  At the expiration of the tenancy hereby created, Tenant shall surrender the Premises in the same condition as the Premises were in upon the Commencement Date reasonable wear and tear excepted, and damage by unavoidable casualty excepted, and shall surrender all keys for the Premises to Landlord at the place then fixed for the payment of rent and shall inform Landlord of all combinations on locks, safes and vaults, if any, in the Premises. Tenant shall remove all its trade fixtures before surrendering the premises as aforesaid and shall repair any damage to the Premises caused thereby. Tenants obligation to observe or perform this covenant shall survive the expiration or other termination of the term of this Lease. If Tenant fails to remove Tenants Property from the Premises or storage, within 5 days after Surrender of Premises, Landlord may deem all or any part of Tenants Property to be abandoned and title to Tenants Property shall vest in Landlord.  Removal of Tenants Property shall be at Tenant’s sole cost and expense.</p></li>

<li><P><B>30 DAY TERMINATION:</b> Notwithstanding anything to the contrary set forth in this Lease, Either Party shall have the right to terminate this Lease at any time within the first 30 days following occupancy for any reason or no reason by providing written notice of such termination to the other party at least fifteen (15) days prior to the effective date thereof.</p></li>

<li><p><b>30 DAY COOLING OFF PERIOD:</b>Expiring 30 days after occupancy, either party may cancel this Lease with no penalty with written 24 hours notice.  Should either Tenant or Landlord excerise this right, the lease is considered terminated 24 hours after written notice and no further obligation by either party.  Landlord and Tenant agree that Tenant shall pay $<?php echo number_format($totalRent/30, 2);?> per day of occupancy any additional funds will be refunded including prepaid rent and any security deposits due to the tenant.</p></li>

<li><p><b>EARLY TERMINATION:</b>  Conditioned upon Tenant not being in default at the time of exercise, nor Tenant ever being in default (beyond ay applicable cure period) of any monetary obligations under this Lease, Tenant shall have the right to terminate (the “Early Termination Right”) this Lease at any time in its sole discretion, provided that Tenant shall provide Landlord with its written notice to so terminate 30 days in advance of the Early Termination Date. Should Tenant exercise this Early Termination Right, Tenant shall pay to Landlord a fee equal to two (2) months rent plus 10%, if there are less than 90 days left in the initial term of this lease the fee shall be equal to one (1) months rent plus 10%.</p></li>

<li><p><b>ATTORNEY FEES:</b> In any successful action or proceeding, including an appeal, by either of the parties to this Lease against the other to enforce the provisions of this Lease or any exhibit attached hereto, or to recover payment of any claim under to recover damages for the breach of any claim under or to recover damages for the breach of any claim under or to recover damages for the breach of any provision of any of the foregoing, the successful party shall be entitled to recover from the other party all costs and expenses in any such action, including a reasonable attorney's fee to be fixed by the court.</p></li>

<li><p><b>GOOD FAITH:</b> All duties and obligations under this Lease, and all attempts to enforce rights under this Lease shall be governed by reasonable commercial standards of good faith.</p></li>

<li><p><b>BANKRUPTCY:</b> Should Tenant make an assignment for the benefit of creditors, file or voluntary bankruptcy or be adjudicated bankrupt, such action shall constitute a breach of this Lease for which Landlord, at its option, may terminate all rights of Tenant or its successors in interest under this Lease.</p></li>

<li><p><b>NOTICES AND RENT:</b> Any notices which either party may or is required to give, may be given by mailing the same to Landlord at the premises or to the Tenant at the address referenced in Paragraph one above or at Tenant's corporate headquarters since office may not be staffed.</p></li>

<li><p><b>NON WAIVER:</b> The failure of Landlord to take action with respect to any breach of any term, covenant or conditions herein contained. The subsequent acceptance of rent hereunder by Landlord shall not be deemed to be a waiver of any proceeding breach by Tenant of any term, covenant or condition of this Lease.</p></li>

<li><p><b>EXHIBITS:</b> <em>Exhibit A: Rules and Regulations; Exhibit A.1 Incidental and Conference Room Rates; Exhibit B: Telecom Service Agreement; Exhibit C: Furniture Use Agreement; Exhibit D: Suite and Mailbox Keys;<?php echo $personalGuarantee?></em> are hereby attached to this Lease and are a part hereof and are incorporated herein by reference and all provisions of such exhibits shall constitute agreements, promises and covenants  of this Lease.</p></li>

<li><p><b>SECURITY DEPOSIT:</b> Tenant shall deposit with Landlord the sum of $<?php echo number_format((float) $secruityDeposit, 2)?> as security for the full and faithful performance of every provision of this Lease to be performed by Tenant as well as return of the premises in proper condition at the end of the lease term or on earlier termination and forfeiture as provided herein. If Tenant defaults with respect to any provision of this Lease, including but not limited to the provisions relating to the payment of Rent, Landlord may use, apply or retain all or any part of this security deposit for the payment of any Rent or any other sum in default or for the payment of any other amount which, Landlord may spend or become obligated to spend by reason of Tenant’s default. If any portion of said deposit is to be used or applied, Tenant shall, within five (5) days after written demand therefor, deposit cash with Landlord in an amount sufficient to restore the security deposit to its original amount and Tenant’s failure to do so shall be a breach of this Lease. Landlord shall not, unless otherwise required by law, be required to keep this security deposit separate from its general funds. If Tenant shall fully and faithfully perform every provision of this Lease to be performed by it, the security deposit or any balance thereof shall be returned to Tenant (or, at Landlord’s option, to the last transferee of Tenant’s interest hereunder) at the expiration of the Lease term and upon Tenant’s vacation of the Premises.  Any security deposit refund shall be within 30 days of Termination but under no circumstance shall any deposit be returned less than 10 days after termination. In the event the Building is sold, the security deposit will be transferred to the new owner.</p></li>

<li><p><b>SIGNATURES:</b> This Agreement may be signed in counterparts and the Agreement, together with its counterpart signature pages, shall be deemed valid and binding on each party when duly executed by all parties. Facsimile and electronically scanned signatures shall be deemed valid and binding for all purposes. </p></li>

<li><p><b>SEVERABILITY:</b> If any provision of this Agreement or the application thereof shall, for any reason and to any extent, be invalid or unenforceable, neither the remainder of this Agreement nor the application of the provision to other persons, entities or circumstances shall be affected thereby, but instead shall be enforced to the maximum extent permitted by law.</p></li>

<li><p><b>RADON GAS:</b> Radon is a naturally occurring gas that, when it has accumulated in a building in sufficient quantities, may present health risks to persons who are exposed to it over time. Levels of radon that exceed Federal and State guidelines have been found in buildings in Florida. Additional information regarding radon and radon testing may be obtained from your county public health unit.</p></li>

<li><p><b>VACATED PREMISES:</b> Any property left in vacated suites will automatically become the property of <?php echo $property['propertyLLC']; ?> if left there after fifteen (15) days.</p></li>
</ol>

<br><br>	<br><br>
<center><h4>Signature Page to Follow</h4></center>
