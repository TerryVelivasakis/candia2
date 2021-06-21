

<!-- TELECOM !-->
<?php

echo '<style>';
echo 'table, th, td {text-align: left; vertical-align: bottom;}';
echo '</style>';


/*
$tenantName = $_POST['tenantname'];
session_start();

if ($_SESSION['access']==1){
	$signerName = "";
}else{
$signerName = $_SESSION['name'];
}
*/
?>


In witness whereof, the parties to this Agreement, either personally or through their duly authorized representatives, have executed this Agreement on the dates set out below, and certify that they have read, understood, and agreed to the terms and conditions of this Agreement.
<br><br>
<table width="100%" cellpadding="0">
<tr>
	<td width="48%">Landlord</td>
	<td></td>
	<td width="48%">Tenant</td>
</tr>
<tr>
	<td><b><?php echo $property['propertyLLC'];?></b></td>
	<td></td>
	<td><b><?php echo $tenantName;?></b></td>

<tr height="75px">
<td style="border-bottom: 1px solid"><font size="2">signed:</font>
</td><td></td>
<td style="border-bottom: 1px solid"><font size="2">signed:</font>
</td></tr>

<tr></tr><tr></tr><tr>
<td height="35px" style="border-bottom: 1px solid"><font size="2">printed name:</font>     &emsp;    <?php echo $signerName;?>
</td><td></td>
<td style="border-bottom: 1px solid"><font size="2">printed name:</font>
</td></tr>

<tr height="35px">
<td style="border-bottom: 1px solid"><font size="2">title:</font>&emsp; <?php echo $signerTitle;?>
</td><td></td>
<td style="border-bottom: 1px solid"><font size="2">title:</font>
</td></tr>


<tr height="35px">
<td style="border-bottom: 1px solid"><font size="2">date:</font>
</td><td></td>
<td style="border-bottom: 1px solid"><font size="2">date:</font>
</td></tr>
</table>
