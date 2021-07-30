<?php
require $_SERVER["DOCUMENT_ROOT"].'/includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';
?>
<div class='container mt-2'>
  <div class= mt-2>
    <table><tr><td>
  <?php
  $sql = "SELECT * FROM `property`";
  $result = $db->query($sql);
  while($row = $result->fetch_assoc()) {
    $foo = str_replace(" ",'', $row['propertyNickname']);
    $propertyClass[$row['propertyID']]=$foo;
  echo '<div class="form-check form-switch">';
    echo '<input class="form-check-input" type="checkbox" checked="" id="switch'.$foo.'" data-switcher="'.$foo.'" >';
    echo '<label class="form-check-label" for="switch'.$foo.'">Candia '.$row['propertyNickname'].'</label>';
  echo '</div>';
}
   ?>
   <td>
  <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="switchExecutiveTenants" checked="" data-switcher='executive' >
    <label class="form-check-label" for="flexSwitchCheckDefault">Executive Tenants</label>
  </div>
  <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="switchStandardTenants" checked="" data-switcher='standard' >
    <label class="form-check-label" for="flexSwitchCheckChecked" >Standard Tenants</label>
  </div>
</table>
<hr>
</div>
<div id='emailList' class='pt-2 px-3 pt-4 pb-2 border bg-secondary' style="position: relative"><center>
<?php

$sql = "SELECT * FROM `executiveLease`";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
  echo '<span class="'.$propertyClass[$row['Property']].' executive">';
echo $row['contactEmail'].'; ';
echo '</span>';
}

$sql = "SELECT tenantContacts.*, executiveLease.tenantName, executiveLease.Property, executiveLease.suiteNumber FROM tenantContacts JOIN executiveLease ON executiveLease.leaseID = tenantContacts.leaseID WHERE executiveLease.property =".$currentProperty;
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
  echo '<span class="'.$propertyClass[$row['Property']].' executive">';
  echo $row['addEmail'].'; ';
  echo '</span>';
}
 ?>
<button class= 'btn btn-primary btn-sm'style ="position: absolute; left:8; top:5;" onclick='copyToClipboard()' data-bs-toggle="tooltip" data-bs-placement="top" title="Copy Email Addresses to Clipboard"> <i class="fas fa-copy"></i></button>
</div>
</div>
<script>

$('.form-check-input').on('click', function (){
  foo = $(this).data('switcher');
  classSwitch ="." + foo;
  el = $(this).prop('checked');
  if ($(this).prop('checked')){
    $(classSwitch).show();
  }else{
    $(classSwitch).hide();
  }

});

function copyToClipboard() {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($('#emailList').text()).select();
    document.execCommand("copy");
    $temp.remove();
}


</script>
