
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="http://10.10.20.130/src/jquery.fittext.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<select id="selector">
  <option value="0"> New Tenant Listing</option>



<?php
echo '<script>';
echo 'console.log("'.$_GET["foo"].'");';
echo '</script>';
include $_SERVER['DOCUMENT_ROOT']."/includes/dirconfig.php";

$dbname = "WBdirectory";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = mysqli_query($conn, "SELECT * FROM `Tenants` ORDER BY `Line1`");

while($row = mysqli_fetch_array($result)) {
if ($row['ID']==$_GET["foo"]){
echo '<option value="'.$row['ID'].'" selected="selected"> '.$row['Line1'].'</option>';
}else{
  echo '<option value="'.$row['ID'].'" > '.$row['Line1'].'</option>';

}
}

$result = mysqli_query($conn, "SELECT * FROM `Tenants` WHERE ID=".$_GET["foo"]);

while($row = mysqli_fetch_array($result)) {
$suite = $row['Suite'];
$line1 = $row['Line1'];
$line2 = $row['Line2'];
}

echo '</select>';
echo '<table>';
  echo '<tr><td>Suite<td>Tenant Info';
  echo '<tr>';
echo '<td style="vertical-align:top"><input type="text" id="suite" size="5" value="'.$suite.'"></input>';
  echo '<td>';
echo '<input type="text" id="Line1" size="45" value="'.$line1.'"></input><br>';
echo '&nbsp &nbsp<input type="text" size="43.5" id="Line2" value="'.$line2.'"></input>';
echo '</table>';


?>
<button onclick='updater()'>Update Tenant Listing</button>
<button onclick='deleter()'>Delete Tenant Listing</button>


<script>
$('select').on('change', function() {
window.location = "tenedit.php?foo="+document.getElementById('selector').value;
});


function updater() {
  $.post("teneditor.php", {
   tenid: document.getElementById('selector').value,
   suite: document.getElementById('suite').value,
   line1: document.getElementById('Line1').value,
   line2: document.getElementById('Line2').value
 })
 .done(function( data ) {
   alert( data);
window.location = "tenedit.php?foo="+document.getElementById('selector').value;
 });
}

function deleter() {

var answer = confirm("Are you sure you want to delete?")

if (answer) {
  $.post("teneditor.php", {
   tenid: document.getElementById('selector').value,
   delete: 1,
 })
 .done(function( data ) {
   alert( data);
  location.reload();
 });
}
else {
    //some code
}
}
</script>
