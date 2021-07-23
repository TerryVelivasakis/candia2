<?php
require_once $_SERVER["DOCUMENT_ROOT"].'includes/loadme.php';
require_once $_SERVER['DOCUMENT_ROOT']."/includes/nav.php";
require_once $_SERVER['DOCUMENT_ROOT']."/crm/crmjs.php";
?>


<div class='container'>
<button class="btn btn-primary m-2" onclick="shownew();">Add New Prospect</button>

<div class="table-responsive-sm" style="">

    <table cellpadding="1" cellspacing="0" class="table table-sm table-bordered table-striped" id="prostable">
    <thead>
    <th>Name</th>
    <th>Phone/Cell</th>
    <th>Email</th>
    <th>Plan</th>
    <th>Source</th>
    <th>Date Added</th>
    <th>Last Contact</th>
    </tr>
    </thead>

<tbody>
  <?php
  $source[1]="Craigslist";
  $source[2]="801 Website";
  $source[3]="Refferal Service";
  $source[4]="Loopnet";
  $source[5]="Google";
  $source[6]="Word of Mouth";
  $source[7]="Other/Unknown";
  $sql = "SELECT * FROM PlanNames";
  $result = $crmDB->query($sql);
  while($row = $result->fetch_assoc()) {
  $planname[$row['PlanID']]=$row['PlanName'];
  }


  $sql = "SELECT * FROM Prospects";
  $result = $crmDB->query($sql);
  while($row = $result->fetch_assoc()) {

  $hr = '<hr style="height:1px; border:none; color:#DCDCDC; background-color:#DCDCDC; width:100%; text-align:center; margin: 0 auto;">';

  echo '<tr class="clickable" data-target="#" data-id="'.$row['ID'].'">';
  echo '<td>'.$row['FName']." ".$row['LName'];
  echo '<td> <i>ph - </i>'.$row['Phone']." ".$hr."<i>c - </i>". $row['cell'];
  echo '<td>'.$row['email'];
  echo '<td>'.$planname[$row['plannumber']];
  echo '<td>'.$source[$row['source']];
  echo '<td data-order="'.strtotime($row['pdate']).'">'.date("n/j/Y",strtotime($row['pdate']));
  echo '<td data-order="'.strtotime($row['lastcontact']).'">'.date("n/j/Y",strtotime($row['lastcontact']));
  }
  ?>
</table>

</div>
<script>

$(document).ready( function () {
    $('#prostable').DataTable({"order": [[ 5, "desc" ]]});
} );


$('#prostable tbody').on('click', 'tr', function(){
  q = $(this).data('id');
  $('#modalLoad').load('/crm/crmModal.php?q='+q);
  $("#DescModal").modal("show");
});
</script>
</html>
