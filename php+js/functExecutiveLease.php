<?php

//require_once $_SERVER["DOCUMENT_ROOT"].'includes/loadme.php';

$sql = "SELECT * FROM telecomPricing WHERE ProductID = 4";
$result = $db->query($sql);
$price = $result->fetch_assoc();
$tcPhoneLinesOTC = number_format($price['SetupFee'],2);
$tcPhoneLinesMRC = number_format($price['MonthlyFee'],2);

$sql = "SELECT * FROM telecomPricing WHERE ProductID = 5";
$result = $db->query($sql);
$price = $result->fetch_assoc();
$tcPhoneAnsweringOTC= number_format($price['SetupFee'],2);
$tcPhoneAnsweringMRC= number_format($price['MonthlyFee'],2);

$sql = "SELECT * FROM telecomPricing WHERE ProductID = 6";
$result = $db->query($sql);
$price = $result->fetch_assoc();
$tcMirrorDeviceOTC= number_format($price['SetupFee'],2);
$tcMirrorDeviceMRC= number_format($price['MonthlyFee'],2);

$sql = "SELECT * FROM telecomPricing WHERE ProductID = 7";
$result = $db->query($sql);
$price = $result->fetch_assoc();
$tcPowerAdapterOTC= number_format($price['SetupFee'],2);
$tcPowerAdapterMRC= number_format($price['MonthlyFee'],2);

$sql = "SELECT * FROM telecomPricing WHERE ProductID = 8";
$result = $db->query($sql);
$price = $result->fetch_assoc();
$tcEfaxOTC= number_format($price['SetupFee'],2);
$tcEfaxMRC= number_format($price['MonthlyFee'],2);

$sql = "SELECT * FROM telecomPricing WHERE ProductID = 10";
$result = $db->query($sql);
$price = $result->fetch_assoc();
$tcFirstStaticOTC= number_format($price['SetupFee'],2);
$tcFirstStaticMRC= number_format($price['MonthlyFee'],2);


$sql = "SELECT * FROM telecomPricing WHERE ProductID = 11";
$result = $db->query($sql);
$price = $result->fetch_assoc();
$tcAdditionalStaticOTC= number_format($price['SetupFee'],2);
$tcAdditionalStaticMRC= number_format($price['MonthlyFee'],2);

$sql = "SELECT * FROM telecomPricing WHERE ProductID = 4";
$result = $db->query($sql);
$price = $result->fetch_assoc();
$tcTVOTC= number_format($price['SetupFee'],2);
$tcTVMRC= number_format($price['MonthlyFee'],2);
$blankLease = "suiteChange();";

if (isset($_GET['q'])){
  $blankLease = "";
$sql = "SELECT * FROM executiveLeasePending WHERE pendingLeaseID = ".$_GET['q'];
$result = $db->query($sql);
$pendingLeaseData = $result->fetch_assoc();
}
$moveindate = date('Y', strtotime($pendingLeaseData['moveInDate'])).", ".(intval(date('n', strtotime($pendingLeaseData['moveInDate'])))).", ".date('j', strtotime($pendingLeaseData['moveInDate']));

if ($pendingLeaseData['moveInDate']==''){
$moveindate = date('Y, m, d');
$moveindateinput = date('m/d/Y');
}else{
$moveindate = date('Y, m, d', strtotime($pendingLeaseData['moveInDate']));
$moveindateinput = date('m/d/Y',strtotime($pendingLeaseData['moveInDate']));
}

$telecom = explode(',',$pendingLeaseData['telecomArray']);


?>
<script>


function calcTelecom() {
  if (document.getElementById('cbFirstStatic').checked){
    $('#trAdditionalStatics').show();
  }else{
    $('#inputAdditionalStatic').val(0);
    $('#trAdditionalStatics').hide();}
  var totalSetupFee = 0;
  var totalMonthlyFee = 0;
  var tempSetupFee = 0;
  var tempMonthlyFee = 0;
  <?php

  $sql = "SELECT * FROM telecomPricing WHERE ProductID < 3";
  $result = $db->query($sql);
  echo "var tcPackagePricing = [0,0";
  while($row = $result->fetch_assoc()) {
    echo ",".$row['SetupFee'];
    echo ",".$row['MonthlyFee'];
  }
echo "];";?>

lamda = parseInt($('input[name=tcPackage]:checked','#rbtcPackage').val());

totalSetupFee = tcPackagePricing[lamda];
totalMonthlyFee = tcPackagePricing[lamda+1];

<?php

  $sql = "SELECT * FROM telecomPricing WHERE ProductID > 3 AND ProductID <> 9";


  $result = $db->query($sql);
  while($row = $result->fetch_assoc()) {
    if ( $row['inputType'] == 'input' ){
      echo "tempSetupFee = parseFloat($('#input" . $row['variableID'] . "').val())*". $row['SetupFee'].";"."\n";
      echo "tempMonthlyFee = parseFloat($('#input" . $row['variableID'] . "').val())*". $row['MonthlyFee'].";"."\n";
      //echo "var tempMonthlyFee = $('#input" . $row['variableID'] . "').val() * parseFloat(" . $row['MonthlyFee'].");"."\n";
      echo "$('#tc".$row['variableID']."OTC').text(currencyFormatter.format(tempSetupFee));"."\n";
      echo "$('#tc".$row['variableID']."MRC').text(currencyFormatter.format(tempMonthlyFee));"."\n";
      echo "$('#tc".$row['variableID']."Total').text(currencyFormatter.format(tempSetupFee+tempMonthlyFee));"."\n";

    }
    if ( $row['inputType'] == 'cb'){
      echo " if ( document.getElementById('cb".$row['variableID']."').checked){";


      echo "tempSetupFee = ".$row['SetupFee'].";"."\n";
      echo "tempMonthlyFee = ".$row['MonthlyFee'].";"."\n";

      echo "$('#tc".$row['variableID']."OTC').text(currencyFormatter.format(". $row['SetupFee']."));"."\n";
      echo "$('#tc".$row['variableID']."MRC').text(currencyFormatter.format(". $row['MonthlyFee']."));"."\n";
      $lamda = floatval($row['SetupFee']) + floatval($row['MonthlyFee']);
      echo "$('#tc".$row['variableID']."Total').text(currencyFormatter.format(".$lamda."));"."\n";
      echo "}else{";
      echo "tempSetupFee = 0;"."\n";
      echo "tempMonthlyFee = 0;"."\n";
      echo "$('#tc".$row['variableID']."OTC').text('');"."\n";
      echo "$('#tc".$row['variableID']."MRC').text('');"."\n";
      echo "$('#tc".$row['variableID']."Total').text('');"."\n";

      echo "}";
    }
    echo "totalSetupFee += tempSetupFee;"."\n";
    echo "totalMonthlyFee += tempMonthlyFee;"."\n";

  }

  ?>

foobar = [totalSetupFee, totalMonthlyFee, totalSetupFee+totalMonthlyFee];
return foobar;

}



function loadLease() {
  $('#inputSuiteNumber').val('<?php echo  $pendingLeaseData['suiteNumber'];?>')
  $('#inputleaseName').val('<?php echo  mb_escape($pendingLeaseData['tenantName']);?>');
  $('#inputBaseRent').val(<?php echo $pendingLeaseData['rent']?>);
  $('#selectTerm').val(<?php echo $pendingLeaseData['leaseTerm']?>)

  $('#inputMoveInDate').val('<?php echo $moveindateinput;?>');

  $('#inputContactName').val('<?php echo mb_escape($pendingLeaseData['contactName']);?>');
  $('#inputAddress1').val('<?php echo mb_escape($pendingLeaseData['contactAddress1']);?>');

  $('#inputAddress2').val('<?php echo mb_escape($pendingLeaseData['contactAddress2']);?>');

  $('#inputContactPhone').val('<?php echo $pendingLeaseData['contactPhone'];?>');
  $('#inputContactCell').val('<?php echo $pendingLeaseData['contactCell'];?>');
  $('#inputContactEmail').val('<?php echo $pendingLeaseData['contactEmail'];?>');

  <?php $directory = explode("**", $pendingLeaseData['directory']);?>

  $('#inputDirectoryLine1').val('<?php echo mb_escape($directory[0]);?>');
  $('#inputDirectoryLine2').val('<?php echo mb_escape($directory[1]);?>');


  /*
  0) Package
  1) phone Lines
  2) Phone Answering boolval
  3) mirror image Devices
  4) power Adapters
  5) efaxes
  6) static IPs
  7) tvservice boolval
  8) internet access boolval
  9) internet access included in rents
  */


  $('#inputAdditionalLines').val(<?php echo $telecom[1];?>);

  <?php if($telecom[2] == 1){ echo "$('#cbPhoneAnswering').prop('checked', true);";}?>
  $('#inputMirrorImage').val(<?php echo $telecom[3];?>);
  $('#inputPowerAdapter').val(<?php echo $telecom[4];?>);

  $('#inputEfax').val(<?php echo $telecom[5];?>);

  <?php if ($telecom[6] > 0){
    $lamda = intval($telecom[6]) -1;
  echo "$('#cbFirstStatic').prop('checked', true); $('#inputAdditionalStatic').val($lamda);";
  }
  ?>

  //$('#cbTV').prop('checked', true);

  $('#tcPackage<?php echo $telecom[0];?>').prop('checked', true);
  checkIfAcceptablePrice();
}

function telecomString(){
lamda = $("input:radio[name=tcPackage]:checked").val();
lamda += "," + $("#inputPhoneLines").val();
if (document.getElementById('cbPhoneAnswering').checked){lamda +=",1";}else{lamda +=",0";}
lamda += "," + $("#inputMirrorDevice").val();
lamda += "," + $("#inputPowerAdapter").val();
lamda += "," + $("#inputEfax").val();
if (document.getElementById('cbPhoneAnswering').checked){
  totalStatics = 1+$("#inputAdditionalStatic").val();
  lamda +=","+totalStatics;}else{lamda +=",0";}

if (document.getElementById('cbTV').checked){lamda +=",1,1";}else{lamda +=",0,1";}

return lamda;
}


function modifiersString(){
if (document.getElementById('3moFree').checked){lamda ="1";}else{lamda ="0";}
if (document.getElementById('restmoFree').checked){lamda +="**1";}else{lamda +="**0";}
if (document.getElementById('taxExempt').checked){lamda +="**1";}else{lamda +="**0";}
if (document.getElementById('guarantee').checked){lamda +="**1";}else{lamda +="**0";}
if (document.getElementById('docReview').checked){lamda +="**1";}else{lamda +="**0";}
return lamda;
}


function saveProspectiveLease(){
if (checkForm() == false){console.log ('saveProspectiveLease return false'); return false;}

<?php if (isset($_GET['q'])){
  echo "var leaseid = ". $_GET['q'].';';
  echo "action = 'update';";
}else{
  echo "var leaseid = 'none';";
  echo "action = 'new';";}?>

i=2;
furnitureCount = document.getElementById("furniture1").value;
while(i <= 8){
furnitureCount += ","+document.getElementById("furniture"+i).value;
i++;
}

furnitureAdditional = $("#inputFurniture6").val()+"**"+$("#inputFurniture7").val()+"**"+$("#inputFurniture8").val();
bldg = $("#inputSuiteNumber").find(':selected').data('building');
console.log(bldg);
leaseData = {
action : action,
leaseID: leaseid,
modifiers: modifiersString(),
status: checkIfAcceptablePrice(),
tenantName: $("#inputleaseName").val(),
leaseTerm: 1,
Property: bldg,
suiteNumber: $("#inputSuiteNumber").val(),
moveInDate:$("#inputMoveInDate").val(),
contactName:$("#inputContactName").val(),
contactAddress1:$("#inputAddress1").val(),
contactAddress2:$("#inputAddress2").val(),
contactPhone:$("#inputContactPhone").val(),
contactCell:$("#inputContactCell").val(),
contactEmail:$("#inputContactEmail").val(),
directory:$("#inputDirectoryLine1").val()+"**"+$("#inputDirectoryLine2").val(),
doorSign:$("#inputDoorSign").val(),
rent:$("#inputBaseRent").val(),
furnitureRent:$("#furnitureRent").val(),
telecomArray:telecomString(),
furnitureCount:furnitureCount,
furnitureAdditional:furnitureAdditional,
leaseTerm: $("#selectTerm").val()
}
console.log("I'm Still Alive here");
var jqxhr = $.post( '/dbFunctions/dbExecutiveLease.php', leaseData, function() {
  //alert( "success" );
})
  .done(function(data) {
    console.log('data = '+data);
    $("#leaseWarning").removeClass('alert-danger');

    foo = data.split("|");


    if (foo[0] == "1"){
      console.log('I worked at least');
      window.location.href="/leasing/executiveLeaseReview.php";
    }else{
//      $("#sqloutput").html(foo[1]);
     $("#leaseWarning").addClass('alert-danger');
      $("#leaseWarningText").html(foo[1]);
        }
  })
  .fail(function() {
    alert( "error" );
  })
  .always(function() {
  //  alert( "finished" );
  });
    }

    function suiteChange(){
      suite = $("#inputSuiteNumber").val();
      rent = $("#inputSuiteNumber").find(':selected').data('rent');
      sqft = $("#inputSuiteNumber").find(':selected').data('sqft');
      $("#inputBaseRent").val(parseInt(rent));

    }

    function checkIfAcceptablePrice(){
      term = parseInt($('#selectTerm').val());
    //  term = 12;
      if (term == 12){maxDiscount = 0.75;}
      if (term >= 6 && term < 12){maxDiscount = 0.8;}
      if (term >= 3 && term < 6){maxDiscount = 0.85;}
      if ( term < 3){maxDiscount = 0.9;}

      suite = $("#inputSuiteNumber").val();
      rent = $("#inputSuiteNumber").find(':selected').data('rent');
      if ($("#inputBaseRent").val() < (parseInt(rent)* maxDiscount)){
        $("#leaseWarning").addClass('alert-warning');
        $("#leaseWarningText").html('<strong>Out of Acceptable Range</strong><br>This lease will require management approval');
        $("#leaseWarning").show();
        return 2;
      } else {$("#leaseWarning").hide(); return 1;}
    }





</script>
