<?php
require_once $_SERVER["DOCUMENT_ROOT"].'includes/loadme.php';
require_once $_SERVER['DOCUMENT_ROOT']."/includes/nav.php";
//function timeorDash($time){}
$sql = "SELECT userName, StaffID FROM Staff";
$query = $hrDB -> query($sql);
while($row = $query->fetch_assoc()) {
$name[$row['StaffID']]=ucfirst($row['userName']);
}

$endDate = strtotime('previous friday');
$startDate = date('Y-m-d',$endDate);
$startDate = strtotime('-11 days ', strtotime($startDate) );
?>

<div class='container mt-2 w-75'>
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-bs-toggle="tab" href="#hours">Payroll Hours</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#adjustments">Payroll Adjustments</a>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Time Sheets</a>
      <div class="dropdown-menu">
        <?php
        $sql = "SELECT StaffID FROM Staff WHERE hourly=1";
        $query = $hrDB -> query($sql);
        while($row = $query->fetch_assoc()) {
        echo '<a class="dropdown-item" data-bs-toggle="tab" href="#'.$name[$row['StaffID']].'TimeSheet">'.$name[$row['StaffID']].'</a>';}
        ?>

      </div>
    </li>
  </ul>

<div id="myTabContent" class="tab-content mt-3">
<div class="tab-pane fade show active" id="hours">
<h5 class=mt-2>Pay Cycle <?php  echo date('F jS',$startDate)." - ".date('F jS',$endDate);?></h5>
<div class=w-50>
<table class='table table-striped timeSheetTable ' id="timeSheetOverviewTable">
  <thead>
  <tr><th>Employee<th>Regular<th>Overtime
</thead><tbody>
<?php
/*
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
  echo "<tr class='empTimeTotal'><td>".$name[$row['StaffID']]."<td>".number_format($regular,2)."<td>".number_format($overtime,2);
}*/
?>
</tbody>
</table>
</div>
<button onclick='tablestuff()'>click me</button>

<script>

</script>
</div>

  <div class="tab-pane fade" id="adjustments">
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
    echo "<tr id='changerow".$row['changeID']."'><td>".$name[$row['employeeID']];
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
<?php

$sql = "SELECT StaffID FROM Staff WHERE hourly=1";
$query = $hrDB -> query($sql);
while($row = $query->fetch_assoc()) {
  $clockSQL = 'SELECT * FROM TimeClock WHERE employeeId = '.$row['StaffID']." AND ClockDay >= ".date("'Y-m-d'",$startDate)." ORDER BY ClockDay ASC";

  $result = $hrDB -> query($clockSQL);
 echo '<div class="tab-pane fade" id="'.$name[$row['StaffID']].'TimeSheet">';
echo '<h5 class="mt-2">'.$name[$row['StaffID']].'\'s Timesheet</h5>';
echo '<table class="table table-striped mt-2">';
echo '<tr><th>Date<th>Time In<th>Lunch Start<th>Lunch End<th>Time Out<th>Hours</tr>';


  while($punch = $result->fetch_assoc()) {

  $hours = ((strtotime($punch['TimeOut']) - strtotime($punch['TimeIn'])) - (strtotime($punch['LunchIn']) - strtotime($punch['LunchOut'])))/3600;
    if ($punch['ClockDay'] == date("Y-m-d",$endDate)){echo '<tr><th colspan = 6>Current Week';}
    echo '<tr class="clickable timesheetdetail" id = "timeclock'.$punch['punchID'].'"><td>'.date('D n/j',strtotime($punch['ClockDay']));
    echo '<td>'; if ($punch['TimeIn'] == '00:00:00'){  echo '-';}else{echo date('g:i a',strtotime($punch['TimeIn']));}
    echo '<td>'; if ($punch['LunchOut']== '00:00:00'){  echo '-';}else{echo date('g:i a',strtotime($punch['LunchOut']));}
    echo '<td>'; if ($punch['LunchIn']== '00:00:00'){  echo '-';}else{echo date('g:i a',strtotime($punch['LunchIn']));}
    echo '<td>'; if ($punch['TimeOut']== '00:00:00'){  echo '-';}else{echo date('g:i a',strtotime($punch['TimeOut']));}
    echo '<td>'.number_format($hours,2);
  }

  echo '</table></div>';
}
?>

<div class="modal" id='modalTimeAdjust'>
  <input type=hidden id=punchid>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Adjustment Time for <span id='dateForChange'></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick ='$("#modalTimeAdjust").hide()'>
          <span aria-hidden="true"></span>
        </button>





      </div>
      <div class="modal-body">
        <div class="alert alert-dismissible alert-warning" id='editWarning'>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          <h4 class="alert-heading" >Warning!</h4>
          <p class="mb-0" id='editWarningText'></p>
        </div>
        <table class='timeSheetTable table-bordered'>
          <tr><th>Time In<th>Lunch Start<th>Lunch End<th>Time Out
          <tr><td><input class='no-outline' type=time id = TimeIn />
            <td><input class='no-outline' type=time id = LunchOut />
              <td><input class='no-outline' type=time id = LunchIn />
                <td><input class='no-outline' type=time id = TimeOut />
          </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick='saveChange()'>Save Changes</button>
        <button type="button" class="btn btn-secondary" onclick ='$("#modalTimeAdjust").hide()'>Close</button>
      </div>
    </div>
  </div>

</div>

<script>
function changeTimeHR(action, id){
  requestedChange = {
   action: action,
   changeID: id
 };

  var jqxhr = $.post( '/dbFunctions/dbTimeClock.php', requestedChange)
    .done(function(data) {
        //location.reload(); // replace with DOM code yah hoser
        $('#changerow'+id).hide();
    })
    .fail(function() {
      alert( "error" );
    });

}
$('.clickable, .timesheetdetail').click(function(){
  $('#editWarning').hide();
  foo = $(this).attr('id').replace('timeclock', '');
$('#punchid').val(foo);
bar = $(this).closest('tr').find('td:first').text();
$('#dateForChange').text(bar);
editAJAX = {action: 'HRajax', punchID: foo};
var jqxhr = $.post( '/dbFunctions/dbTimeClock.php', editAJAX)
  .done(function(data) {
    ajaxdata = JSON.parse(data);

    $('#TimeIn').val(ajaxdata.TimeIn.substr(0,5));
    $('#TimeOut').val(ajaxdata.TimeOut.substr(0,5));
    $('#LunchIn').val(ajaxdata.LunchIn.substr(0,5));
    $('#LunchOut').val(ajaxdata.LunchOut.substr(0,5));
  });
$("#modalTimeAdjust").show();
});

function saveChange() {
editAJAX = {action: 'HRedit', punchID: $('#punchid').val(), TimeIn:$('#TimeIn').val()+':00' , TimeOut:$('#TimeOut').val()+':00' , LunchIn:$('#LunchIn').val()+':00' , LunchOut:$('#LunchOut').val()+':00' };

var jqxhr = $.post( '/dbFunctions/dbTimeClock.php', editAJAX)
  .done(function(data) {
    data = data.split('|');
    if (data[0] == 'gtg'){
      fillOverviewTable();
      $("#modalTimeAdjust").hide();

  }else{
    $('#editWarningText').html(data);
    $('#editWarning').show();

  }
  });

}

function fillOverviewTable(){
$('.empTimeTotal').remove();
requestedChange = {
 action: 'HRoverview',
 startDate: <?php echo $startDate;?>,
 endDate: <?php echo $endDate;?>
};

var jqxhr = $.post( '/dbFunctions/dbTimeClock.php', requestedChange)
  .done(function(data) {
    console.log(data);
    if (data !=''){
    foo = JSON.parse(data);
    for (const [key, value] of Object.entries(foo)) {
      $('#timeSheetOverviewTable > tbody:last-child').append(`${value}`);
    console.log(`${value}`);
}
//$('#timeSheetTable > tbody:last-child').append('<tr class="empTimeTotal"><td>jeff<td>80.00<td>0.24</tr>');
}});
}
fillOverviewTable();
</script>
