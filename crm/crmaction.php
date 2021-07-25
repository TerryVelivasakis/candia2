<?php
require $_SERVER["DOCUMENT_ROOT"].'includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';
require $_SERVER['DOCUMENT_ROOT']."/crm/crmjs.php";
?>
<head>
<link rel="stylesheet" type="text/css" href="crm.css">

<style>

</style>

</head>

<!-- Call Log Modal -->
<div class="modal fade" id="callmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Log Call</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="callnotes" class="form-control"></input>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn blue-grey lighten-3" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-blue-grey blue-grey darken-1" onclick="logcall(1)">Voicemail</button>
        <button type="button" class="btn btn-blue-grey blue-grey darken-1" onclick="logcall(2)">Spoke</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

<div class=container>
<div class="table-responsive-sm" >
    <table cellpadding="1" cellspacing="0" class="table table-sm table-bordered" id="prostable">
    <thead>
    <th width="5%"></th>
    <th width="20%">Name</th>
    <th width="15%">Phone</th>
    <th width="15%">Email</th>
    <th width="45%">Action Due</th>
    </tr>
    </thead>
  <tbody>
    <tr>
      <td><center><button class='btn'><i class="fas fa-phone fa-lg" /></button></td>
        <td class= clickable data-propspectID = 2>Terry Velivasakis</td>
        <td>(914) 471-5828</td>
        <td><a href="mailto:terry@candiaholdings.com">Terry@candiaholdings.com</a></td>
        <td>do something</td>
      </tr>
  <?php
$conn = new mysqli($servername, $username, $password, 'CandiaCRM');
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
$sql = "SELECT * FROM Prospects INNER JOIN FollowUpPlan ON Prospects.plannumber=FollowUpPlan.plannumber AND Prospects.Step=FollowUpPlan.step";

$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$actioncell = "";
$nexttouch = strtotime($row['nextcontact']);
$NTD = ($nexttouch - strtotime("today"))/60/60/24;
$show = true;
if ($NTD < 0) {
$trcolor = ' class="table-warning"';
if (strpos($row['Action'], 'call') !== false) {
$actioncell ="<b>CALL ASAP - Call was due on ". date("F jS", $nexttouch);
}

}

if ($NTD == 0) {
$trcolor =' class="table-info"';
if (strpos($row['Action'], 'call') !== false) {
$actioncell ="Call is due Today";
}
}

if ($NTD > 0) {
$trcolor =' class=""';
if (strpos($row['Action'], 'call') !== false) {
$actioncell ="Call is due on ". date("F jS", $nexttouch);
}
}

if ($row['plannumber'] == 1) {
$show=false;
}

if (strpos($row['Action'], 'email') !== false) {
$show=false;
}

$hr = '<hr style="height:1px; border:none; color:#DCDCDC; background-color:#DCDCDC; width:100%; text-align:center; margin: 0 auto;">';
if ($show){
echo '<tr'.$trcolor.' data-target="#" data-id="crmaction.php?q='.$row['ID'].'">';
echo '<td><div style="font-size: 1.1rem;"><center>';
echo '<a href="crmaction.php?q='.$row['ID'].'" class="txtbtn"><i class="fas fa-address-card fa-lg"></a>'.$hr;
$onclick = '$("#callmodal").modal("show");';
echo '</i><button class="txtbtn" onclick="showcallmodal('.$row['ID'].')"><i class="fas fa-phone fa-lg"></i></button></td></div>';
echo '<td class=clickable>'.$row['FName']." ".$row['LName'];
echo '<td> <i>ph - </i>'.$row['Phone']." ".$hr."<i>c - </i>". $row['cell'];
echo '<td>'.$row['email'];
echo '<td>'.$actioncell;

}
}
?>
</table>
</div>
</div>
<input type="hidden" id="prospectID"></input>

<script>
$('#DescModal').on('hidden.bs.modal', function () {
    window.location.href="crmaction.php";
});

function showcallmodal(foo){
  document.getElementById('prospectID').value = foo;
$("#callmodal").modal("show");
}

function logcall(foo){
if (foo == 1){
bar = "left voicemail";
} else {
bar = "spoke";
}
if (document.getElementById('callnotes').value != ""){
bar=bar+" - "+document.getElementById('callnotes').value
}

$.post("crmdb.php",{
  action: "logcall",
  note: bar,
  pid: document.getElementById('prospectID').value
})  .done(function(){
  window.location.href="crmaction.php";
});

console.log(bar);
console.log(document.getElementById('prospectID').value);


}

//$('#prostable').on('click', 'tr', function(){
//var p1=$(this).attr("data-id");
//window.location.href=p1;
//});

</script>
</html>
