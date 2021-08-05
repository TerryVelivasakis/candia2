<style>
.ct{ color: red}
.wb{ color: blue}
</style>

<div class='mpFramed'>

<h4 class="card-header">Tenant Info</h4>
<select onchange="checkdata()" class=form-select id="tenantSelect">
  <?php
  $sql = "SELECT * from property";
  $result = $db->query($sql);
  $x=0;
  while($row = $result->fetch_assoc()) {
    $propertyInitials[$row['propertyID']] = strtolower($row['propertyInitials']);

}
  $sql = "SELECT * from executiveLease WHERE status > 0";
  $result = $db->query($sql);
$x=0;
  while($row = $result->fetch_assoc()) {
  echo '<option class="'.$propertyInitials[$row['Property']].'" value = '.$x.$row[''];
  echo ' data-tenantname ="'.$row['contactName'].'"';
  echo ' data-company = "'.$row['tenantName'].'"';
  echo ' data-suite = "'.$row['suiteNumber'].'"';
  echo ' data-phone = "'.$row['contactPhone'].'"';
  echo ' data-cell = "'.$row['contactCell'].'"';
  echo ' data-email = "'.$row['contactEmail'].'"';
  echo ' data-primary = 1';
  echo ' data-incidentals=1>';
  if ($row['contactName'] == $row['tenantName']){
  echo $row['tenantName'].' - '. $row['suiteNumber'].$propertyInitials[$row['Property']].'</option>';
}else{
  echo $row['contactName'].' - '.$row['tenantName'].' - '. $row['suiteNumber'].$propertyInitials[$row['Property']].'</option>';
}//*/
$x=$x+1;
}
$sql = "SELECT tenantContacts.*, executiveLease.tenantName, executiveLease.Property, executiveLease.suiteNumber FROM tenantContacts JOIN executiveLease ON executiveLease.leaseID = tenantContacts.leaseID ";
$result = $db->query($sql);

while($row = $result->fetch_assoc()) {
echo '<option class="'.$propertyInitials[$row['Property']].'" value ='.$x;
echo ' data-tenantname ="'.$row['addContactName'].'"';
echo ' data-company = "'.$row['tenantName'].'"';
echo ' data-suite = "'.$row['suiteNumber'].'"';
echo ' data-phone = "'.$row['addPhone'].'"';
echo ' data-cell = "'.$row['addCell'].'"';
echo ' data-email = "'.$row['addEmail'].'"';
echo ' data-primary = 0';
echo ' data-incidentals='.$row['incidentals'].'>';
echo $row['addContactName'].' - '.$row['tenantName'].' - '. $row['suiteNumber']."-".$propertyInitials[$row['Property']].'</option>';
$x=$x+1;

}


  ?>



</select>


<table class="table table-sm">
  <tr><th width = 20% >Name</th><td id="contactTableName"> Tenant 1</td></tr>
  <tr><th>Company</th><td id="contactTableCompany"> Tenant 1</td></tr>
  <tr><th>Suite</th><td id="contactTableSuite"> Tenant 1</td></tr>
  <tr><th>Phone</th><td id="contactTablePhone"> Tenant 1</td></tr>
  <tr><th>Cell</th><td id="contactTableCell"> Tenant 1</td></tr>
  <tr><td colspan=2 id="contactTableEmail"><center>Tenant 1</center></td></tr>
  <tr><td colspan=2><center>
    <i class="far fa-check-square" id="contactTablePrimary"></i> Lease Contact &emsp;
    <i class="far fa-square" id="contactTableIncidentals"> Incidentals</center></td></tr>
</table>
</div>
<script>
function checkdata(){
  $("#contactTableName").text('');
  $("#contactTableCompany").text('');
  $("#contactTableSuite").text('');
  $("#contactTablePhone").text('');
  $("#contactTableCell").text('');
  $("#contactTableEmail").text('');
  $("#contactTablePrimary").removeClass('fa-check-square');
  $("#contactTablePrimary").addClass('fa-square');
  $("#contactTableIncidentals").removeClass('fa-check-square');
  $("#contactTableIncidentals").addClass('fa-square');

$("#contactTableName").text($("#tenantSelect").find(':selected').data('tenantname'));
$("#contactTableCompany").text($("#tenantSelect").find(':selected').data('company'));
$("#contactTableSuite").text($("#tenantSelect").find(':selected').data('suite'));
$("#contactTablePhone").text($("#tenantSelect").find(':selected').data('phone'));
$("#contactTableCell").text($("#tenantSelect").find(':selected').data('cell'));

var emailaddress= $("#tenantSelect").find(':selected').data('email');
if (typeof emailaddress !== 'undefined'){
var emailLink = '<center><a href="mailto:'+emailaddress+'">'+emailaddress+'</a></center>';}
$("#contactTableEmail").html(emailLink);

if ($("#tenantSelect").find(':selected').data('primary')==1){
$("#contactTablePrimary").removeClass('fa-square');
$("#contactTablePrimary").addClass('fa-check-square');
}

if ($("#tenantSelect").find(':selected').data('incidentals')==1){
$("#contactTableIncidentals").removeClass('fa-square');
$("#contactTableIncidentals").addClass('fa-check-square');
}

}

$(document).ready(function(){
  var options = $("#tenantSelect option");                    // Collect options
  options.detach().sort(function(a,b) {               // Detach from select, then Sort
      var at = $(a).text();
      var bt = $(b).text();
      return (at > bt)?1:((at < bt)?-1:0);            // Tell the sort function how to order
  });
  options.appendTo("#tenantSelect");
  checkdata();
  });
</script>
