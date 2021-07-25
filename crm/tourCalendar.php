<?php
require $_SERVER["DOCUMENT_ROOT"].'includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';
//require $_SERVER["DOCUMENT_ROOT"].'php+js/executiveLease.php';
require $_SERVER["DOCUMENT_ROOT"].'crm/crmjs.php';
?>
<div class = container>
<table class="table table-bordered">

  <tr><th>
    <?php
    for ($x = 0; $x < 7; $x++) {
  echo "<th><center>".date('l n/j',strtotime('today + '.$x.' days'));
  }
  for ($x = 0; $x <= 16; $x++) {
    if ($x < 2 or $x > 10){$tableClass = 'class=table-secondary';}else{$tableClass='';}
echo "<tr><th $tableClass >".date('g:i a',strtotime('9:00AM +'.$x*30 .' minutes'));
for ($i = 0; $i < 7; $i++) {
  $cellID = date('Ymd',strtotime('today + '.$i.' days')).date('Hi',strtotime('9:00AM +'.$x*30 .' minutes'));
echo "<td id='$cellID'>";
}

}

    ?>

</table>
</div>
<script>

<?php
$startDate = date('Y-m-d');
$endDate = date('Y-m-d', strtotime('today + 6 days'));
$Query = "SELECT * FROM `Tours` JOIN `Prospects` ON Prospects.ID = Tours.Prospect WHERE `TourDate` BETWEEN '$startDate 00:00:00' AND '$endDate 23:59:59'";

$tours = $crmDB->query($Query);
while($row = $tours->fetch_assoc()) {
  $prospect = $row['FName']." ".$row['LName'];
  $timepin = date('YmdHi', strtotime($row['TourDate']));
  echo "$('#$timepin').html('$prospect');";
  echo "$('#$timepin').data('prospectid','".$row['ID']."');";
  echo "$('#$timepin').addClass('table-info');";
  echo "$('#$timepin').addClass('clickable');";

}
?>

$('.clickable').on('click', function(){
  q = $(this).data('prospectid');
  console.log('q = ' + q);
  $('#modalLoad').load('/crm/crmModal.php?q='+q);
  $("#DescModal").modal("show");
});

</script>
