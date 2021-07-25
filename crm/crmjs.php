<style>

</style>


<div class="modal fade" id="DescModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div id='modalLoad'></div>
  </div>
</div>




<script>





function notetable(){

}

function addnote(){
}


function callnote(){


}





$( document ).ready(function() {

});

function shownew(){
  document.getElementById('prospectbutton').innerHTML='<button type="button" class="btn btn-blue-grey blue-grey darken-1 btn-md" onclick ="addnew()">Add New Prospect</button>'
$('#DescModal').modal('show');
}

function addnew(){

if (document.getElementById("plan").value==""){
document.getElementById('error').innerHTML="Please Assign a follow up plan."
return;
}
if (document.getElementById("source").value==""){
document.getElementById('error').innerHTML="Please indicate source"
return;
}

$.post("crmdb.php",{
  action: "new",

  fname: document.getElementById("fname").value,
  lname: document.getElementById("lname").value,
  company: document.getElementById("company").value,
  phone: document.getElementById("phone").value,
  businessType: document.getElementById("businessType").value,
  property: document.getElementById("property").value,
  email: document.getElementById("email").value,
  size: document.getElementById("size").value,
  note: document.getElementById('note').value,
  source: document.getElementById("source").value,
  plan: document.getElementById("plan").value
}).done(function(){ $('#DescModal').modal('hide');});

}


function editdetails(){
  $.post("crmdb.php",{
    action: "update",
    pid: document.getElementById('pid').value,
    fname: document.getElementById("fname").value,
    lname: document.getElementById("lname").value,
    company: document.getElementById("company").value,
    phone: document.getElementById("phone").value,
    cell: document.getElementById("cell").value,
    email: document.getElementById("email").value,
    size: document.getElementById("size").value,
    source: document.getElementById("source").value,
    note: document.getElementById('note').value,
    plan: document.getElementById("plan").value,
    nexttouch: document.getElementById("nextcontact").value
  }).done(function(result){ $('#DescModal').modal('hide');});

}

function checkconflict(){

tourtimedate = $( '#tourdate' ).val() + " " +$( '#tourtime' ).val();
if ($( '#tourdate' ).val() == "" || $( '#tourtime' ).val()==""){gtg = false;}
if ($( '#tourdate' ).val() != "" && $( '#tourtime' ).val() != ""){conflictajax(tourtimedate);}

}

function conflictajax(tourtime){
  $.post("../db/tourdb.php",{
    act: 'conflict',
    tourtime: tourtime,
  },
  function(result){
      $("#conf").html(result);
    });}

function scheduletour(){
  $("#conf").html('<img src="../img/loader.gif" alt="loader" style="max-height: 40px; style="max-width: 40px"" >');

  tourtimedate = $( '#tourdate' ).val() + " " +$( '#tourtime' ).val();
  pid = $( "#pid" ).val();
      $.post("../db/tourdb.php",{
        act: 'schedule',
        pid: document.getElementById('pid').value,
        tourtime: tourtimedate,
      },
      function(result){
          $("#conf").html(result);
});

}



</script>
