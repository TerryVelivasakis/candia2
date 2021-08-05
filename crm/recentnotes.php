<?php
$a7 = "active";
$access=1;
require_once $_SERVER['DOCUMENT_ROOT']."/includes/loadme.php";
require $_SERVER['DOCUMENT_ROOT']."/includes/nav.php";
require $_SERVER['DOCUMENT_ROOT']."/crm/crmjs.php";

?>


<?php


$tendaysago=date("Y-m-d",strtotime('10 days ago'));

$sql = "SELECT * FROM notes INNER JOIN Prospects ON notes.prospect = Prospects.ID WHERE ndate > '".$tendaysago."' ORDER BY ndate desc";
$result = $crmDB->query($sql);
?>
<div class=container>
<table id="recnotes" class="table">
  <tr><td width="15%">Prospect<td>Date<td>Note
    <tbody>
<?php


while($row = $result->fetch_assoc()) {
  $tr='class="clickable" data-target="#" data-id="'.$row['ID'].'"';
echo "<tr $tr><td>";
echo $row['FName']." ".$row['LName'];
echo "<td style='white-space: nowrap;'>".date("M j",strtotime($row['ndate']));
echo "<td>";
echo "<b>".$row['editor'].": </b>".$row['note'];


}
?>
</tbody>
</table>


<script>

$('#DescModal').on('hidden.bs.modal', function () {

});

$('#recnotes tbody').on('click', 'tr', function(){
  q = $(this).data('id');
  $('#modalLoad').load('/crm/crmModal.php?q='+q);
  $("#DescModal").modal("show");
});
</script>
</html>
