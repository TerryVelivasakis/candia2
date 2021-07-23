<?php
require_once $_SERVER['DOCUMENT_ROOT']."/includes/loadme.php";
?>
<style>

@media print {
    body{
        width: 8.5in;
        height: 11in;
        margin: .5in .25in .5in .25in;
        /* change the margins as you want them to be. */
   }
}

</style>


<?php

$heardfrom[]="Craigslist";
$heardfrom[]="801 Website";
$heardfrom[]="Refferal Service";
$heardfrom[]="Loopnet";
$heardfrom[]="Google";
$heardfrom[]="Word of Mouth";
$heardfrom[]="Other/Unknown";

if (isset($_GET['q'])) {

$pid = $_GET["q"];

$sql = "SELECT * FROM Prospects WHERE ID =".$pid;
$result = $crmDB->query($sql);

while($row = $result->fetch_assoc()) {
$name = $row['FName'].' '.$row['LName'];

$company = $row['company'];
$phone = $row['Phone'];
$cell = $row['Cell'];
$email = $row['email'];
$size = $row['size'];
$source = $heardfrom[$row['source']];
$sql = "SELECT * FROM `PlanNames` WHERE `PlanID` = ".$row['plannumber'];
$touchinfo = "Added on ".date("n/j/y", strtotime($row['pdate']))." and last contact was ".date("n/j/y", strtotime($row['lastcontact'])).".";
}
//echo 'notetable();';
//echo "$('#DescModal').modal('show');";
}




?>



<?php
echo "<center><h5>".$name." - Prospect Details</h5>";
?>



<div id="error"></div>
             </div>


<table class="table-sm table-bordered" width="98%">
  <tr><td width="25%"><b>Company:</b> <?php echo $company;?><td width="25%"><b>Email:</b> <?php echo $email;?><td width="25%"><b>Phone:</b> <?php echo $phone;?>
    <td width="25%"><b>Cell:</b><?php echo $cell;?>
  <tr><td colspan="2"><b>What size office are you intererested in? </b> <?php echo $size;?></b><td colspan="2">How did you hear about us?  <?php echo $source;?>
    <tr><td colspan="2">Follow Up Plan<td colspan="2"><?php echo $touchinfo;?>
</table>
<hr style="height:1px; border:none; color:#DCDCDC; background-color:#DCDCDC; width:100%; text-align:center; margin: 3px auto;">
</center>
<h5>Notes</h5>
<?php
$x=0;
$conn = new mysqli($servername, $username, $password, 'CandiaCRM');
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
echo '<table class=\' table-striped table-bordered table-sm\' id=\'notestable\'>';
$sql = "SELECT * FROM notes WHERE prospect =".$_GET['q']." ORDER BY ndate DESC, ID DESC";
//$sql = "SELECT * FROM notes";
//echo 'console.log("'.$sql.'");';
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
echo  "<tr><td width='20%'><i>".$row['editor']." on</i> ". date('n/j/y', strtotime($row['ndate'])). "<td width='80%'>".$row['note'];
$x=$x+2;
//echo 'console.log("'.$newhtml.'");';
//echo'$("#notebody").html('.$newhtml.');';
}
for ($x = $x; $x <= 40; $x++) {
    echo "<tr height = '30px'><td colspan='2'>";
}


echo '</table>';
?>


<script>
function printme(){
  console.log('this worked');
  $("#test").html(
    $(".modal-body").html())

window.print();
  };



function notetable(){
  <?php
  if (isset($_GET['q'])){
  $newhtml = "";
  $conn = new mysqli($servername, $username, $password, 'CandiaCRM');
  if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
  $newhtml = '"<table class=\'table table-striped table-bordered table-sm\' id=\'notestable\'>';
  $sql = "SELECT * FROM notes WHERE prospect =".$_GET['q']." ORDER BY ndate DESC, ID DESC";
  //$sql = "SELECT * FROM notes";
  //echo 'console.log("'.$sql.'");';
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc()) {
  $newhtml .=  "<tr><td width='20%'><i>".$row['editor']." on</i><br>". date('n/j/y', strtotime($row['ndate'])). "<td width='80%'>".$row['note'];
  }
  $newhtml .=  '</table>"';

}
  ?>
}

function addnote(){

if (document.getElementById('note').value == ""){
document.getElementById('notereq').innerHTML="*required";
}else{
  document.getElementById('notereq').innerHTML="";

$.post("crmdb.php",{
  action: "addnote",
  note: document.getElementById('note').value,
  pid: document.getElementById('pid').value
})  .done(function(){

  var table = document.getElementById("notestable");
  var row = table.insertRow(0);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);

  cell1.innerHTML = "<?php echo "<i>" . ucfirst($_SESSION['uname']) . " on</i><br> " . date('n/j/y'); ?>";
  cell2.innerHTML = document.getElementById('note').value;
  document.getElementById('note').value ="";

  });



}
}

function callnote(){
  if (document.getElementById('callaction').value == 1){
    document.getElementById('note').value = '';
  }
if (document.getElementById('callaction').value == 1){
  <?php echo "document.getElementById('note').value = 'called and spoke at ". date('g:i a')."';";?>
}

if (document.getElementById('callaction').value == 2){
  <?php echo "document.getElementById('note').value = 'called and left voicemail at ". date('g:i a')."';";?>
}

}


$('#prostable').on('click', 'tr', function(){
console.log($(this).attr("data-id"));
//notetable();
var p1=$(this).attr("data-id");
window.location.href=p1;
});

$(document).ready(function(){
  window.print();
  setTimeout(function(){location.replace("/crm/crm.php");}, 1);
//location.replace("/leasing/availablesuites.php");
});

function shownew(){
  document.getElementById('prospectbutton').innerHTML='<button type="button" class="btn btn-blue-grey blue-grey darken-1 btn-md" onclick ="addnew()">Add New Prospect</button>'
$('#DescModal').modal('show');
}

function addnew(){

if (document.getElementById("plan").value==""){
document.getElementById('error').innerHTML="Please Assign a follow up plan."
return;
}
if (document.getElementById("source").value==""){
document.getElementById('error').innerHTML="Please indicate source"
return;
}

$.post("crmdb.php",{
  action: "new",

  fname: document.getElementById("fname").value,
  lname: document.getElementById("lname").value,
  company: document.getElementById("company").value,
  phone: document.getElementById("phone").value,
  cell: document.getElementById("cell").value,
  email: document.getElementById("email").value,
  size: document.getElementById("size").value,
  note: document.getElementById('note').value,
  source: document.getElementById("source").value,
  plan: document.getElementById("plan").value
}).done(function(){ $('#DescModal').modal('hide');});

}


function editdetails(){
  $.post("crmdb.php",{
    action: "update",
    pid: document.getElementById('pid').value,
    fname: document.getElementById("fname").value,
    lname: document.getElementById("lname").value,
    company: document.getElementById("company").value,
    phone: document.getElementById("phone").value,
    cell: document.getElementById("cell").value,
    email: document.getElementById("email").value,
    size: document.getElementById("size").value,
    source: document.getElementById("source").value,
    note: document.getElementById('note').value,
    plan: document.getElementById("plan").value,
    nexttouch: document.getElementById("nextcontact").value
  }).done(function(){ $('#DescModal').modal('hide');});

}


</script>
