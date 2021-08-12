<?php
require $_SERVER["DOCUMENT_ROOT"].'/includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';
?>
<div class='container mt-2'>
  <fieldset class="">
    <div class='row'>
        <legend>Property</legend>
        <div class=col-auto>
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input qsProperty" name="qsProperty" id="optionsRadios1" value="all" checked="">
            All Properties
          </label>
        </div>
      </div>
<?php

$sql = "SELECT * FROM `property`";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
  $foo = $row['propertyNickname'];
  $propertyName[$row['propertyID']]=$foo;
echo '<div class=col-auto><div class="form-check">';
  echo '<label class="form-check-label">';
  echo '<input type="radio" class="form-check-input qsProperty" name="qsProperty" id="options'.$foo.'" value="'.$foo.'">';
  echo $foo.'</label>';
echo '</div></div>';
}

 ?>
</div>
</fieldset>
<hr>
<table class='table table-striped mt-2' id='contactTable'>
<thead>
  <tr class='table-info'>
    <th>Suite</th>
    <th>Name</th>
    <th>Company</th>
    <th>Phone</th>
    <th>Cell</th>
    <th>Email</th>
    <th>Property</th>
  </tr>
</thead>
<tbody>
<?php

$sql = "SELECT * FROM `property`";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
  $property[$row['propertyID']] = $row['propertyNickname'];
}
$sql = "SELECT * FROM `executiveLease`";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
  if ($row['status'] == 0){ $suite = 'Past';}else {$suite = $row['suiteNumber'];}
echo '<tr class="clickable"
data-sqltable="executiveLease"
data-contactID="'.$row['leaseID'].'"
data-tenantname = "'.$row['tenantName'].'"
data-property = "'.$property[$row['Property']].'"
data-steNum = "'.$suite.'">';

echo '<td>'.$suite.'</td>';
echo '<td>'.$row['contactName'].'</td>';
echo '<td>'.$row['tenantName'].'</td>';
echo '<td>'.$row['contactPhone'].'</td>';
echo '<td>'.$row['contactCell'].'</td>';
echo '<td><a href="mailto:'.$row['contactEmail'].'">'.$row['contactEmail'].'</a></td>';
echo '<td>'.$property[$row['Property']].'</td>';
}

$sql = "SELECT * FROM `tenantContacts` JOIN executiveLease ON tenantContacts.leaseID = executiveLease.leaseID";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
echo '<tr class="clickable" data-sqltable="tenantContacts" data-contactID="'.$row['contactID'].'">';
if ($row['status'] == 0){ $suite = 'Past';}else {$suite = $row['suiteNumber'];}
echo '<td>'.$suite.'</td>';
echo '<td>'.$row['addContactName'].'</td>';
echo '<td>'.$row['tenantName'].'</td>';
echo '<td>'.$row['addPhone'].'</td>';
echo '<td>'.$row['addCell'].'</td>';
echo '<td><a href="'.$row['addEmail'].'">'.$row['addEmail'].'</a></td>';
echo '<td>'.$property[$row['Property']].'</td>';
}


 ?>
</tbody>
</table>


<div class="modal " id='modalContactDetails'>
  <input type="hidden" id=tenantID>
  <input type="hidden" id="companyName">
  <input type="hidden" id="propertyName">
  <input type="hidden" id="steNum">
  <input type="hidden" id="sqltablename">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class='modal-title'><h5 id='ContactName'>Modal title</h5>
          <h6 id='CompanyName'></h6></div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="$('#modalContactDetails').hide();">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body px-3">
          <div class="alert alert-dismissible alert-warning" id='postChangesWarning'>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h5 class="alert-heading">Warning!</h5>
            <p class="mb-0" id='postChangesWarningtext'></p>
          </div>
          <div class='row '>
            <div class='col-5 leaseInfo'>
              <div class="card border-primary mb-2" >
                <div class="card-header">Notice Address</div>
                <div class="card-body">
                  <div id='noticeTo'></div>
                  <p class="card-text"><span id='noticeAddress1'></span><br><span id='noticeAddress2'></span>
                  </div>
                </div>
              </div>
              <div class=col>

                <div class='row'>
                  <div class=col-2><label class="col-form-label" for="inputDefault">Phone</label></div>
                  <div class=col><input type="text" class="form-control phone" placeholder="Phone Number" id="contactPhone"></div>
                </div>
                <div class='row mt-2'>
                  <div class=col-2><label class="col-form-label" for="inputDefault">Cell</label></div>
                  <div class=col><input type="text" class="form-control phone" placeholder="Cell Number" id="contactCell"></div>
                </div>
                <div class='row mt-2'>
                  <div class=col-2><label class="col-form-label" for="inputDefault">Email</label></div>
                  <div class=col><input type="text" class="form-control" placeholder="Email Address" id="contactEmail"></div>
                </div>
              </div>
<hr class='mt-3 tenantEmployeeInfo'>
              <div class='row tenantEmployeeInfo px-4 '>

                <center>

                <table >
                  <thead>
                  <tr><td colspan = 6 style = ><h5>Employee Info</h5>
                  <tr>
                    <td width='3%'><input class="form-check-input" type="checkbox" id="dents">
                    <td class ='mr-3'>Incidentals
                    <td width='3%'><input class="form-check-input" type="checkbox" <?php if(!in_array("mgmt",$_SESSION['roles'])){echo ' disabled ';}?> id="keys" checked="">
                    <td><label class="form-check-label" for="flexSwitchCheckChecked">Key Holder</label>
                    <td  width='3%'><input class="form-check-input" type="checkbox" id="active" checked="">
                    <td><label class="form-check-label" for="flexSwitchCheckChecked">Active Employee</label>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                  </center>
                </div>
                <div class='row leaseInfo px-4'>

                  <h5>Employees</h5>

                  <table class='mb-3 table table-sm table-striped' id='employeeTable'>
                  <tr><th>Name<th>Phone<th>Cell<th style='width: 10%'><center>Dents<th style='width: 10%'><center>Keys
                  </table>

                      <button class='btn btn-primary btn-sm w-25' onclick='loadNewEmployeeModal()'>Add Employee</button>
                  </div>
              </div>

              <div class="modal-footer mt-3">
                <button type="button" class="btn btn-primary" onclick='postChanges()'>Save changes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#modalContactDetails').hide();">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="modal" id='modalAddEmployee'>
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Employee</h5>
            <button type="button" class="btn-close" onclick='$("#modalAddEmployee").hide();' aria-label="Close">
              <span aria-hidden="true"></span>
            </button>
          </div>
          <div class="modal-body">


<div class="alert alert-dismissible alert-warning" id='addEmployeeWarning'>
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h5 class="alert-heading">Warning!</h5>
  <p class="mb-0" id='addEmployeeWarningText'></p>
</div>


            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="newEmployeeName" placeholder="name@example.com">
              <label for="newEmployeeName">Name</label>
              <div id='feedbackName'></div>
            </div>
            <div class="form-floating mb-3">
              <input type="email" class="form-control phone" id="newEmployeePhone" placeholder="name@example.com">
              <label for="newEmployeePhone">Phone Number</label>

            </div>
            <div class="form-floating mb-3">
              <input type="email" class="form-control phone" id="newEmployeeCell" placeholder="name@example.com">
              <label for="newEmployeeCell">Cell Number</label>
              <div id='feedbackPhone'></div>
            </div>
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="newEmployeeEmail" placeholder="name@example.com">
              <label for="newEmployeeEmail">Email address</label>
              <div id='feedbackEmail'></div>
            </div>
            <fieldset>
  <legend class="mt-4">Employee Rights</legend>
  <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="newEmployeeDents">
    <label class="form-check-label" for="flexSwitchCheckDefault">Charge Incidentals</label>
  </div>
  <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="newEmployeeKeys">
    <label class="form-check-label" for="flexSwitchCheckChecked">Key Holder</label>
  </div>
</fieldset>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="addEmployee()">Add Employee</button>
            <button type="button" class="btn btn-secondary" onclick='$("#modalAddEmployee").hide();'>Cancel</button>
          </div>
        </div>
      </div>
    </div>

<script>

$(document).ready(function(){$('#contactTable').DataTable({});});

$('.clickable').click(function(){
  $('#postChangesWarning').hide();
  $('#sqltablename').val($(this).data('sqltable'));
  if($(this).data('sqltable')=='executiveLease'){
  $('#companyName').val($(this).data('tenantname'));
  $('#propertyName').val($(this).data('property'));
  $('#steNum').val($(this).data('stenum'));
}
console.log($(this).data('contactid'));
  $.post( "/dbFunctions/dbContacts.php", {action: 'modalAJAX', tbl: $(this).data('sqltable'), id: $(this).data('contactid') } ).done(function(data) {fillModal(data)
     $('#modalContactDetails').show();});
});

function fillModal(data){
  obj = JSON.parse(data);
  if (obj.tenantName != obj.contactName){$('#CompanyName').html(obj.tenantName+'<br>Suite '+obj.suiteNumber); $('#noticeTo').html(obj.contactName+'<br>'+obj.tenantName);}else{$('#CompanyName').text('  Suite '+obj.suiteNumber); $('#noticeTo').html(obj.contactName);}
  if (typeof(obj.rent) != "undefined"){
    $('#ContactName').text(obj.contactName);
    $('#noticeAddress1').text(obj.contactAddress1);
    $('#noticeAddress2').text(obj.contactAddress2);
    $('#contactPhone').val(obj.contactPhone);
    $('#contactCell').val(obj.contactCell);
    $('#contactEmail').val(obj.contactEmail);
    $('#tenantID').val(obj.leaseID);
    fillEmployees(obj.leaseID);
    $('.leaseInfo').show();
    $('.tenantEmployeeInfo').hide();
  }else{
    $('#tenantID').val(obj.contactID);
    $('#ContactName').text(obj.addContactName)
    $('#contactPhone').val(obj.addPhone);
    $('#contactCell').val(obj.addCell);
    $('#contactEmail').val(obj.addEmail);
    $('.tenantEmployeeInfo').show();
    $('.leaseInfo').hide();
    if (obj.incidentals == 1){$('#dents').prop('checked',true);}else{$('#dents').prop('checked',false);}
    if (obj.keyholder == 1){$('#keys').prop('checked',true);}else{$('#keys').prop('checked',false);}

}}

$('.qsProperty').click(function(){
  var table = $('#contactTable').DataTable();
if ($("input[name='qsProperty']:checked").val() == 'all'){
  table.columns(6).search('').draw();
}else{

table.columns(6).search($("input[name='qsProperty']:checked").val()).draw();
}
});

function fillEmployees(id){
  $("#employeeTable").find("tr:gt(0)").remove();
  $.post( "/dbFunctions/dbContacts.php", {action: 'employeeAJAX', leaseid: id} ).done(function(data) {
    function checkBoxes(checked){
      if (checked == 1){ icon = '<i class="far fa-check-square"></i>';}else{ icon = '<i class="far fa-square"></i>';}
      return '<td><center>'+icon+'</center></td>';
    }
    emp = JSON.parse(data);

    if (emp == 'noEmployees'){$('#employeeTable').hide();}else{
      $('#employeeTable').show();
      for (let i = 0; i < emp.length; i++) {
         tableRow = '<td class="clickable" onclick="employeeModal('+emp[i].contactID+')">'+ emp[i].addContactName+'</td>';
         tableRow += '<td>'+ emp[i].addPhone+'<td>'+emp[i].addCell+'</td>';
         tableRow += checkBoxes(emp[i].incidentals)+checkBoxes(emp[i].keyholder);


      //   tableRow  +='<td>'+ obj[i].addPhone;
         document.getElementById("employeeTable").insertRow(-1).innerHTML = tableRow;
      //   $('#employeeTable tr').last().addClass('clickable tenantEmployee');
      }
}
  });

}

function employeeModal(contactid){
  $.post( "/dbFunctions/dbContacts.php", {action: 'modalAJAX', tbl: 'tenantContacts', id: contactid } ).done(function(data) {fillModal(data)
     $('#modalContactDetails').show();});
}

function loadNewEmployeeModal(){
  $('#addEmployeeWarning').hide();
  $("#modalAddEmployee").show();
  const foo = ['Name', 'Phone', 'Cell', 'Email'];
  for (var i = 0; i < foo.length; i++) {
    $('#newEmployee'+foo[i]).removeClass('is-valid is-invalid').val('');
    $('#feedback'+foo[i]).removeClass('valid-feedback invalid-feedback').text('');
  }
}

function addEmployee(){
  const foo = ['Name', 'Phone', 'Cell', 'Email']
  employeeData = {action: 'addemployee', id: $('#tenantID').val()}
  for (var i = 0; i < foo.length; i++) {
    employeeData[foo[i]] = $('#newEmployee'+foo[i]).val();
  }

if (document.getElementById('newEmployeeKeys').checked){employeeData['keys']=1;}else{employeeData['keys']=0;}
if (document.getElementById('newEmployeeDents').checked){employeeData['dents']=1;}else{employeeData['dents']=0;}
bar= true;
  if (employeeData.Name == ''){
    bar = false;
    $('#newEmployeeName').addClass('is-invalid');
    $('#feedbackName').addClass('invalid-feedback').text('Employee Name Required');
} else {$('#newEmployeeName').addClass('is-valid');}

if (employeeData.Email == ''){
  bar = false;
  $('#newEmployeeEmail').addClass('is-invalid');
  $('#feedbackEmail').addClass('invalid-feedback').text('Employee Email Address Required');
} else {$('#newEmployeeEmail').addClass('is-valid');}

if (employeeData.Phone == '' && employeeData.Cell == ''){
  bar = false;
  $('#newEmployeePhone').addClass('is-invalid');
  $('#newEmployeeCell').addClass('is-invalid');
  $('#feedbackPhone').addClass('invalid-feedback').text('A Phone Number is Required');
} else {$('#newEmployeePhone').addClass('is-valid'); $('#newEmployeeCell').addClass('is-valid');}

if (bar){
  $.post( "/dbFunctions/dbContacts.php", employeeData ).done(function(data) {
    console.log(data);
    data.split(",");
    if (data[0] == 'gtg'){
      $('#modalAddEmployee').hide();
      $.post( "/dbFunctions/dbContacts.php", {action: 'modalAJAX', tbl: 'executiveLease', id: $('#tenantID').val() } ).done(function(data) {fillModal(data);});
      var t =$('#contactTable').DataTable();


      $('#steNum').val()
      var email = '<a href="mailto:'+employeeData.Email+'">'+employeeData.Email+"</a>";
      console.log($('#steNum').val());
    //  data-sqltable="tenantContacts" data-contactID="'.$row['contactID'].'"

      //d={'sqltable':'tenantContact', 'contactID': data[1]};
    var trDOM = t.row.add([$('#steNum').val(), employeeData.Name, $('#companyName').val(), employeeData.Phone,employeeData.Cell,email,$('#propertyName').val()]).draw().node();
    $( trDOM ).addClass('clickable');
    $( trDOM ).data('sqltable','tenantContact');
    $( trDOM ).data('contactID', data[1]);
    }else{
      $('#addEmployeeWarning').show();
      $('#addEmployeeWarningText').html("Best check yo self, you're not looking too good.<br>"+data);}
  });

} else { console.log($('#steNum').val()); }
}

function postChanges(){

if(document.getElementById('dents').checked){foo='1|'}else{foo='0|';}
if(document.getElementById('active').checked){foo+='1|'}else{foo+='0|';}
if(document.getElementById('keys').checked){foo+='1'}else{foo+='0';}
console.log(foo);
var updateData = {action: 'updatecontact',tbl: $('#sqltablename').val(), contactID: $('#tenantID').val(), phone: $('#contactPhone').val(), cell: $('#contactCell').val(), email: $('#contactEmail').val(), empInfo: foo }
$.post( "/dbFunctions/dbContacts.php", updateData ).done(function(data) {
  if(data == 'gtg'){
    location.reload();
  }else{
  $('#postChangesWarning').show();
  $('#postChangesWarningtext').html(data);
}
});

}


</script>
