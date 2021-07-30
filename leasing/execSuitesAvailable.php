<?php
require $_SERVER["DOCUMENT_ROOT"].'includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';
?>
<div class='container mt-2'>

<?php

$sql = "SELECT * FROM `property`";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
  $foo = $row['propertyNickname'];
  $propertyName[$row['propertyID']]=$foo;
echo '<div class="form-check form-switch">';
  echo '<input class="form-check-input" type="checkbox" checked="" id="switch'.$foo.'" data-switcher="bldg'.$row['propertyID'].'" >';
  echo '<label class="form-check-label" for="switch'.$foo.'">'.$row['propertyNickname'].'</label>';
echo '</div>';
}

 ?>

<table class='table' id='availableSuites'>
<thead>
  <tr><th>Suite Number<Th>Square Feet<th>Target Rent<th>Windows<th>Property
</thead>
<tbody>

<?php
$sql = "SELECT * FROM `executiveSuites` es WHERE BuildingID = ".$_SESSION['property']." AND NOT EXISTS ( SELECT NULL FROM `executiveLease` el WHERE el.suiteNumber = es.SuiteNumber AND el.Property = es.BuildingID AND el.status = 1 )";
$result = $db->query($sql);

while($row = $result->fetch_assoc()) {
$rowClass = "";
//if ($row['status']>1){$rowClass = "table-info";}
//$checkSQL = "SELECT * FROM executiveLeasePending WHERE Property =".$row['BuildingID']." AND suiteNumber = '".$row['SuiteNumber']."' AND status BETWEEN 1 AND 5";
//$result2 = $db->query($checkSQL);
//if ($result2->num_rows != 0) { $rowClass = "table-warning";}

echo "<tr data-building='bldg".$row['BuildingID']." $rowClass'><td>".$row['SuiteNumber'];
echo "<td>".number_format($row['SqFt'],0);
echo "<td>$".number_format($row['TargetRent'],2);
echo "<td>".$row['Windows'];
echo "<td>".$propertyName[$row['BuildingID']];

}


  ?>

</tbody>
</table>
hi
</div>
<script>

$(document).ready(function(){
  $('#availableSuites').DataTable({});
});



</script>
