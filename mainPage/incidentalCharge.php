
<h5 class="card-header">Incidental Charge</h5>
<div class='mpTablePadding'>

<table width="100%">
  <tr><th colspan=4>
    <select class="form-select" id='selectTenantDent'>
<?php
session_start();
$groupQuery = "SELECT * FROM `executiveLease` WHERE `status` = 1 AND `Property` = ".$_SESSION['property'];
$groups = $db->query($groupQuery);
while($row = $groups->fetch_assoc()) {
  $tenantID = $row['leaseID'];
echo "<option value=$tenantID>";
if ($row['contactName'] == $row['tenantName']){
  echo $row['suiteNumber'].' - '.$row['tenantName'].'</option>';
}else{
  echo $row['suiteNumber'].' - '.$row['contactName'].' - '.$row['tenantName'].'</option>';
}
}

$sql = "SELECT tenantContacts.*, executiveLease.* FROM tenantContacts JOIN executiveLease ON executiveLease.leaseID = tenantContacts.leaseID WHERE executiveLease.status = 1 AND tenantContacts.incidentals = 1 AND `Property` = ".$_SESSION['property'];
$result = $db->query($sql);

while($row = $result->fetch_assoc()) {
echo '<option value ='.$row['leaseID'].'>';
echo $row['suiteNumber'].' - '.$row['addContactName'].' - '.$row['tenantName'].'</option>';
$x=$x+1;

}

?>
    </select></tr>


    <tr><th colspan=4>Quick Charge</th>
      <tr><td colspan=2>    <select class="form-select" id='quickCharge'>
        <?php
        $groupQuery = "SELECT DISTINCT incidentalGroup FROM incidentalCosts WHERE incidentalGroup NOT LIKE 'Conference%' AND incidentalGroup != 'Handling Fees'";

        $groups = $db->query($groupQuery);
        while($row = $groups->fetch_assoc()) {
          echo "<option class='optionHeading' disabled><b>".$row['incidentalGroup'];
          echo "</option></b>";
          $incidentalGroupSQL = "SELECT * FROM incidentalCosts WHERE incidentalGroup = '".$row['incidentalGroup']."'";
          $chargeByGroup = $db->query($incidentalGroupSQL);
          while($charge = $chargeByGroup->fetch_assoc()) {
            if ($row['incidentalGroup'] != "Handling Fees"){
              echo "<option data-units='".$charge["unit"]."' value =".$charge["Price"]."> &emsp;".$charge['Name']."</option>";}
            }
          }?>
        </select></td>

        <td>

          <input data-bs-toggle='tooltip'  data-bs-placement='bottom' title='Units' class='form-control smallNum ' type=number min=1 width=25 id=quickCargeQuantity placeholder='pages'></input>

        </td>

        <td>  <button class='btn btn-small btn-primary'
          data-bs-toggle='tooltip'  data-bs-placement='bottom' title='Quick Charge' onclick="postCharge(1)"><i class="fas fa-file-invoice-dollar"></i></button></td>

          <tr><th colspan=3>Other Charge</th>

            <tr >
              <td><label for="descrip">Description:</label><input placeholder='Charge Description' class="form-control form-control" type="text" name="descrip" id="descrip" size="30" required="">
                <td>  <label for="descrip">Charge:</label><div class="input-group" style='width: 100px'>
                            <span class="input-group-text">$</span><input  data-bs-toggle='tooltip'  data-bs-placement='bottom' title='Charge' class='form-control smallNum ' type="number" min=1 width=2 id=quickCargeQuantity placeholder='2.50' style=''/></div>
                  <td><label for="descrip">Type:</label><select class="form-control form-control" name="inctype" id="inctype" required="">
                    <option value="1">Postage</option>
                    <option value="2">Other</option>
                  </select>
                  <td style='vertical-align: bottom !important; padding-bottom: .5em'>  <button class='btn btn-small btn-primary'
                    data-bs-toggle='tooltip'  data-bs-placement='bottom' title='Quick Charge' onclick="postCharge(2)"><i class="fas fa-file-invoice-dollar"></i></button></td>
                  </table>
</div>


<script>
$(document).ready(function(){
  var options = $("#selectTenantDent option");                    // Collect options
  options.detach().sort(function(a,b) {               // Detach from select, then Sort
      var at = $(a).text();
      var bt = $(b).text();
      return (at > bt)?1:((at < bt)?-1:0);            // Tell the sort function how to order
  });
  options.appendTo("#selectTenantDent");
  checkdata();
  });
</script>
