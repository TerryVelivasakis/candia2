<?php
require $_SERVER["DOCUMENT_ROOT"].'includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';
require $_SERVER['DOCUMENT_ROOT']."/crm/crmjs.php";


?>
<style>
.cellfit{
  width: 5%;
  white-space: nowrap;
}
</style>

<div class="modal" id='callModal'>
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="$('#callModal').hide()">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Log Call</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#callModal').hide()">Close</button>
      </div>
    </div>
  </div>
</div>

<div class=container>

  <div class="table-responsive-sm" >
      <table cellpadding="1" cellspacing="0" class="table " id="prostable">
      <thead>
      <th class='cellfit' ></th>
      <th class='cellfit'>Name</th>
      <th class='cellfit'>Phone</th>
      <th class='cellfit'>Email</th>
      <th class='cellfit'>Property</th>
      <th>Action Due</th>
      </tr>
      </thead>
    <tbody>

<?php
$sql = "SELECT * FROM `property`";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
  $property[$row['propertyID']] = $row['propertyNickname'];
}


$sql = "SELECT * FROM Prospects INNER JOIN FollowUpPlan ON Prospects.plannumber=FollowUpPlan.plannumber AND Prospects.Step=FollowUpPlan.step WHERE Prospects.plannumber <> 1";
$result = $crmDB->query($sql);
while($row = $result->fetch_assoc()) {
$actioncell = "";
$nexttouch = strtotime($row['nextcontact']);
$NTD = ($nexttouch - strtotime("today"))/60/60/24;
$show = true;
if ($NTD < 0) {
$trcolor = ' table-primary';
if (strpos($row['Action'], 'call') !== false) {
$actioncell ="<b>CALL ASAP - Call was due on ". date("F jS", $nexttouch);
}

}

if ($NTD == 0) {
$trcolor =' table-dark';
if (strpos($row['Action'], 'call') !== false) {
$actioncell ="Call is due Today";
}
}

if ($NTD > 0) {
$trcolor =' ';
if (strpos($row['Action'], 'call') !== false) {
$actioncell ="Call is due on ". date("F jS", $nexttouch);
}
}

if (strpos($row['Action'], 'email') !== false) {
$show=false;
}
if ($show){
//class='clickable' data-propspectID='".$row['ID']."'
echo "<tr class='$trcolor'>";
echo "<td class='cellfit'><center><i class='clickable fas fa-phone-alt' onclick='logCall(".$row['ID'].")'></i></center>";
echo "<td class='clickable cellfit' data-propspectID='".$row['ID']."'>".$row['FName']." ".$row['LName'];
echo "<td class='clickable cellfit' data-propspectID='".$row['ID']."'>".$row['Phone'];
$email = $row['email'];
echo "<td class='cellfit'><a href='mailto:$email'>$email</a>";
echo "<td class='cellfit'>".$property[$row['Property']];
echo "<td>".$actioncell;
}

}
 ?>
</tbod>
</table>

</div>
</div>
<script>

function logCall(id){
  $('#callModal').show();
console.log(id);
}

</script>
