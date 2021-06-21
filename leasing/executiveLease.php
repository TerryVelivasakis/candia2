<?php
require $_SERVER["DOCUMENT_ROOT"].'/leasing/executiveLease/leaseData.php';
require $_SERVER["DOCUMENT_ROOT"].'/leasing/executiveLease/abstract.php';
echo'<div style="page-break-after: always;">
</div><center><h4>'.$property['propertyName'].'</h4>
<h6>EXECUTIVE SUITE LEASE AGREEMENT</center></h6>';
require $_SERVER["DOCUMENT_ROOT"].'/leasing/executiveLease/lease.php';
?>
