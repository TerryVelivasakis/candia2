<?php
$a7 = "active";
$access=1;
require_once $_SERVER['DOCUMENT_ROOT']."/includes/config.php";
require $_SERVER['DOCUMENT_ROOT']."/includes/nav.php";
require $_SERVER['DOCUMENT_ROOT']."/crm/crmjs.php";
?>


<?php
$conn = new mysqli($servername, $username, $password, 'CandiaCRM');
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

$tendaysago=date("Y-m-d",strtotime('10 days ago'));

$sql = "SELECT * FROM notes INNER JOIN Prospects ON notes.prospect = Prospects.ID WHERE ndate > '".$tendaysago."' ORDER BY ndate desc";
$result = $conn->query($sql);
?>
<table id="recnotes" class="table">
  <tr><td width="15%">Prospect<td>Date<td>Note
    <tbody>
<?php


while($row = $result->fetch_assoc()) {
  $tr='class="clickytr" data-target="#" data-id="recentnotes.php?q='.$row['ID'].'"';
echo "<tr $tr><td>";
echo $row['FName']." ".$row['LName'];
echo "<td style='white-space: nowrap;'>".date("n-j-y",strtotime($row['ndate']));
echo "<td>";
echo "<b>".$row['editor'].": </b>".$row['note'];


}
?>
</tbody>
</table>


<script>

$('#DescModal').on('hidden.bs.modal', function () {
    window.location.href="recentnotes.php";
});

$('#recnotes tbody').on('click', 'tr', function(){
var p1=$(this).attr("data-id");
window.location.href=p1;
});
</script>
</html>
