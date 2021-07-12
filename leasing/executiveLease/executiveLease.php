<?php
require $_SERVER["DOCUMENT_ROOT"].'/leasing/executiveLease/leaseData.php';
require $_SERVER["DOCUMENT_ROOT"].'/leasing/executiveLease/abstract.php';
echo'<div style="page-break-after: always;"></div><div class="container lease">

<center><h4>'.$property['propertyName'].'</h4>

<h6>EXECUTIVE SUITE LEASE AGREEMENT</center></h6>';
require $_SERVER["DOCUMENT_ROOT"].'/leasing/executiveLease/lease.php';

echo'<div style="page-break-after: always;"></div>';
require $_SERVER["DOCUMENT_ROOT"].'/leasing/executiveLease/signatureBlock.php';

echo'<div style="page-break-after: always;"></div>';
echo "<h5><Center>EXHIBIT A</center></h5>";
require $_SERVER["DOCUMENT_ROOT"].'/leasing/allLeases/rules.php';

echo'<div style="page-break-after: always;"></div>';
echo "<h5><Center>EXHIBIT A.1</center></h5>";
require $_SERVER["DOCUMENT_ROOT"].'/leasing/allLeases/incidentalPricing.php';

echo'<div style="page-break-after: always;"></div>';
echo "<h5><Center>EXHIBIT B</center></h5>";
require $_SERVER["DOCUMENT_ROOT"].'/leasing/executiveLease/telecom.php';
//*/
echo'<div style="page-break-after: always;"></div>';
echo "<h5><Center>EXHIBIT C</center></h5>";
require $_SERVER["DOCUMENT_ROOT"].'/leasing/executiveLease/furniture.php';
echo'<div style="page-break-after: always;"></div>';
echo "<h5><Center>EXHIBIT D</center></h5>";
require $_SERVER["DOCUMENT_ROOT"].'/leasing/allLeases/keyReceipt.php';

if ($personalGuarantee != ""){
echo'<div style="page-break-after: always;"></div>';
echo "<h5><Center>EXHIBIT E</center></h5>";
require $_SERVER["DOCUMENT_ROOT"].'/leasing/allLeases/personalGuarantee.php';
}
?>

</div>
