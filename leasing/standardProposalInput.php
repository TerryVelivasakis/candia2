<?php
require $_SERVER["DOCUMENT_ROOT"].'includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';
require $_SERVER["DOCUMENT_ROOT"].'php+js/functExecutiveLease.php';
session_start();
?>
<link rel="stylesheet" href="\style\forms.css">
<body>



  <div class="modal" id='suitesModal'>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Select Suite(s)</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="suitesModalAction('hide')">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
  <label for="exampleSelect2" class="form-label mt-4">Example multiple select</label>
  <select multiple="" class="form-select" id="suiteSelect">
<?php
$query = "SELECT * FROM `executiveSuites` WHERE `BuildingID` = ".$_SESSION['property']." ORDER BY `SuiteNumber` ASC ";

$execSuites = $db->query($query);

while($suite = $execSuites->fetch_assoc()) {
$sqft= $suite['SqFt'];
$suiteNum = $suite['SuiteNumber'];
echo "<option value ='$suiteNum:$sqft'>$suiteNum</option>";
}
//*/
?>
  </select>
</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick='suitesModalAction("save")'>Save changes</button>
        </div>
      </div>
    </div>
  </div>





<div class="container mt-2">

  <div class="alert alert-dismissible" id="leaseWarning" style="display: none">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <p class="mb-0" id="leaseWarningText">Best check yo self, you're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna.</p>
  </div>

<div class = row>
  <div class=col-7> Prospect Name: <input class="form-control" id = 'prospectName'></div>
</div><div class = row>
<div class=col-7> Company Name: <input class="form-control" id = 'prospectName'></div>
</div>
<div class = row>
<div class="form-group col-2">
  <label for="moveInDate" class="form-label">Move In Date</label>
  <div class="input-group date">
    <input type="text" class="form-control" id="moveInDate" value=<?php echo date("m/d/Y",strtotime("first day of next month"));?>>
  </div>
</div>
<div class="form-group col-2">
  <label for="moveInDate" class="form-label" onclick=>Suite(s)</label>
  <div class="input-group">
    <input type="text" class="form-control" id="suites" readonly="" onclick='suitesModalAction("show")'>
  </div>
</div>
<div class="form-group col-2">
  <label for="moveInDate" class="form-label" onclick=>Total Square Feet</label>
  <div class="input-group">
    <input class="form-control" id="sqftText" type="text" placeholder="" readonly="">
  </div>
</div>
<div class=w75>
<table class=table>

<tr><th>Months<th>Rent<th>PSF<th>Increase<th>By
<tr>

</table>
</div>
</div>
<script>

function suitesModalAction(action){
if (action == 'show'){$("#suitesModal").show();}
if (action == 'hide'){$("#suitesModal").hide();}
if (action == 'save'){
bar = $('#suiteSelect').val();
area = 0;
suites = "";
for (var i = 0; i < bar.length; i++) {
    x = bar[i];
    y=x.split(":");
    suites = suites + y[0]+", ";
    console.log(y[1]);
    area = area +parseInt(y[1]);
}
$('#suites').val(suites.slice(0,-2));
$('#sqftText').val(area);
$("#suitesModal").hide();
}
}

$(document).ready(function(){
  $('#moveInDate').datepicker({startDate: 0,autoclose: true});
});
</script>
