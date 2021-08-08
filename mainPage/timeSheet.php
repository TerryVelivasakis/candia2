<?php require_once $_SERVER["DOCUMENT_ROOT"].'/includes/loadme.php';

?>

<style>
.timeSheetTable tr{
  text-align: center !important;
}

.no-outline {
  border-top-style: hidden;
  border-right-style: hidden;
  border-left-style: hidden;
  border-bottom-style: hidden;

}

.no-outline:focus {
  outline: none;
}
</style>
<script>

function fillTimeSheet(rowID, timeIn = '', timeOut  = '', lunchIn  = '', lunchOut  = '', hours = '', total = false, specialPunch){
if (total){$('#' + rowID).text(hours);} else {
$('#' + rowID).children().eq(2).text(timeIn);
$('#' + rowID).children().eq(3).text(lunchOut);
$('#' + rowID).children().eq(4).text(lunchIn);
$('#' + rowID).children().eq(5).text(timeOut);
$('#' + rowID).children().eq(6).text(hours);
const rowClass = ['', 'table-info', 'table-success', 'table-primary', 'table-warning', 'table-danger'];
if (specialPunch != 0){$('#' + rowID).addClass(rowClass[specialPunch]);}}}

</script>

<center>
<button class='btn btn-primary w-75 mt-2' onclick='punchClock()' id=punchClock>Clock In</button>
</center>
<div class='container table-responsive'>
<table class='table table-sm table-striped timeSheetTable mt-3' id="timeSheetTable">
  <tr><th colspan=2>Date<th>Time In<th>Lunch Start<th>Lunch End<th>Time Out<th>Hours
<?php
$prevMon = abs(strtotime("previous monday"));
$currentDate = abs(strtotime("today"));
$seconds = 86400; //86400 seconds in a day

$dayDiff = ceil( ($currentDate-$prevMon)/$seconds );

if( $dayDiff < 7 )
{
    $dayDiff += 1; //if it's monday the difference will be 0, thus add 1 to it
    $prevMon = strtotime( "previous monday", strtotime("-$dayDiff day") );
}
$weekTotal = 0;
session_start();
$thisWeek = date('Y-m-d',strtotime("monday"));
//$previousFriday = date('Y-m-d',strtotime($comingFriday.' - 11 days'));
for ($x = 0; $x < 7; $x++) {
  $day = strtotime($thisWeek." + $x days");
  if(date('D', $day) != 'Sat' AND date('D', $day) != 'Sun'){
    echo "<tr class='clickable' id ='".date('Ymd',$day)."'><td>".date('D', $day)."<td>".date('n/j', $day);
    echo "<td>-<td>-<td>-<td>-<td>-";
  } else {
    echo "<tr class='clickable' id ='".date('Ymd',$day)."' style = 'display: none;'><td>".date('D', $day)."<td>".date('n/j', $day);
    echo "<td>-<td>-<td>-<td>-<td>-";
  }
}
echo '<tr ><td colspan=5><th> Total<th id="week1Total">';
$lastWeek = date('Y-m-d',strtotime($thisWeek. "- 7 days"));
for ($x = 0; $x < 7; $x++) {
  $day = strtotime($lastWeek." + $x days");
  if(date('D', $day) != 'Sat' AND date('D', $day) != 'Sun'){
    echo "<tr class='clickable' id ='".date('Ymd',$day)."'><td>".date('D', $day)."<td>".date('n/j', $day);
    echo "<td>-<td>-<td>-<td>-<td>-";
  }else {
    echo "<tr class='clickable' id ='".date('Ymd',$day)."' style = 'display: none;'><td>".date('D', $day)."<td>".date('n/j', $day);
    echo "<td>-<td>-<td>-<td>-<td>-";
  }
}
echo '<tr><td colspan=5><th> Total<th id="week2Total">';
?>
</table>
</div>


<div class="modal" id='modalTimeAdjust'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Request Time Adjustment for <span id='dateForChange'></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick ='$("#modalTimeAdjust").hide()'>
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <table class='timeSheetTable table-bordered'>
          <tr><th>Time In<th>Lunch Start<th>Lunch End<th>Time Out
          <tr><td><input class='no-outline' type=time id = newTimeIn />
            <td><input class='no-outline' type=time id = newLunchOut />
              <td><input class='no-outline' type=time id = newLunchIn />
                <td><input class='no-outline' type=time id = newTimeOut />
          </table>
          <input type='hidden' id='rowIndex' />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick='requestChange()'>Request Changes</button>
        <button type="button" class="btn btn-secondary" onclick ='$("#modalTimeAdjust").hide()'>Close</button>
      </div>
    </div>
  </div>



</div>


<script>

function convertTo24hr(time){
  var d = new Date("12/03/1980 " + time);
  foo = d.getHours().toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping: false});
  bar = d.getMinutes().toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping: false});
  return foo + ':' + bar;
}

$('#timeSheetTable .clickable').click(function(){
const timesheetedits =['','', '#newTimeIn','#newLunchOut', '#newLunchIn', '#newTimeOut'];
$('#dateForChange').text($(this).children().eq(1).text());
$('#rowIndex').val($(this).index());
for (let i = 2; i <= 5; i++) {

  if ($(this).children().eq(i).text() != '-'){
    $(timesheetedits[i]).val(convertTo24hr($(this).children().eq(i).text()));
  } else {
    $(timesheetedits[i]).val('');
}
}
$("#modalTimeAdjust").show();

});

function requestChange(){
  requestedChange = {
   action: 'change',
   newTimeIn: $('#newTimeIn').val(),
   newLunchOut: $('#newLunchOut').val(),
   newLunchIn: $('#newLunchIn').val(),
   newTimeOut: $('#newTimeOut').val(),
   date: $('#dateForChange').text()
 };

  var jqxhr = $.post( '/dbFunctions/dbTimeClock.php', requestedChange, function() {
    //alert( "success" );
  })
    .done(function(data) {
      if (data == '1'){
        $('#timeSheetTable tr').eq($('#rowIndex').val()).addClass('table-warning');
        $("#modalTimeAdjust").hide();

      }else{
        alert('There is a Problem');
      }
    })
    .fail(function() {
      alert( "error" );
    })
    .always(function() {
    //  alert( "finished" );
    });


}

<?php
session_start();
$enddate = date("Y-m-d",strtotime($thisWeek. '+ 7 days'));
$sql = "SELECT * FROM `TimeClock` WHERE ClockDay BETWEEN '".date("Y-m-d",strtotime($enddate .' - 14 days'))."' AND '".date("Y-m-d",strtotime($enddate))."' AND `employeeID` = ". $_SESSION['empID'] ." ORDER BY ClockDay DESC";
echo "console.log(\"$sql\");";

$query = $hrDB -> query($sql);
$weeklyHours[0] = 0;
$weeklyHours[1] = 0;
$week1 = date("W",strtotime($thisWeek));
  while($row = $query->fetch_assoc()) {
    $checkForChange = 'SELECT * FROM `TimeClockChanges` WHERE ClockDay = "'.$row['ClockDay'].'" AND employeeID = '.$_SESSION['empID'];
    $result = $hrDB->query($checkForChange);
    if ($result->num_rows > 0) {
      $rowClass= '4';
    }elseif ($row['punchtype'] == ''){
      $rowClass=0;
    } else {
      $rowClass=$row['punchtype'];
    }
    $day = date('D', strtotime ($row['ClockDay']));

    $rowID = date("Ymd", strtotime($row['ClockDay']));
    if ($row['TimeIn'] == '00:00:00'){$timeIn='-';}else{$timeIn = date("g:i a",strtotime($row['TimeIn']));}
    if ($row['LunchOut'] == '00:00:00'){$lunchOut='-';}else{$lunchOut = date("g:i a",strtotime($row['LunchOut']));}
    if ($row['LunchIn'] == '00:00:00'){$lunchIn='-';}else{$lunchIn = date("g:i a",strtotime($row['LunchIn']));}
    if ($row['TimeOut'] == '00:00:00'){$timeOut='-';}else{$timeOut = date("g:i a",strtotime($row['TimeOut']));}
    if ($timeIn == '-' OR $timeOut == '-' OR $lunchIn == '-' OR $lunchOut == '-'){
      $echohours = '-';
      $hours=0;}else{
    $hours = number_format(((strtotime($row['TimeOut']) - strtotime($row['TimeIn'])) - (strtotime($row['LunchIn']) - strtotime($row['LunchOut'])))/3600,2);
    $echohours = $hours;}

    if ($week1 == date("W", strtotime($row['ClockDay']))){ $weeklyHours[0] += $hours;}else{ $weeklyHours[1] += $hours;}

    if ($day == "Sat" OR $day == "Sun"){

      if ( $row['TimeIn'] != '00:00:00'){
        echo "$('#$rowID').show();";
    }}
    echo "console.log('$rowID: hours: $hours week1 $week1: $weeklyHours[0] week2: $weeklyHours[2]' );";
    Echo "fillTimeSheet('$rowID','$timeIn', '$timeOut', '$lunchIn', '$lunchOut', '$echohours', false, $rowClass);";
}
    Echo "fillTimeSheet('week1Total','', '', '', '', '$weeklyHours[0]', true, '');";
    Echo "fillTimeSheet('week2Total','', '', '', '', '$weeklyHours[1]', true, '');";
?>

function punchClock(){
  d = new Date();
  datestring = (d.getFullYear()+ ("0"+(d.getMonth()+1)).slice(-2) + ("0" + d.getDate()).slice(-2));
  var actions = $('#punchClock').data('punchaction');
  if (actions == 'clockin'){i=2;}
  if (actions == 'lunchout'){i=3;}
  if (actions == 'lunchin'){i=4;}
  if (actions == 'clockout'){i=5;}
  $('#' + datestring).children().eq(i).text(document.getElementById("clock").innerText);
  $('#' + datestring).show();

var jqxhr = $.post( '/dbFunctions/dbTimeClock.php', {action: actions}, function(){})
  .done(function(data){

    if (data == '1'){
      $('#' + datestring).children().eq(i).text(document.getElementById("clock").innerText);
      $('#' + datestring).show();
      changePunchAction(actions);
    } else {console.log(data);}
  })
  .fail(function() {
    alert( "error" );
  })
  .always(function() {
  //  alert( "finished" );
  });

}

function changePunchAction(currentAction = 'new'){
if (currentAction == 'new'){$('#punchClock').data('punchaction','clockin');$('#punchClock').text('Clock In');}
if (currentAction == 'clockin'){$('#punchClock').data('punchaction','lunchout');$('#punchClock').text('Begin Lunch Break');}
if (currentAction == 'lunchout'){$('#punchClock').data('punchaction','lunchin');$('#punchClock').text('End Lunch Break');}
if (currentAction == 'lunchin'){$('#punchClock').data('punchaction','clockout');$('#punchClock').text('Clock Out');}
if (currentAction == 'clockout'){$('#punchClock').prop("disabled",true);}
}


<?php
$sql = "SELECT * FROM `TimeClock` WHERE ClockDay = '".date("Y-m-d")."' AND `employeeID` = ". $_SESSION['empID'];
$results = $hrDB->query($sql);
if ($results->num_rows > 0){
while($row = $results->fetch_assoc()) {
  if ($row['TimeOut'] != '00:00:00'){$action = 'clockout';}
  if ($row['TimeOut'] == '00:00:00'){$action = 'lunchin';}
  if ($row['LunchIn'] == '00:00:00'){$action = 'lunchout';}
  if ($row['LunchOut'] == '00:00:00'){$action = 'clockin';}
}
}else{$action ='new';}
echo "changePunchAction('$action');";

?>
//changePunchAction();

</script>
