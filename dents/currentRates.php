<?php
require $_SERVER["DOCUMENT_ROOT"].'includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';
//require $_SERVER["DOCUMENT_ROOT"].'php+js/executiveLease.php';
require $_SERVER["DOCUMENT_ROOT"].'crm/crmjs.php';
?>


<div class="container mt-2">
  <div class="row">
    <div class="col-6">
      <table class="table table-sm lease table-striped">
<?php
$groupQuery = "SELECT DISTINCT incidentalGroup FROM incidentalCosts WHERE incidentalGroup NOT LIKE 'Conference%'";

$groups = $db->query($groupQuery);
while($row = $groups->fetch_assoc()) {
  echo "<tr class='table-info'><th colspan=2><center>".$row['incidentalGroup'];
  echo "<tr><th><th>Fee";
  $incidentalGroupSQL = "SELECT * FROM incidentalCosts WHERE incidentalGroup = '".$row['incidentalGroup']."'";
  $chargeByGroup = $db->query($incidentalGroupSQL);
  while($charge = $chargeByGroup->fetch_assoc()) {
    if ($row['incidentalGroup'] == "Handling Fees"){
      echo "<tr><td>".$charge["Name"]." <td> ".(floatval($charge['Price'])*100)."% of ".$charge['unit'];
    }else{

    echo "<tr><td>".$charge["Name"]." <td> $".$charge['Price']."/".$charge['unit'];}
  }
}

 ?>
 </table>
</div>
<div class="col-6">
<table class="table table-sm lease  table-striped">
  <?php
  $groupQuery = "SELECT DISTINCT incidentalGroup FROM incidentalCosts WHERE incidentalGroup LIKE 'Conference%'";

  $groups = $db->query($groupQuery);
  while($row = $groups->fetch_assoc()) {
    echo "<tr class='table-info'><th colspan=2><center>".str_replace("|", " - ", $row['incidentalGroup']);
    echo "<tr><th><th>Fee";
    $incidentalGroupSQL = "SELECT * FROM incidentalCosts WHERE incidentalGroup = '".$row['incidentalGroup']."'";
    $chargeByGroup = $db->query($incidentalGroupSQL);
    while($charge = $chargeByGroup->fetch_assoc()) {
      echo "<tr><td>".$charge["Name"]." <td> $".$charge['Price']."/".$charge['unit'];
    }
  }
   ?>
 </table>
</div>
</div>
</div>
