<?php
require_once $_SERVER["DOCUMENT_ROOT"].'includes/loadme.php';
require_once $_SERVER['DOCUMENT_ROOT']."/includes/nav.php";

$sql = "SELECT userName, StaffID FROM Staff";
$query = $hrDB -> query($sql);
while($row = $query->fetch_assoc()) {
$name[$row['StaffID']]=ucfirst($row['userName']);
}

$endDate = strtotime('previous friday');
$startDate = date('Y-m-d',$endDate);
$startDate = strtotime('-11 days ', strtotime($startDate) );
?>

<div class=container>

<h5>Pay Cycle <?php  echo date('F jS',$startDate)." - ".date('F jS',$endDate);?></h5>
<div class=w-25>
<table class='table table-striped timeSheetTable' id="timeSheetTable">
  <tr><th>Employee<th>Regular<th>Overtime

<?php
$sql = "SELECT StaffID FROM Staff WHERE hourly=1";
$query = $hrDB -> query($sql);
while($row = $query->fetch_assoc()) {
  $clockSQL = 'SELECT * FROM TimeClock WHERE employeeId = '.$row['StaffID']." AND ClockDay BETWEEN ".date("'Y-m-d'",$startDate)." AND ".date("'Y-m-d'",$endDate)." ORDER BY ClockDay DESC";
  $result = $hrDB -> query($clockSQL);
  $totalHours = 0; $regular = 0; $overtime = 0;

  while($punch = $result->fetch_assoc()) {
    $hours = ((strtotime($punch['TimeOut']) - strtotime($punch['TimeIn'])) - (strtotime($punch['LunchIn']) - strtotime($punch['LunchOut'])))/3600;
    $totalHours += $hours;
    if (date('D',strtotime($punch['ClockDay'])) == 'Mon'){
      if ($totalHours > 40){$regular += 40; $overtime += $totalHours - 40;}else{$regular += $totalHours;}
      $totalHours = 0;}
  }
  echo "<tr><td>".$name[$row['StaffID']]."<td>".number_format($regular,2)."<td>".number_format($overtime,2);
}
?>

</table>
</div>
<hr/>
<h5>Time Sheet Adjustments</h5>
<table class='table table-sm table-striped timeSheetTable' id="timeSheetTable">
  <tr><th>Employee<th>Date<th>Time In<th>Lunch Start<th>Lunch End<th>Time Out<th>Action
<?php

$sql = "SELECT userName, StaffID FROM Staff";
//echo "<tr><td>".$sql;
$query = $hrDB -> query($sql);
while($row = $query->fetch_assoc()) {
$name[$row['StaffID']]=ucfirst($row['userName']);
}

    $sql = "SELECT * FROM `TimeClockChanges` INNER JOIN `TimeClock` ON TimeClock.ClockDay = TimeClockChanges.ClockDay AND TimeClock.employeeID = TimeClockChanges.employeeID";
//echo "<tr><td>".$sql;
    $query = $hrDB -> query($sql);
    while($row = $query->fetch_assoc()) {
    echo "<tr><td>".$name[$row['employeeID']];
    echo "<td>".date('n/j', strtotime($row['ClockDay']));
if ( date('g:i a',strtotime($row['TimeIn'])) == date('g:i a',strtotime($row['newTimeIn']))){echo '<td>';} else {echo "<td>".date('g:i a',strtotime($row['TimeIn'])) ." <i class='fas fa-arrow-right'></i> ". date('g:i a',strtotime($row['newTimeIn']));}

if ( date('g:i a',strtotime($row['LunchOut'])) == date('g:i a',strtotime($row['newLunchOut']))){echo '<td>';} else {echo "<td>".date('g:i a',strtotime($row['LunchOut'])) ." <i class='fas fa-arrow-right'></i> ". date('g:i a',strtotime($row['newLunchOut']));}

if ( date('g:i a',strtotime($row['LunchIn'])) == date('g:i a',strtotime($row['newLunchIn']))){echo '<td>';} else {echo "<td>".date('g:i a',strtotime($row['LunchIn'])) ." <i class='fas fa-arrow-right'></i> ". date('g:i a',strtotime($row['newLunchIn']));}

if ( date('g:i a',strtotime($row['TimeOut'])) == date('g:i a',strtotime($row['newTimeOut']))){echo '<td>';} else {echo "<td>".date('g:i a',strtotime($row['TimeOut'])) ." <i class='fas fa-arrow-right'></i> ". date('g:i a',strtotime($row['newTimeOut']));}


echo "<td><button class='btn btn-sm btn-primary' onclick='changeTimeHR(\"approveChange\",".$row['changeID'].")'>Approve</button>  ";
echo "<button class='btn btn-sm btn-secondary' onclick='changeTimeHR(\"denyChange\",".$row['changeID'].")'>Deny</button>";
}
?>
</table>

</div>


<script>
function changeTimeHR(action, id){
  requestedChange = {
   action: action,
   changeID: id
 };

  var jqxhr = $.post( '/dbFunctions/dbTimeClock.php', requestedChange)
    .done(function(data) {
        location.reload(); 
    })
    .fail(function() {
      alert( "error" );
    });

}


</script>
