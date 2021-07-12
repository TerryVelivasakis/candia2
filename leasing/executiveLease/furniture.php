<h6><Center>FURNITURE USE AGREEMENT</center></h6>



<ol>

<li><p><b>Tenant’s Responsibility for Maintaining the Leased Property:</b> It is the Tenant’s responsibility to maintain the property, to keep it in good condition, and to return it to Landlord at the end of the Lease Term or otherwise as required by this agreement in the same condition as when received by Tenant, ordinary wear excepted. The Leased Property shall not be removed from the address to which it is delivered without Landlord’s written consent. IF YOU FAIL TO RETURN THE LEASED PROPERTY AS REQUIRED, YOU WILL BE LIABLE TO Landlord FOR ITS FULL RETAIL VALUE (Landlord’S CURRENT RETAIL PRICE) IN ADDITION TO ALL OTHER PAYMENTS AND CHARGES IDENTIFIED IN THIS LEASE AGREEMENT.</p></li>

<li><p><b>Additional Rent:</b> <? php echo $property['propertyLLC']?> will charge and Tenant acknowledges and hereby contracts for $<?php echo number_format($furnitureRent,2)?> plus <?php echo number_format($salesTaxRate*100,2)?>% sales tax for the use of the furniture listed below, payable monthly as additonal rent.</p></li>

<li><p><b>Security Interests:</b> It is understood that this transaction is a lease and not a conditional sale or financing agreement. Title and ownership to the Leased Property remain vested in Landlord, and Tenant may not grant a security interest of any kind in the Leased Property. Tenant shall keep the Leased Property free and clear from all levies, attachments, liens and encumbrances. In the event that any person other than Landlord attempts to create or assert an interest in the Leased Property, Tenant shall give Landlord immediate notice thereof and shall take such action as Landlord requires.</p></li>

<li><p><b>Warranties:</b> Landlord will deliver the Leased Property in good usable condition. Landlord makes no other warranties, express or implied, and specifically disclaims any warranty of fitness for a particular purpose or merchantability.</p></li>
<li><p><b>Furniture Provided:</b>
<?php
if (array_sum($furnitureCount) == 0){
echo "Landlord not providing furniture.</li>";
}else{
echo "</li><table class='table table-sm'>";
echo "<tr><th width = '15%'>Quantity<th>Description</tr>";
$i=0;
while ($i < count($furnitureCount)){
  if ($furnitureCount[$i] >0){echo "<tr><td>".$furnitureCount[$i]."<td>".$furnitureDescription[$i]."</tr>";}
$i++;
}
echo "</table>";
}
?>
</ol>
