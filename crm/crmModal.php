<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/includes/dbconfig.php';
if(isset($_GET['q'])){
$q = $_GET['q'];
$sql = 'SELECT * FROM Prospects WHERE ID = '.$q;
$result = $crmDB->query($sql);
while($row = $result->fetch_assoc()) {
$firstName = $row['FName'];
$lastName = $row['LName'];
$company = $row['company'];
$phone = $row['Phone'];
$property= 1;
$email = $row['email'];
$source = $row['source'];
$nextcontact = $row['nextcontact'];
$size = $row['size'];
$followUpPlan = $row['plannumber'];
}

$q = $_GET['q'];
$sql = 'SELECT * FROM `Tours` WHERE Prospect = '.$q.' AND TourDate >= "'.date('Y-m-d').'" ORDER BY `TourDate` ASC LIMIT 1';
$result = $crmDB->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
$nextTourDate = date('l, F j, Y',strtotime($row['TourDate']));
$nextTourTime = date('g:ia',strtotime($row['TourDate']));
$nextTourText = "There is a tour scheduled for $nextTourDate at $nextTourTime";
$tourCard = '<div class="card border-primary mt-1" style="max-width: 20rem;"><div class="card-header text-white bg-primary">Upcoming Tour</div>
            <div class="card-body"><p class="card-text">'.$nextTourText.'</p></div></div>';
}
}else{
  $tourCard = '<div class="card border-warning mt-1" style="max-width: 20rem;"><div class="card-header bg-warning">No Tour Scheduled</div>
              <div class="card-body"><p class="card-text">There are no upcoming tours scheduled yet.</p></div></div>';
}
}else {$nextcontact = date('Y-m-d',strtotime('next weekday'));}
?>

<div class="modal-content">
  <div class="modal-header">
    <h4 class="modal-title">Prospect Details <?php echo $nextcontact;?> </h4>
    <div id="error">
    </div>
  </div>
  <div class='modal-body'>
    <div class='row formBorder'>
      <div class='form-group col'><label>First Name</Label><input type=text class='form-control' value='<?php echo $firstName;?>' id='fname'/></div>
        <div class='form-group col'><label>Last Name</Label><input type=text class='form-control' value='<?php echo $lastName;?>' id='lname'/></div>
          <div class='form-group col'><label>Company</Label><input type=text class='form-control' value='<?php echo $company;?>' id='company'/></div>
          </div>
          <div class='row mt-2 formBorder'>
            <div class='form-group col-3'><label>Phone</Label><input type=text class='form-control' value='<?php echo $phone;?>' id='phone'/></div>
            <div class='form-group col-5'><label>Email</Label><input type=text class='form-control' value='<?php echo $email;?>' id='email'/></div>
            <div class='form-group col-4'><label>What size office?</Label><input type=text class='form-control' value='<?php echo $size;?>' id='size'/></div>


                  </div>
                  <div class='row my-2 formBorder'>

                    <div class='form-group col'><label>Type of Business</Label><input type=text class='form-control'  value='<?php echo $businessType;?>' id='businessType'/></div>
                      <div class='form-group col-3'><label>Property</Label><select class='form-select' id='property'>
                            <?php
              $sql = 'SELECT * FROM property';
              $result = $db->query($sql);

              while($row = $result->fetch_assoc()) {
                echo '<option value = '.$row["propertyID"].'>'.$row['propertyNickname'].'</option>';
              }

          ?>
                          </select>
                          </div>
                      <div class='form-group col-4'><label>How did you hear about us?</Label>
                        <select style="width:100%" id="source" class='form-select'>
                          <option disabled selected value> -- select an option -- </option>
                          <option value=1>Craigslist</option>
                          <option value=2>801 Website</option>
                          <option value=3>Refferal Service</option>
                          <option value=4>Loopnet</option>
                          <option value=5>Google</option>
                          <option value=6>Word of Mouth</option>
                          <option value=7>Other/Unknown</option>
                        </select>
                      </div>
                    </div>
                    <hr>
                    <div class='row'>

                        <div class='col-3' >

                            <label>Follow Up Plan</Label>
                              <select class='form-select' id="plan">
                                <?php

                                $sql = "SELECT * FROM `PlanNames`";
                                $result = $crmDB->query($sql);
                                echo'<option disabled selected value> -- select an option -- </option>';
                                while($row = $result->fetch_assoc()) {
                                  echo '<option value='.$row["PlanID"].'>'.$row["PlanName"].'</option>';
                                }
                                ?>
                              </select>

                              <label>Next Contact Date</label>
                              <input class='form-control' type=date value='<?php echo $nextcontact ?>'>


                            </div>


                        <div class='form-group col-auto border mx-2 pb-2'>
                          <label>Schedule Tour</label>
                          <table >
                          <tr><td colspan=2><input class='form-control' type=date>

                            <tr><td><select class='form-select' id=tourHour>
                              <option value=9>9</option>
                              <option value=10 selected>10</option>
                              <option value=11>11</option>
                              <option value=12>12</option>
                              <option value=13> 1</option>
                              <option value=14> 2</option>
                              <option value=15> 3</option>
                              <option value=16> 4</option>
                              <option value=17> 5</option>
                            </select>
                            <td><select class='form-select' id=tourMinute>
                              <option value=':00'>:00</option>
                              <option value=':30'>:30</option>
                            </select>
                            <tr><td colspan=2><center><button class='btn btn-primary btn-sm' onclick='scheduleTour()'>Schedule Tour</button>
                          </table>

                        </div>
                        <div class='col-5'>
                          <?php echo $tourCard; ?>


                        </div>
                      </div>

                      <div id ="notebody" class='mt-2 border' style="overflow-y: scroll; height:200px;" width="100%">
                        <table class='table table-sm table-striped smallTable' id='noteTable'>
                          <?php
                          if (isset($_GET['q'])){
                          $sql = "SELECT * FROM `notes` WHERE `prospect`=".$q.' ORDER BY `notes`.`ndate` DESC';
                          $result = $crmDB->query($sql);
                          while($row = $result->fetch_assoc()) {
                            echo '<tr><td width="15%" class="lease">'.$row['editor'].'<br><em> '.date('n/j/Y',strtotime($row['ndate']));
                            echo '<td class="lease">'.$row['note'];
                          }}
                          ?>
                        </table>
                      </div>
                      <div class='row mt-1'>
                        <div class=col-10>
                                            <input id="note" class=form-control type="text"></input></div><div class='col-auto pt-1'><button class="btn btn-primary btn-sm" onclick="addNote()">Add Note</button><span class=pr-3/>

                      </div>
                    </div>
                  </div>
                  <div class='modal-footer'>
                    <button class='btn btn btn-primary'>save</button>
                    <button class='btn btn btn-secondary' onclick='$("#DescModal").modal("hide")'>close</button>
                  </div>
                </div>

<script>
$('#source').val(<?php echo $source; ?>);
$('#plan').val(<?php echo $followUpPlan; ?>);
function addNote(){
newNote = $('#note').val();

if (newNote == ""){
  $('#note').addClass('is-invalid');
}else{
  $('#note').removeClass('is-invalid');

  var table = document.getElementById("noteTable");
  var row = table.insertRow(0);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  cell1.innerHTML = "<?php echo ucfirst($userName) . '<br><em> '.date('n/j/Y'); ?>";

  cell2.innerHTML = document.getElementById('note').value;
  document.getElementById('note').value ="";

}


}

</script>
