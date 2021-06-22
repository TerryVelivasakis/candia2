<center><p>INCIDENTAL AND CONFERENCE ROOM RATES as of <?php echo date("F j, Y")?></p></center>

  <div class="row">
    <div class="col-6">
      <table class="table table-sm lease">
<?php
$groupQuery = "SELECT DISTINCT incidentalGroup FROM incidentalCosts WHERE incidentalGroup NOT LIKE 'Conference%'";

$groups = $db->query($groupQuery);
while($row = $groups->fetch_assoc()) {
  echo "<tr><th colspan=2><center>".$row['incidentalGroup'];
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
<table class="table table-sm lease">
  <?php
  $groupQuery = "SELECT DISTINCT incidentalGroup FROM incidentalCosts WHERE incidentalGroup LIKE 'Conference Room|Tenant'";

  $groups = $db->query($groupQuery);
  while($row = $groups->fetch_assoc()) {
    echo "<tr><th colspan=2><center> Conference Rooms - Tenant Rates";
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
