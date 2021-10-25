<?php
require $_SERVER["DOCUMENT_ROOT"].'/includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';
session_start();
?>

<html>
  <head>
    <link href="https://cdn.quilljs.com/1.3.4/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.4/quill.js"></script>

    <style>
    #editor {
      height: 400px;

    }
    #toolbar {


    }
    table, td, th {
      border-collapse: collapse;

    }
    </style>
  </head>

  <body>





    <?php


    include $_SERVER['DOCUMENT_ROOT']."/includes/dirconfig.php";

    $dbname = "WBdirectory";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }



  $result = mysqli_query($conn, "SELECT * FROM `Contact`");

  while($row = mysqli_fetch_array($result)) {
    $greeting = $row['Greeting'];

  }


?>
<div class="container">
<div class="row">
<div class="col-sm-5">
<div style="border: 1px solid black; padding: 20px">
  <h5>Update Greeting:</h5>
  <input class="form-control" name="heading" id="heading" type="text" value=<?php echo '"'.$greeting.'"';?>  size="42">
  <button class="btn btn-primary btn-sm mt-1" onclick="updategreeting()">Update Greeting</button>
</div>
<br>
<div style="border: 1px solid black; padding: 20px">
  <h5>Update Tenant:</h5>
<select class="browser-default custom-select custom-select-sm mb-3" id="tenid"  onchange='tenchanger()'>
  <option value="0">New Tenant</option>
<?php
$result = mysqli_query($conn, "SELECT * FROM `Tenants` ORDER BY `Suite` ASC");

while($row = mysqli_fetch_array($result)) {
  echo '<option value="'.$row["ID"].'">'.$row['Suite'].' - '.$row['Line1'].'</option>';

}


 ?>
</select>

<table>
  <tr><th width="70px">Suite:<th width ="330">Tenant Info:
    <tr><td><input class="form-control" name="suite" id="suite" type="text" value=""  style = "max-width: 65px">
<td>      <input class="form-control" name="suite" id="line1" type="text" value="">
<tr><td><td>      <input class="form-control" name="suite" id="line2" type="text" value="">
<tr><td colspan="2">
  <span id="uten"><button class="btn btn-primary btn-sm mt-1" onclick="addtenant()">Add Tenant</button></span>
</table>
</div>

</div>

<div class="col-sm">
<div style="border: 1px solid black; padding: 20px">
  <h5>Update Announcements:</h5>
<table>


   <tr><td colspan="2">Load Announment:<select class="browser-default custom-select custom-select-sm mb-3" id="annc"  onchange='changer()'>
     <option value="0">New Announcement</option>
<?php      $result = mysqli_query($conn, "SELECT * FROM `Announcements` ORDER BY `RunUntil` DESC");

      while($row = mysqli_fetch_array($result)) {

        if (($row['RunFrom'] <= date("Y-m-d H:i:s")) && ($row['RunUntil'] >= date("Y-m-d H:i:s"))){
         $acti = "Active - ";
         $acticolor = 'style="color:blue"';
       } else {
         $acti = "";
         $acticolor = 'style="color:lightgrey"';
       }

//echo $acti;
//echo $row['RunFrom'];
//echo ' - ' . date("Y-m-d H:i:s") . ' - ';
//echo $row['RunUntil'];
echo '<option '.$acticolor.' value="'.$row['AnnID'].'">';
echo $acti;


if ($row['Announcement'] == ""){
  echo 'Only Image No Text';
}else{
  echo substr(strip_tags($row['Announcement']),0,45);
}

//echo "<br>";
echo '</option>';
      }
echo '';
?>



      <tr>
        <td>
          <label for="from">Run From: </label>
          <input class="form-control" name="runfrom" id="from" type="datetime-local" value="<?php echo date("Y-m-d")."T".date("H:i");?>">
<td>
          <label for="runtil">Run Until: </label>
          <input class="form-control" name="runtil" id="runtil" type="datetime-local" value=<?php echo date("Y-m-d", strtotime("+1 week"))."T23:59";?>>
<tr><td  colspan ="2">
          <label for="link">Paste Image Address Here:</label>
          <input name="link" id="link" type="text" onchange="imgchange()">
    <tr>
<td  colspan ="2" id="imgpreview">
      <tr>
      <td  colspan ="2" id="edtr">

    <div id="toolbar">
      <button class="ql-bold"></button>
      <button class="ql-italic"></button>
      <button class="ql-underline"></button>

      </span>
    </div>
    <div id="editor">

    </div>


<tr>
<td  colspan ="2">

      <button class="btn btn-primary btn-sm mt-1" onclick="logHtmlContent()">Send To Directory</button>


</form>





</table>
</div></div>
<div id=scripter>
<input type="hidden" id="annctext" value="">
<input type="hidden" id="runtilh" value="<?php echo date("Y-m-d", strtotime("+1 week"))."T23:59";?>">
<input type="hidden" id="anncimg" value="">

</div>
</div>
  <script>

  let Inline = Quill.import('blots/inline');
  let Parchment = Quill.import('parchment')

  var boxAttributor = new Parchment.Attributor.Class('box', 'line', {
    scope: Parchment.Scope.INLINE,
    whitelist: [false, 'solid', 'double', 'dotted']

  });

  Quill.register(boxAttributor);
  var toolbarOptions = [['bold', 'italic'], ['link', 'image']];
  var BackgroundClass = Quill.import('attributors/class/background');
  var ColorClass = Quill.import('attributors/class/color');
  var SizeStyle = Quill.import('attributors/style/size');
  Quill.register(BackgroundClass, true);
  Quill.register(ColorClass, true);
  Quill.register(SizeStyle, true);

  var quill = new Quill('#editor', {
    modules: {

      toolbar: '#toolbar'
    },
    placeholder: 'Compose an epic announcment...',
    theme: 'snow'
  });




  function logHtmlContent() {

    foo = quill.root.innerHTML;
    if (foo=="<p><br></p>"){
     foo="";
    }
    $.post("anncdb.php", {
     annid: document.getElementById("annc").value,
     annc: foo,
     annimg: document.getElementById("link").value,
     runtil: document.getElementById("runtil").value,
     runfrom: document.getElementById("from").value
   })
   .done(function( data ) {
     alert( data);
     location.reload();
   });

  }



function tenchanger(){
  $.post("../db/dirdb.php", {
             act: "changeten",
             tenid: document.getElementById('tenid').value
           })
.done(function( data ) {
  stringArray = data.split("|");
  if (document.getElementById('tenid').value == "0"){
  document.getElementById('suite').value = "";
  document.getElementById('line1').value = "";
  document.getElementById('line2').value = "";
  document.getElementById('uten').innerHTML = '<button class="btn btn-blue-grey blue-grey darken-1 btn-sm" onclick="newtenant()">Add Tenant</button>';
  }else{
  document.getElementById('suite').value = stringArray[0];
  document.getElementById('line1').value = stringArray[1];
  document.getElementById('line2').value = stringArray[2];
  document.getElementById('uten').innerHTML = '<button class="btn btn-blue-grey blue-grey darken-1 btn-sm" onclick="updatetenant()">Edit Tenant</button><button class="btn blue-grey lighten-3 btn-sm" onclick="deletetenant()">Delete Tenant</button>';
  }
});

}

function updatetenant(){
  $.post("../db/dirdb.php", {
             act: "updateten",
             tenid: document.getElementById('tenid').value,
             suite: document.getElementById('suite').value,
             line1: document.getElementById('line1').value,
             line2: document.getElementById('line2').value
           })
.done(function( data ) {
alert(data);
 location.reload();
});

}

function addtenant(){
  $.post("../db/dirdb.php", {
             act: "addten",
             suite: document.getElementById('suite').value,
             line1: document.getElementById('line1').value,
             line2: document.getElementById('line2').value
           })
.done(function( data ) {
alert(data);
 location.reload();
});

}

function deletetenant(){
  if (confirm('Are you sure you want delete this tenant?')) {
    $.post("../db/dirdb.php", {
               act: "deleteten",
               tenid: document.getElementById('tenid').value,
             });
  } else {
      // Do nothing!
  }
 location.reload();

}



  function updategreeting() {
    $.post("anncdb.php", {

     greeting: document.getElementById("heading").value
   })
   .done(function( data ) {
     alert( data);
     location.reload();
   });

  }

function scripter(){
  quill.root.innerHTML=document.getElementById('annctext').value;
  document.getElementById("runtil").value = document.getElementById('runtilh').value;
  document.getElementById("link").value = document.getElementById('anncimg').value;
  document.getElementById("from").value = document.getElementById('runfh').value;
}

  function parselink(){
quill.root.innerHTML='<img src="'+document.getElementById('link').value+'" width="250px">';
  }


function changer() {
    console.log(quill.root.innerHTML);
	  q=(parseInt(document.getElementById("annc").value));
	  $("#scripter").load("anncedit.php?q=" + q, function(){

        scripter();
        imgchange();
    });

 }


function imgchange(){

  if (document.getElementById("link").value == ""){
document.getElementById('imgpreview').innerHTML ="";
  }else{
document.getElementById('imgpreview').innerHTML='<center><img src="'+document.getElementById("link").value+'" alt="image preview" style="max-height: 175px; max-width: 175px">';

}
}

  </script>




</html>
