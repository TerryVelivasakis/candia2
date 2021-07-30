<?php
require $_SERVER["DOCUMENT_ROOT"].'includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';

?>

<link rel="stylesheet" href="\style\forms.css">
<body>

  <div class="container mt-2">

    <button class="btn  btn-primary" onclick=window.location.href="/leasing/executiveLeaseInput.php";>New Prospective Tenant</button>

    <div class="alert alert-dismissible alert-success m-2" id = "updateAlert" style="display: none">
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      <span id="updateAlertText"><strong>Well done!</strong> You successfully read <a href="#" class="alert-link">this important alert message</a>.</span>
    </div>

    <table class="table table-sm bordered" id="reviewTable" width="100%">
      <thead><tr><TH>Status<th width="40%">Tenant Name<th>Suite<th>Move In Date<th>Generate<th>Update Status</tr></thead>
        <tbody>
          <?php
          $setStatus = "";
          $noBueno = array(2,3);
          $noDisplayStatus = array(3,6);
          $sql = "SELECT * FROM `executiveLeasePending` WHERE status > 0";
          $result = $db->query($sql);
          while($row = $result->fetch_assoc()) {
            $daysAgo = (strtotime("today") - strtotime($row['moveInDate']))/ 86400;
            if ($daysAgo > 30 && in_array($row['status'], $noDisplayStatus)){}else{
            echo "<tr id='trStatus".$row['pendingLeaseID']."'><td datasort=".$row['status']." id='tdStatus".$row['pendingLeaseID']."' >";
            echo "<td><a href='/leasing/executiveLeaseInput.php?q=".$row['pendingLeaseID']."'>".$row['tenantName']."</a></td>";
            echo "<td>".$row['suiteNumber']."</td>";
            echo "<td datasort='".strtotime($row['moveInDate'])."'>".date("F j, Y",strtotime($row['moveInDate']))."</td>";
            echo "<td id='tdAction".$row['pendingLeaseID']."' datasort=".$row['status'].'>';

            $disabled="";
            $executeButton = '<button class="btn btn-sm btn-info" onclick="executeLease('.$row['pendingLeaseID'].')">Finalize</button> ';
            if ($accessLevel < 2){
              $executeButton = '';
              if (in_array($row['status'], $noBueno)){$disabled="disabled"; }else{$disabled="";}
                  }
              $buttonAction ="onclick = postStatusUpdate(".$row['pendingLeaseID'].",$('#leaseStatus".$row['pendingLeaseID']."').val())";
              echo "<td style 'vertical-align: middle !important' >";
              //echo $buttonAction;

              echo "<select  $disabled id='leaseStatus".$row['pendingLeaseID']."'>
              <option value=1>Approved</option>
              <option $disabled value=2>Needs Approval</option>
              <option $disabled value=3>Denied Approval</option>
              <option value=4>Out for Signature</option>
              <option value=5>Executed</option>
              <option value=6>Dead Deal</option>
              </select>
              <button $disabled class='btn btn-secondary' data-bs-toggle='tooltip' data-bs-placement='right' title='Update Status' $buttonAction><i class='fas fa-sign-out-alt'></i></button>";

            $setStatus = $setStatus."schemeUpdate(".$row['pendingLeaseID'].",".$row['status'].");$('#leaseStatus".$row['pendingLeaseID']."').val(".$row['status'].");";
          }
}

          ?>
        </tbody>
      </table>
    </div>
  </body>
  <script>

  function postStatusUpdate(id, setStatus){
    var updateValues = {action: "statusUpdate", pendingLeaseID: id, newStatus: setStatus };

    var jqxhr = $.post( '/dbFunctions/dbExecutiveLease.php', updateValues, function() {
      //alert( "success" );
    })
    .done(function(data) {
      $("#updateAlert").removeClass("alert-info");
      $("#updateAlert").removeClass("alert-warning");
      $("#updateAlert").removeClass("alert-danger");
      $("#updateAlert").addClass("alert-info");

      output = data.split("|")

      if (output[0]=="1"){
        $("#updateAlert").addClass("alert-info");
        $("#updateAlertText").html(output[1]);
        schemeUpdate(id, output[2]);
      }else{
        $("#updateAlert").addClass("alert-warning");
        $("#updateAlertText").html(output[1]+output[3]);

      }

      $("#updateAlert").show();

      //  foo(id);
    })
    .fail(function() {
      $("#updateAlert").addClass("alert-danger");
      $("#updateAlertText").html("Now why would you go and break everything?");
    })
    .always(function() {
      //  alert( "finished" );
    });
  }


  function schemeUpdate(id, newStatus){

    $("#tdAction"+id).html('');
    $("#tdStatus"+id).html('');
    $("#trStatus"+id).removeClass('table-light');
    $("#trStatus"+id).removeClass('table-primary');
    switch (parseInt(newStatus)) {
      case 0:
      $("#trStatus"+id).hide();
      break;
      case 1:
      $("#tdStatus"+id).html('<span class="badge bg-primary">Approved</span>');
      $("#tdAction"+id).html('<button class="btn btn-sm btn-primary" onclick=window.open("/leasing/executiveLease/executiveLease.php?q='+id+'")>Lease</button>');

      break;

      case 2:
      $("#tdStatus"+id).html('<span class="badge bg-warning">Approval<br>Pending</span>');
      $("#tdAction"+id).html('<button class="btn btn-sm btn-primary" onclick=window.open("/leasing/executiveLease/abstractOnly.php?q='+id+'")>Abstract</button>');
      break;

      case 3:
      $("#tdStatus"+id).html('<span class="badge bg-danger">Approval<br>Denied</span>');
      $("#tdAction"+id).html('<button class="btn btn-sm btn-primary disabled" onclick=window.open("/leasing/executiveLease/executiveLease.php?q='+id+'")>Lease</button>');
      break;

      case 4:
      $("#tdStatus"+id).html('<span class="badge bg-success">Out for<br>Signature</span>');
      $("#trStatus"+id).addClass('table-light');
      $("#tdAction"+id).html('<button class="btn btn-sm btn-primary" onclick=window.open("/leasing/executiveLease/abstractOnly.php?q='+id+'")>Abstract</button>');
      break;

      case 5:

      $("#tdStatus"+id).html('<span class="badge bg-info">Lease<br>Executed</span>');
      $("#trStatus"+id).addClass('table-primary');
      $("#tdAction"+id).html('<button class="btn btn-sm btn-info" <?php echo $disabled; ?> onclick=executeLease('+id+')>Finalize</button>');

      break;

      case 6:
      $("#tdStatus"+id).html( '<span class="badge bg-danger">Dead Deal</span>');
      break;
    }

  }

  function executeLease(id){
    var updateValues = {action: "finalize", pendingLeaseID: id };

    var jqxhr = $.post( '/dbFunctions/dbExecutiveLease.php', updateValues, function() {
      //alert( "success" );
    })
    .done(function(data) {
      $("#updateAlert").addClass("alert-info");

      output = data.split("|")

      if (output[0]=="1"){
        $("#updateAlert").addClass("alert-info");
        $("#updateAlertText").html(output[1]);
        postStatusUpdate(id, 0);
        schemeUpdate(id, 0);
      }else{
        $("#updateAlert").addClass("alert-warning");
        $("#updateAlertText").html(output[1]);

      }

      $("#updateAlert").show();

      //  foo(id);
    })
    .fail(function() {
      $("#updateAlert").addClass("alert-danger");
      $("#updateAlertText").html("Now why would you go and break everything?");
    })
    .always(function() {
      //  alert( "finished" );
    });
  }



  $(document).ready(function(){
    $('#reviewTable').DataTable({
      responsive: true,
      "paging":   false,
      "searching": false,
      "info":     false});
      <?php echo $setStatus; ?>
    });
  </script>
