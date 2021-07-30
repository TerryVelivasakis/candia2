

<style>

</style>

<?php
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
    <h5 class="card-header"><?php echo date('l\, F j, Y');?></h5>
    <!--
    <div class="card-body">
      <h5 class="card-title">Special title treatment</h5>
      <h6 class="card-subtitle text-muted">Support card subtitle</h6>
    </div>
-->
    <ul class="list-group list-group-flush">
      <?php

      if(in_array('recept',$roles) or in_array('mgmt',$roles)){
      echo '<li class="clickable list-group-item d-flex justify-content-between align-items-center" onclick="jumpToPage(1)">CRM Actions Due<span class="badge bg-primary rounded-pill">'.$crmActions.'</span></li>';
      echo '<li class="clickable list-group-item d-flex justify-content-between align-items-center" onclick="jumpToPage(2)">Pending Leases<span class="badge bg-primary rounded-pill">'.$pendingLeases.'</span></li>';
            echo '<li class="clickable list-group-item d-flex justify-content-between align-items-center" onclick="jumpToPage(2)">Leases Out for Signature<span class="badge bg-primary rounded-pill">'.$leasesOutForSignature.'</span></li>';
    }
    if(in_array('maint',$roles) or in_array('mgmt',$roles)){
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



</script>
