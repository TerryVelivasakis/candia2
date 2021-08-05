

<style>

</style>

<?php
session_start();
$sql = "SELECT count(pendingLeaseID) from executiveLeasePending WHERE status =1";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {$pendingLeases = $row["count(pendingLeaseID)"];}

$sql = "SELECT count(pendingLeaseID) from executiveLeasePending WHERE status =4";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {$leasesOutForSignature = $row["count(pendingLeaseID)"];}

$sql = "SELECT count(pendingLeaseID) from executiveLeasePending WHERE status =5";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {$movingIn = $row["count(pendingLeaseID)"];}

$sql = "SELECT * FROM Prospects INNER JOIN FollowUpPlan ON Prospects.plannumber=FollowUpPlan.plannumber AND Prospects.Step=FollowUpPlan.step";
$crmActions = 0;
$result = $crmDB->query($sql);
while($row = $result->fetch_assoc()) {
  $nexttouch = strtotime($row['nextcontact']);
  $NTD = ($nexttouch - strtotime("today"))/60/60/24;
  if ($NTD <= 0 && strpos($row['Action'], 'call') !== false) {
  $crmActions=$crmActions+1;
}}

//$pendingLeases = 15;
//$crmActions = 6;
?>
<div class='mpFramed'>
    <h5 class="card-header pb-3"><center><?php echo date('l')."<div class='mt-1'>".date('F j, Y');?>
</div>
<div class='mt-2' id="clock">11:45pm</div>

    </h5>
    <!--
    <div class="card-body">
      <h5 class="card-title">Special title treatment</h5>
      <h6 class="card-subtitle text-muted">Support card subtitle</h6>
    </div>
-->
    <ul class="list-group list-group-flush">
      <?php

      if(in_array('recept',$_SESSION['roles']) or in_array('mgmt',$_SESSION['roles'])){
      echo '<li class="clickable list-group-item d-flex justify-content-between align-items-center" onclick="jumpToPage(1)">CRM Actions Due<span class="badge bg-primary rounded-pill">'.$crmActions.'</span></li>';
      echo '<li class="clickable list-group-item d-flex justify-content-between align-items-center" onclick="jumpToPage(2)">Pending Leases<span class="badge bg-primary rounded-pill">'.$pendingLeases.'</span></li>';
            echo '<li class="clickable list-group-item d-flex justify-content-between align-items-center" onclick="jumpToPage(2)">Leases Out for Signature<span class="badge bg-primary rounded-pill">'.$leasesOutForSignature.'</span></li>';
    }
    if(in_array('maint',$_SESSION['roles']) or in_array('mgmt',$_SESSION['roles'])){
      echo '<li class="clickable list-group-item d-flex justify-content-between align-items-center" onclick="jumpToPage(4)">Work Orders<span class="badge bg-primary rounded-pill">'.$pendingLeases.'</span></li>';
    }
      echo '<li class="clickable list-group-item d-flex justify-content-between align-items-center" onclick="jumpToPage(2)">Tenants Moving In<span class="badge bg-primary rounded-pill">'.$movingIn.'</span></li>';
      echo '<li class="clickable list-group-item d-flex justify-content-between align-items-center" onclick="jumpToPage(4)">Tenants Moving Out<span class="badge bg-primary rounded-pill">'.$pendingLeases.'</span></li>';


      ?>
    </ul>
</div>

<script>
function jumpToPage(page){

  // 1= CRM 2=Leasing 3= Work ORders 4=move outs

switch(page){
  case 1:
  jumpto = 'crm/crmaction.php'
  break;
  case 2:
  jumpto = 'leasing/executiveLeaseReview.php'
  break;
  case 3:
  jumpto = ''
  break;
  case 4:
  jumpto = ''
  break;
}
  window.location.replace(jumpto);
}


function currentTime() {
  var date = new Date(); /* creating object of Date class */
  var hour = date.getHours();
  var min = date.getMinutes();
  var sec = date.getSeconds();
  var midday = "am";
  midday = (hour >= 12) ? "pm" : "am";
  hour = (hour == 0) ? 12 : ((hour > 12) ? (hour - 12): hour);
  hour = updateTime(hour);
  min = updateTime(min);
  sec = updateTime(sec);
  document.getElementById("clock").innerText = hour + ":" + min + " " + midday; /* adding time to the div */
  var t = setTimeout(function(){ currentTime() }, 1000); /* setting timer */
}

function updateTime(k) {
  if (k < 10) {
    return "0" + k;
  }
  else {
    return k;
  }
}

currentTime(); /* calling currentTime() function to initiate the process */


</script>
