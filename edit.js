<script>


function calcTelecom() {
  var totalSetupFee = 0;
  var totalMonthlyFee = 0;
  var tempSetupFee = 0;
  var tempMonthlyFee = 0;
  tempSetupFee = parseFloat($('#inputPhoneLines').val())*50;
tempMonthlyFee = parseFloat($('#inputPhoneLines').val())*35;
$('#tcPhoneLinesOTC').text(currencyFormatter.format(tempSetupFee));$('#tcPhoneLinesMRC').text(currencyFormatter.format(tempMonthlyFee));$('#tcPhoneLinesTotal').text(currencyFormatter.format(tempSetupFee+tempMonthlyFee));totalSetupFee += tempSetupFee;
totalMonthlyFee += tempMonthlyFee;
 if ( document.getElementById('cbPhoneAnswering').checked){tempSetupFee = 10;
tempMonthlyFee = 25;
$('#tcPhoneAnsweringOTC').text(currencyFormatter.format(10));$('#tcPhoneAnsweringMRC').text(currencyFormatter.format(25));$('#tcPhoneAnsweringTotal').text(currencyFormatter.format(35));}else{tempSetupFee = 0;tempMonthlyFee = 0;$('#tcPhoneAnsweringOTC').text('');$('#tcPhoneAnsweringMRC').text('');$('#tcPhoneAnsweringTotal').text('');}totalSetupFee += tempSetupFee;
totalMonthlyFee += tempMonthlyFee;
tempSetupFee = parseFloat($('#inputMirrorDevice').val())*25;
tempMonthlyFee = parseFloat($('#inputMirrorDevice').val())*25;
$('#tcMirrorDeviceOTC').text(currencyFormatter.format(tempSetupFee));$('#tcMirrorDeviceMRC').text(currencyFormatter.format(tempMonthlyFee));$('#tcMirrorDeviceTotal').text(currencyFormatter.format(tempSetupFee+tempMonthlyFee));totalSetupFee += tempSetupFee;
totalMonthlyFee += tempMonthlyFee;
tempSetupFee = parseFloat($('#inputPowerAdapter').val())*30;
tempMonthlyFee = parseFloat($('#inputPowerAdapter').val())*0;
$('#tcPowerAdapterOTC').text(currencyFormatter.format(tempSetupFee));$('#tcPowerAdapterMRC').text(currencyFormatter.format(tempMonthlyFee));$('#tcPowerAdapterTotal').text(currencyFormatter.format(tempSetupFee+tempMonthlyFee));totalSetupFee += tempSetupFee;
totalMonthlyFee += tempMonthlyFee;
tempSetupFee = parseFloat($('#inputEfax').val())*50;
tempMonthlyFee = parseFloat($('#inputEfax').val())*25;
$('#tcEfaxOTC').text(currencyFormatter.format(tempSetupFee));$('#tcEfaxMRC').text(currencyFormatter.format(tempMonthlyFee));$('#tcEfaxTotal').text(currencyFormatter.format(tempSetupFee+tempMonthlyFee));totalSetupFee += tempSetupFee;
totalMonthlyFee += tempMonthlyFee;
 if ( document.getElementById('cbInternet').checked){tempSetupFee = 100;
tempMonthlyFee = 50;
$('#tcInternetOTC').text(currencyFormatter.format(100));$('#tcInternetMRC').text(currencyFormatter.format(50));$('#tcInternetTotal').text(currencyFormatter.format(150));}else{}totalSetupFee += tempSetupFee;
totalMonthlyFee += tempMonthlyFee;
 if ( document.getElementById('cbFirstStatic').checked){tempSetupFee = 50;
tempMonthlyFee = 25;
$('#tcFirstStaticOTC').text(currencyFormatter.format(50));$('#tcFirstStaticMRC').text(currencyFormatter.format(25));$('#tcFirstStaticTotal').text(currencyFormatter.format(75));}else{tempSetupFee = 0;tempMonthlyFee = 0;$('#tcFirstStaticOTC').text('');$('#tcFirstStaticMRC').text('');$('#tcFirstStaticTotal').text('');}totalSetupFee += tempSetupFee;
totalMonthlyFee += tempMonthlyFee;
tempSetupFee = parseFloat($('#inputAdditionalStatic').val())*50;
tempMonthlyFee = parseFloat($('#inputAdditionalStatic').val())*10;
$('#tcAdditionalStaticOTC').text(currencyFormatter.format(tempSetupFee));$('#tcAdditionalStaticMRC').text(currencyFormatter.format(tempMonthlyFee));$('#tcAdditionalStaticTotal').text(currencyFormatter.format(tempSetupFee+tempMonthlyFee));totalSetupFee += tempSetupFee;
totalMonthlyFee += tempMonthlyFee;
 if ( document.getElementById('cbTV').checked){tempSetupFee = 120;
tempMonthlyFee = 60;
$('#tcTVOTC').text(currencyFormatter.format(120));$('#tcTVMRC').text(currencyFormatter.format(60));$('#tcTVTotal').text(currencyFormatter.format(180));}else{tempSetupFee = 0;tempMonthlyFee = 0;$('#tcTVOTC').text('');$('#tcTVMRC').text('');$('#tcTVTotal').text('');}totalSetupFee += tempSetupFee;
totalMonthlyFee += tempMonthlyFee;
//console.log("Total Setup Fee:" + totalSetupFee);
console.log('is checked: ' + document.getElementById('cbFirstStatic').checked);
foobar = [totalSetupFee, totalMonthlyFee, totalSetupFee+totalMonthlyFee];
return foobar;
//console.log("temp set up fee: "+tempSetupFee);

}

function loadLease() {
  //leaseWarningText
  $('#inputleaseName').val('Jimmy J. Tenant');

  //inputSuiteNumber
  $('#inputBaseRent').val(500);

  $('#inputMoveInDate').val('05/21/2021');
  $('#inputContactName').val('James Jonathan Tenant');
  $('#inputAddress1').val('123 Main Street');
  $('#inputAddress2').val('Anywhere, USA 10303');


  $('#inputContactPhone').val('(914) 471-5828');
  $('#inputContactEmail').val('jjtentant@tenantcorp.com');
    $('#InputDirectoryLine1').val('James Jonathan poop');
  $('#InputDirectoryLine2').val('');
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

  //inputTelecomPackage1 - 4 (radio button)
  $('#inputAdditionalLines').val(1);

    $('#inputMirrorImage').val(1);
  $('#inputPowerAdapter').val(1);

  $('#inputEfax').val(1);

  $('#cbFirstStatic').prop('checked', true); $('#inputAdditionalStatic').val(4);
  $('#cbTV').prop('checked', true);

  $('#tcPackage1').prop('checked', true);
  /*
  1,2,3,4,5,6,7,8
  furniture1-8').val('');
  inputFurniture6-8
  incentive1-3
  guarantee1
  guarantee2
  */
}
