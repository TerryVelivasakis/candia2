
<h5 class="card-header">Check Log</h5>
<div class=p-2>


    <select class="form-select" id='selectTenantCheck'>
      <?php
      $groupQuery = "SELECT * FROM `executiveLease` WHERE `status` = 1 or `status` = 2";
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
      ?>
    </select>
  <table width="100%" style='margin-top: 5px'>
    <tr><td>Check Number</td><td width='15px'><td>Amount</td><td width='15px'><td>
      <tr><td><input class=form-control id=inputCheckNumber type="number"/></td>

        <td ><td>
<div class="input-group">
            <span class="input-group-text">$</span><input class=form-control id=inputCheckNumber type=number />
</div>
        <td><td><button class='btn btn-primary'>Log</button></td>
                  </table>

</div>
<script>
$(document).ready(function(){
  var options = $("#selectTenantCheck option");                    // Collect options
  options.detach().sort(function(a,b) {               // Detach from select, then Sort
      var at = $(a).text();
      var bt = $(b).text();
      return (at > bt)?1:((at < bt)?-1:0);            // Tell the sort function how to order
  });
  options.appendTo("#selectTenantCheck");

  });
</script>
