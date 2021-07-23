<?php
$a7 = "active";
$access=1;
require_once $_SERVER['DOCUMENT_ROOT']."/includes/loadme.php";
require $_SERVER['DOCUMENT_ROOT']."/includes/nav.php";
require $_SERVER['DOCUMENT_ROOT']."/crm/crmjs.php";
?>


<?php
$conn = new mysqli($servername, $username, $password, 'CandiaCRM');
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
?>

<div style='width: 55%; margin: 10px'>
<table id="recnotes" class="table table-sm">
<tr><th colspan='6' class='table-info'>Upcoming Tours
  <tr><th width="25%">Prospect<th>Tour Date & Time<th>Showed<th>Leased<th>Tour Rating<th>No Show/Interest
<?php
$sql = "SELECT * FROM Tours INNER JOIN Prospects ON Tours.Prospect = Prospects.ID WHERE TourDate >='".date("Y-m-d")."'";

$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$tourdata = explode("|",$row['TourData']);

for ($i=0; $i<3; $i++){
if ($tourdata[$i]==1){$tourdata[$i]='checked';}else{$tourdata[$i]='';}
}
//var_dump($tourdata);
//echo date("Y-m-d", strtotime($row['TourDate']));
if (date("Y-m-d", strtotime($row['TourDate'])) == date("Y-m-d", strtotime("today"))){$tourtoday="class='table-warning'";}else{$tourtoday='';}
?>
      <tr <?php echo $tourtoday?> ><td><?php echo  $row['FName']." ".$row['LName'];?>
      <td><?php echo date("n/j/y g:i a",strtotime($row['TourDate'])); ?>
      <td><center><input type='checkbox' <?php echo $tourdata[0]?>>
      <td><center><input type='checkbox'<?php echo $tourdata[1]?>>
      <td><form class="range-field w-25"><input class="border-0" type="range" min="1" max="5" value = '<?php echo $tourdata[3]?>'/></form>
      <td><center><input type='checkbox'<?php echo $tourdata[2]?>>
<?php
}
echo '</table><br><br><table id="recnotes" class="table table-sm">';
echo "<tr><th class= 'table-info'colspan='6'>Past Tours<tr><th width='25%'>Prospect<th>Tour Date & Time<th>Showed<th>Leased<th>Tour Rating<th>No Show/Interest";
$sql = "SELECT * FROM Tours INNER JOIN Prospects ON Tours.Prospect = Prospects.ID WHERE TourDate <'".date("Y-m-d")."'";
//echo $sql;
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$tourdata = explode("|",$row['TourData']);

for ($i=0; $i<3; $i++){
if ($tourdata[$i]==1){$tourdata[$i]='checked';}else{$tourdata[$i]='';}
}
//var_dump($tourdata);

?>
      <tr ><td><?php echo  $row['FName']." ".$row['LName'];?>
      <td><?php echo date("n/j/y g:i a",strtotime($row['TourDate'])); ?>
      <td><center><input type='checkbox' <?php echo $tourdata[0]?>>
      <td><center><input type='checkbox'<?php echo $tourdata[1]?>>
      <td><form class="range-field w-25"><input class="border-0" type="range" min="1" max="5" value = '<?php echo $tourdata[3]?>'/></form>
      <td><center><input type='checkbox'<?php echo $tourdata[2]?>>
<?php
}
/*while($row = $result->fetch_assoc()) {
  $tr='class="clickytr" data-target="#" data-id="recentnotes.php?q='.$row['ID'].'"';
echo "<tr $tr><td>";
echo $row['FName']." ".$row['LName'];
echo "<td style='white-space: nowrap;'>".date("n-j-y",strtotime($row['ndate']));
echo "<td>";
echo "<b>".$row['editor'].": </b>".$row['note'];
}*/

?>
</tbody>
</table>


<script>
function checkconflict(){
  //var txt = $("input").val();
  $.post("../db/tourdb.php",{
    act: 'conflict',
    tourtime: $( '#tourtime' ).val(),
  },

  function(result){
    $("#conf").html(result);
  });
}
</script>
</html>
