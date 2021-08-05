<?php
require $_SERVER["DOCUMENT_ROOT"].'includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';
?>
<div class='container mt-2'>
    <div class='row'>
      <div class=col-6>
  <fieldset class="">
    <div class='row'>
        <legend>Property</legend>
        <div class=col-auto>
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input qsProperty" name="qsProperty" id="optionsRadios1" value="all" checked="">
            All Properties
          </label>
        </div>
      </div>
<?php

$sql = "SELECT * FROM `property`";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
  $foo = $row['propertyNickname'];
  $propertyName[$row['propertyID']]=$foo;
echo '<div class=col-auto><div class="form-check">';
  echo '<label class="form-check-label">';
  echo '<input type="radio" class="form-check-input qsProperty" name="qsProperty" id="options'.$foo.'" value="'.$foo.'">';
  echo $foo.'</label>';
echo '</div></div>';
}

 ?>
</div>
</fieldset>
</div>
<div class=col-6>
<fieldset class="form-group">
<div class=row>

      <legend>Windows</legend>
      <div class=col-auto>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input qsWindows" name="qsWindows" value="all" checked="">
          All
        </label>
      </div>
    </div>
  <div class=col-auto><div class="form-check">
      <label class="form-check-label">
      <input type="radio" class="form-check-input qsWindows" name="qsWindows" value="interior">
      Interior
      </label>
    </div></div>
    <div class=col-auto><div class="form-check">
        <label class="form-check-label">
        <input type="radio" class="form-check-input qsWindows" name="qsWindows" value="exterior">
        Exterior
        </label>
      </div></div>
  </div>
    </fieldset>
  </div></div>
<hr>
<table class='table' id='availableSuites'>
<thead>
  <tr><th>Suite Number<Th>Square Feet<th>Target Rent<th>Windows<th>Property
</thead>
<tbody>

<?php
$sql = "SELECT * FROM `executiveSuites` es WHERE NOT EXISTS ( SELECT NULL FROM `executiveLease` el WHERE el.suiteNumber = es.SuiteNumber AND el.Property = es.BuildingID AND el.status = 1 )";
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
echo "<td>";
if ($row['Windows'] == 1){
  echo "Exterior";}else{echo "Interior";}
echo "<td>".$propertyName[$row['BuildingID']];

}


  ?>

</tbody>
</table>

</div>
<script>

$(document).ready(function(){
  $('#availableSuites').DataTable({});
});

$('.qsProperty').click(function(){
  var table = $('#availableSuites').DataTable();
if ($("input[name='qsProperty']:checked").val() == 'all'){
  table.columns(4).search('').draw();
}else{

table.columns(4).search($("input[name='qsProperty']:checked").val()).draw();
}
});

$('.qsWindows').click(function(){
  console.log('something happened');
  var table = $('#availableSuites').DataTable();
if ($("input[name='qsWindows']:checked").val() == 'all'){
  table.columns(3).search('').draw();
}else{
  table.columns(3).search($("input[name='qsWindows']:checked").val()).draw();
}
});


</script>
