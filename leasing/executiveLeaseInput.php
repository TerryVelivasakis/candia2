<?php
require $_SERVER["DOCUMENT_ROOT"].'includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';
require $_SERVER["DOCUMENT_ROOT"].'php+js/functExecutiveLease.php';
session_start();
?>

<link rel="stylesheet" href="\style\forms.css">
<body>
<div class="container mt-2">

  <div class="alert alert-dismissible" id="leaseWarning" style="display: none">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <p class="mb-0" id="leaseWarningText">Best check yo self, you're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna.</p>
  </div>

  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-bs-toggle="tab" href="#basic">Basic Information</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#signage">Signage</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#telecom">Telecom</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#furniture">Furniture</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#misc" id="incentives">Incentives and Personal Guarantee</a>
    </li>
  </ul>

  <div id="myTabContent" class="tab-content">
    <!-- Start of Basic Info Tab -->
    <div class="tab-pane fade show active p-1" id="basic">
      <div class="form-group row mt-4">
        <div class="form-group col require" id='divTenantName'>
          <label for="leaseName" class="form-label ">Tenant Name</label>
          <input type="text" class="form-control" id="inputleaseName" placeholder="Name for Lease">
        </div>
      </div>
      <div class="form-group row mt-4">
        <div class="form-group col">
          <label for="exampleSelect1" class="form-label">Suite Number</label>
          <select class="form-select" id="inputSuiteNumber" onchange="suiteChange()">

            <?php
            $sql = "SELECT * FROM `executiveSuites` es WHERE BuildingID = ".$_SESSION['property']." AND NOT EXISTS ( SELECT NULL FROM `executiveLease` el WHERE el.suiteNumber = es.SuiteNumber AND el.Property = es.BuildingID AND el.status = 1 )";
            $result = $db->query($sql);
            while($row = $result->fetch_assoc()) {
              echo "<option value ='".$row['SuiteNumber']."' data-rent=".$row['TargetRent']." data-sqft=".$row['SqFt']." data-building=".$row['BuildingID'].">".$row['SuiteNumber']." - "
              .number_format($row['SqFt'],0)."sf</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group col">
          <label class="form-label">Base Rent</label>

          <div class="input-group">
            <span class="input-group-text">$</span>
            <input type="number" id="inputBaseRent" class="form-control" aria-label="Amount (to the nearest dollar)">
            <span class="input-group-text">.00</span>
          </div>
        </div>

        <div class="form-group col-2">
          <label for="moveInDate" class="form-label">Move In Date</label>
          <div class="input-group date">
            <input type="text" class="form-control" id="inputMoveInDate" value=>
          </div>
        </div>
        <div class="form-group col-2">
          <label for="moveInDate" class="form-label">Term</label>
          <div class="input-group">
            <select id='selectTerm' class='form-select'>
              <option value = 1>Month to Month</option>
              <option value = 2>2 Months</option>
              <option value = 3>3 Months</option>
              <option value = 4>4 Months</option>
              <option value = 5>5 Months</option>
              <option value = 6>6 Months</option>
              <option value = 7>7 Months</option>
              <option value = 8>8 Months</option>
              <option value = 9>9 Months</option>
              <option value = 10>10 Months</option>
              <option value = 11>11 Months</option>
              <option value = 12>1 Year</option>
            </select>
          </div>
        </div>
      </div>
<hr>
      <div class="form-group row mt-4">
        <div class="form-group col require">
          <label for="tenantName" class="form-label">Contact Name</label>
          <input type="text" class="form-control" id="inputContactName" placeholder="Contact Name">
        </div>
      </div>
      <div class="form-group row mt-4">
        <div class="form-group col require">
          <label for="tenantName" class="form-label ">Address</label>
          <input type="text" class="form-control" id="inputAddress1" placeholder="Street Address">
        </div>

        <div class="form-group col require">
          <label for="tenantName" class="form-label ">City, State Zip</label>
          <input type="text" class="form-control" id="inputAddress2" placeholder="City, State Zip">
        </div>
      </div>

      <div class="form-group row mt-4 ">
        <div class="form-group col-3 requirePhone">
          <label for="tenantName" class="form-label ">Primary Phone</label>
          <input type="text" class="form-control phone" id="inputContactPhone" placeholder="Phone Number">
        </div>
        <div class="form-group col-3">
          <label for="tenantName" class="form-label requirePhone">Cell</label>
          <input type="text" class="form-control phone" id="inputContactCell" placeholder="Cell Number">
        </div>

        <div class="form-group col require">
          <label for="tenantName" class="form-label ">Email</label>
          <input type="text" class="form-control" id="inputContactEmail" placeholder="Contact Name">
        </div>
      </div>

    </div>
    <!-- contact info tab -->

    <!-- Signage tab -->
    <div class="tab-pane fade" id="signage">
      <div class="form-group row mt-4">
        <div class="form-group col-5">
          <label for="tenantName" class="form-label ">Directory</label>
          <input type="text" class="form-control" id="inputDirectoryLine1" placeholder="Directory Line 1">
          <input type="text" class="form-control" id="inputDirectoryLine2" placeholder="Directory Line 2">
        </div>
      </div>
      <div class="form-group row mt-4">
        <div class="form-group col-5">
          <label for="tenantName" class="form-label ">Door Sign</label>
          <input type="text" class="form-control" id="inputDoorSign" placeholder="Contact Name">
        </div>
      </div>
    </div>
    <!-- Signage tab -->

    <!-- Telecom tab -->
    <div class="tab-pane fade" id="telecom">
      <div class="form-group row mt-4">
        <div class="form-group col">
          <div class="btn-group" role="group" aria-label="Basic radio toggle button group" id="rbtcPackage">
            <input type="radio" class="btn-check tcPackage" name="tcPackage" id="tcPackage0" autocomplete="off" checked="true" value=0>
            <label class="btn btn-outline-primary" for="tcPackage0">None</label>

            <input type="radio" class="btn-check tcPackage" name="tcPackage" id="tcPackage1" autocomplete="off" value=1>
            <label class="btn btn-outline-primary" for="tcPackage1">Phone, Fax, and Phone Answering</label>

            <input type="radio" class="btn-check tcPackage" name="tcPackage" id="tcPackage2" autocomplete="off" value=2>
            <label class="btn btn-outline-primary" for="tcPackage2">Phone and Fax</label>

            <input type="radio" class="btn-check tcPackage" name="tcPackage" id="tcPackage3" autocomplete="off" value=3>
            <label class="btn btn-outline-primary" for="tcPackage3">Phone Only</label>

          </div>

        </div>
      </div>
      <div class="form-group row mt-4">
        <div class="w-75">
          <table class="table table-sm">
            <tr><th colspan=7 class="table-primary">Add On Services</td></tr>
              <tr><td></td><th>Quantity</th><th>Setup Fee</th><th>Monthly</th><th>Total OTC</th><th>Total MRC</th><th>Total First Month</th></tr>
              <tr><td width="250px">Additional Phone Lines</td>
                <td> <input class="form-control form-control-sm leaseInput" type="number" value=0 min=0 id="inputPhoneLines"></td>
                <td>$<?php echo $tcPhoneLinesOTC;?></td>
                <td>$<?php echo $tcPhoneLinesMRC;?></td>
                <td><span id="tcPhoneLinesOTC"></span></td>
                <td><span id="tcPhoneLinesMRC"></span></td>
                <td><span id="tcPhoneLinesTotal"></span></td>
              </tr>

              <tr><td width="250px">Phone Answering</td>
                <td><div class="form-check form-switch ml-3"><input class="form-check-input " type="checkbox" id="cbPhoneAnswering"></div></td>
                <td>$<?php echo $tcPhoneAnsweringOTC;?></td>
                <td>$<?php echo $tcPhoneAnsweringMRC;?></td>
                <td><span id="tcPhoneAnsweringOTC"></span></td>
                <td><span id="tcPhoneAnsweringMRC"></span></td>
                <td><span id="tcPhoneAnsweringTotal"></span></td>
              </tr>

              <tr><td width="250px">Mirror Image Devices</td>
                <td> <input class="form-control form-control-sm leaseInput" type="number" value=0 min=0  id="inputMirrorDevice"></td>
                <td>$<?php echo $tcMirrorDeviceOTC;?></td>
                <td>$<?php echo $tcMirrorDeviceMRC;?></td>
                <td><span id="tcMirrorDeviceOTC"></span></td>
                <td><span id="tcMirrorDeviceMRC"></span></td>
                <td><span id="tcMirrorDeviceTotal"></span></td>
              </tr>

              <tr><td width="250px">Phone Power Adapter</td>
                <td> <input class="form-control form-control-sm leaseInput" type="number" value=0 min=0 id="inputPowerAdapter"></td>
                <td>$<?php echo $tcPowerAdapterOTC;?></td>
                <td>$<?php echo $tcPowerAdapterMRC;?></td>
                <td><span id="tcPowerAdapterOTC"></span></td>
                <td><span id="tcPowerAdapterMRC"></span></td>
                <td><span id="tcPowerAdapterTotal"></span></td>
              </tr>
              <tr><th colspan=7 class="table-primary">Additional Services</td></tr>
                <tr><td></td><th>Quantity</th><th>Setup Fee</th><th>Monthly</th><th>Total OTC</th><th>Total MRC</th><th>Total First Month</th></tr>

                <tr><td width="250px">Additional Efax Lines</td>
                  <td> <input class="form-control form-control-sm leaseInput" type="number" value=0 min=0 id="inputEfax"></td>
                  <td>$<?php echo $tcEfaxOTC;?></td>
                  <td>$<?php echo $tcEfaxMRC;?></td>
                  <td><span id="tcEfaxOTC"></span></td>
                  <td><span id="tcEfaxMRC"></span></td>
                  <td><span id="tcEfaxTotal"></span></td>
                </tr>

                <tr><td width="250px">Internet Service</td>
                  <td><div class="form-check form-switch ml-3"><input class="form-check-input " type="checkbox" checked="checked" id="cbInternet"></div></td>
                  <td>--</td>
                  <td>--</td>
                  <td colspan=3>Included in Rent</td>

                </tr>

                <tr ><td width="250px">First Static IP</td>
                  <td><div class="form-check form-switch ml-3"><input class="form-check-input " type="checkbox" id="cbFirstStatic"></div></td>
                  <td>$<?php echo $tcFirstStaticOTC;?></td>
                  <td>$<?php echo $tcFirstStaticMRC;?></td>
                  <td><span id="tcFirstStaticOTC"></span></td>
                  <td><span id="tcFirstStaticMRC"></span></td>
                  <td><span id="tcFirstStaticTotal"></span></td>
                </tr>

                <tr id="trAdditionalStatics"><td width="250px">Additional Static IPs</td>
                  <td> <input class="form-control form-control-sm leaseInput" type="number" value=0 min=0 id="inputAdditionalStatic"></td>
                  <td>$<?php echo $tcAdditionalStaticOTC;?></td>
                  <td>$<?php echo $tcAdditionalStaticMRC;?></td>
                  <td><span id="tcAdditionalStaticOTC"></span></td>
                  <td><span id="tcAdditionalStaticMRC"></span></td>
                  <td><span id="tcAdditionalStaticTotal"></span></td>
                </tr>


                <tr><td width="250px">Business TV Service <br><font size="1">Including HD DVR Cablebox</td>
                  <td><div class="form-check form-switch ml-3"><input class="form-check-input " type="checkbox" id="cbTV"></div></td>
                  <td>$<?php echo $tcTVOTC;?></td>
                  <td>$<?php echo $tcTVMRC;?></td>
                  <td><span id="tcTVOTC"></span></td>
                  <td><span id="tcTVMRC"></span></td>
                  <td><span id="tcTVTotal"></span></td>
                </tr>

              </table>


            </div>
          </div>


        </div>
        <!-- Telecom tab -->

        <!-- Furniture tab -->
        <div class="tab-pane fade" id="furniture">
          <div class="w-50 m-4">
            <table class="table table-sm">
              <tr><th width="115px">Quantity</th><th>Description</th></tr>
              <tr>
                <td> <input class="form-control form-control-sm leaseInput" type="number" value=0 min=0 id="furniture1"></td>
                <td>L Shaped Desk</td>
              </tr>
              <tr>
                <td> <input class="form-control form-control-sm leaseInput" type="number" value=0 min=0 id="furniture2"></td>
                <td>Rectangle Desk</td>
              </tr>
              <tr>
                <td> <input class="form-control form-control-sm leaseInput" type="number" value=0 min=0 id="furniture3"></td>
                <td>Executive Chair</td>
              </tr>
              <tr>
                <td> <input class="form-control form-control-sm leaseInput" type="number" value=0 min=0 id="furniture4"></td>
                <td>Guest Chair</td>
              </tr>
              <tr>
                <td> <input class="form-control form-control-sm leaseInput" type="number" value=0 min=0 id="furniture5"></td>
                <td>Filing Cabinet</td>
              </tr>
              <tr>
                <td> <input class="form-control form-control-sm leaseInput" type="number" value=0 min=0 id="furniture6"></td>
                <td><input type="text" class="form-control" id="inputFurniture6" placeholder="Additional Furniture"></td>
              </tr>
              <tr>
                <td> <input class="form-control form-control-sm leaseInput" type="number" value=0 min=0 id="furniture7"></td>
                <td><input type="text" class="form-control" id="inputFurniture7" placeholder="Additional Furniture"></td>
              </tr>
              <tr>
                <td> <input class="form-control form-control-sm leaseInput" type="number" value=0 min=0 id="furniture8"></td>
                <td><input type="text" class="form-control" id="inputFurniture8" placeholder="Additional Furniture"></td>
              </tr>
            </table>
            <label class="form-label">Furniture Rent</label>

            <div class="input-group w-25">
              <span class="input-group-text">$</span>
              <input id ="furnitureRent" type="number" min=0 class="form-control" aria-label="Amount (to the nearest dollar)" value=0>
              <span class="input-group-text">.00</span>
            </div>
          </div>
        </div>
        <!-- Furniture tab -->

        <!-- Misc tab -->
        <div class="tab-pane fade" id="misc">


          <div class="w-50 m-4">
            <table class="table table-sm">
              <tr><th class="table-primary">Incentives</th></tr>
              <tr><td><div class="form-check form-switch"><input class="form-check-input " type="checkbox" id="3moFree">Third Month Free</div></td></tr>
              <tr><td><div class="form-check form-switch"><input class="form-check-input " type="checkbox" id="restmoFree">Remainder of First Month Free</div></td></tr>
              <tr><th class="table-primary">Governmental</th></tr>
              <tr><td><div class="form-check form-switch"><input class="form-check-input " type="checkbox" id="taxExempt">Tax Exempt</div></td></tr>
              <tr><th class="table-primary">Additional Guarantees</th></tr>
              <tr><td><div class="form-check form-switch"><input class="form-check-input " type="checkbox" id="guarantee">Personal Guarantee</div></td></tr>
              <tr><td><div class="form-check form-switch"><input class="form-check-input " type="checkbox" id="docReview">Document Review</div></td></tr>
            </table>
          </div>
        </div>
      </div>





      <button class="btn btn-sm btn-primary mt-3" type="button" onclick='saveProspectiveLease();'>Save Lease</button>

      <button type="button" class="btn btn-sm btn-primary mt-3" id="modalButton">
        Due At Signing
      </button>


    <!-- Due At Signing Modal -->

    <div class="modal" id="modalDueAtSigning">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
          <div class="modal-header">
            <h5 class="modal-title">Due At Signing</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="$('#modalDueAtSigning').hide();">
              <span aria-hidden="true"></span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-striped">
              <tr><th colspan=4 class="text-center table-primary">Due at Lease Signing</th></tr>
              <tr><th >Rent</th>
                <td>
                  <div class="inputAbstract">First Month Rent</div>
                  <div class="inputAbstract abs" id="absFirstMonthRent">$100.00</div>
                </td>
                <td>
                  <div class="inputAbstract">First Month Sales Tax</div>
                  <div class="inputAbstract abs" id="absFirstMonthSalesTax">$100.00</div>
                </td>
                <td>
                  <div class="inputAbstract">First Month Rent Total</div>
                  <div class="inputAbstract abs" id="absFirstMonthRentTotal">$100.00</div>
                </td>
              </tr>
              <tr><th>Telecom</th>
                <td>
                  <div class="inputAbstract">Telecom Setup Fees</div>
                  <div class="inputAbstract abs" id="absTelecomSetup">$100.00</div>
                </td>
                <td>
                  <div class="inputAbstract">First Month Telecom</div>
                  <div class="inputAbstract abs" id="absFirstMonthTelecom">$100.00</div>
                </td>
                <td>
                  <div class="inputAbstract">Total Telecom</div>
                  <div class="inputAbstract abs" id="absTelecomTotal">$100.00</div>
                </td>
              </tr>
              <tr><th>Security Deposit</th>
                <td>
                  <div class="inputAbstract abs" id="absSecurityDeposit">$100.00</div>
                </td>
                <th>Furniture Rent</th>
                  <td>
                    <div class="inputAbstract abs" id="absFurnitureRent">$100.00</div>
                  </td>
              </tr>
              <tr><th>Total Due</th>
                <td>
                  <div class="inputAbstract">Lease Total</div>
                  <div class="inputAbstract abs" id="absLeaseTotal">$100.00</div>
                </td>
                <td>
                  <div class="inputAbstract">Credit Card Fee</div>
                  <div class="inputAbstract abs" id="absCCFee">$100.00</div>
                </td>
                <td>
                  <div class="inputAbstract">Total With Credit Card Fee</div>
                  <div class="inputAbstract abs" id="absLeaseTotalCC">$100.00</div>
                </td>
              </tr>
            </table>
          </div>

        </div>
      </div>
    </div>
</div>

<button onclick='checkForm()'>asdf</button>
</body>
<script>
$( document ).ready(function() {
  $( ".phone" ).focusout( function() {

    phone = $(this).val();

    var phoneTest = new RegExp(/^((\+1)|1)? ?\(?(\d{3})\)?[ .-]?(\d{3})[ .-]?(\d{4})( ?(ext\.? ?|x)(\d*))?$/);

    phone = phone.trim();
    var results = phoneTest.exec(phone);
    console.log(phone);
    if (results !== null && results.length > 8) {

      $(this).val( "(" + results[3] + ") " + results[4] + "-" + results[5] + (typeof results[8] !== "undefined" ? " x" + results[8] : ""));

    }
    else {
       $(this).val( phone);
    }

  });
<?php //echo $blankLease;

if (isset($_GET['q'])){
  echo "loadLease();";
} else {
  echo "suiteChange();";}

?>

$('#moveInDate').datepicker({startDate: 0,autoclose: true});

$("#inputMoveInDate").datepicker().datepicker("setDate", new Date('<?php echo $moveindate;?>'));
$("#leaseWarning").hide();



$("#modalButton").on("click",function(){
if (document.getElementById('taxExempt').checked){
 fltx = 0 ; }else{  fltx = SalexTax;}

var totalRent =   $("#inputBaseRent").val()*(1 + fltx);
var telecom = calcTelecom()
var SecurityDeposit = $("#inputBaseRent").val()*1.25;
var DueAtSigning = totalRent + telecom[2] + SecurityDeposit + parseFloat($('#furnitureRent').val());
var leaseValues = [$("#inputBaseRent").val(), $("#inputBaseRent").val()*fltx, totalRent, telecom[0],
      telecom[1], telecom[2], SecurityDeposit, $('#furnitureRent').val() ,DueAtSigning, DueAtSigning*.05, DueAtSigning*1.05];
$('.abs').each(function(index){
  $('.abs:eq('+index+')').html(currencyFormatter.format(leaseValues[index]));
});
$("#modalDueAtSigning").toggle();

});



calcTelecom();

$(':input:not(#inputSuiteNumber)').change(function(){
  calcTelecom();
  checkIfAcceptablePrice();
  document.getElementById('cbInternet').checked = true;
});
  checkIfAcceptablePrice();





});

function checkForm(){
  missingdata = "";
goodtogo = true;
$("#leaseWarning").removeClass('alert-primary alert-warning alert-danger');
$('.require').each(function(i, obj) {
  $(this).children(":input").removeClass('is-invalid');
  $(this).children(":input").removeClass('is-valid');
if ($(this).children(":input").val() == ""){
  $(this).children(":input").addClass('is-invalid');
  missingdata += $(this).children(":input").attr('placeholder') + " is Required. "
  goodtogo=false;
}else{
$(this).children(":input").addClass('is-valid');

}
});

$("#inputContactCell").removeClass('is-invalid');
$("#inputContactCell").removeClass('is-valid');
$("#inputContactPhone").removeClass('is-invalid');
$("#inputContactPhone").removeClass('is-valid');


if ($("#inputContactCell").val() == "" && $("#inputContactPhone").val() == ""){
  goodtogo = false
  missingdata += "A Phone Number is Required. "
  $("#inputContactCell").addClass('is-invalid');
  $("#inputContactPhone").addClass('is-invalid');
}else{
  $("#inputContactCell").addClass('is-valid');
  $("#inputContactPhone").addClass('is-valid');

}





if (goodtogo == false){
  $("#leaseWarning").addClass('alert-primary');
   $("#leaseWarningText").html('<b>Missing Required Fields</b><br>' + missingdata);
   $("#leaseWarning").show();
 }

return goodtogo;
}



</script>
