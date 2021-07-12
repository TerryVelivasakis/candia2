<?php
require $_SERVER["DOCUMENT_ROOT"].'includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';
require $_SERVER["DOCUMENT_ROOT"].'php+js/executiveLease.php';
?>

<link rel="stylesheet" href="\style\forms.css">
<body>
<div class="container mt-2">

  <div class="alert alert-dismissible" id="leaseWarning" style="display: none">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <h4 class="alert-heading">Warning!</h4>
    <p class="mb-0" id="leaseWarningText">Best check yo self, you're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna.</p>
  </div>

  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-bs-toggle="tab" href="#basic">Basic Information</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#contact">Contact Information</a>
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
        <div class="form-group col">
          <label for="leaseName" class="form-label ">Tenant Name</label>
          <input type="text" class="form-control" id="inputleaseName" placeholder="Name for Lease">
        </div>
      </div>
      <div class="form-group row mt-4">
        <div class="form-group col">
          <label for="exampleSelect1" class="form-label">Suite Number</label>
          <select class="form-select" id="inputSuiteNumber" onchange="suiteChange()">
            <option value = 1 data-rent=500 data-sqft= 100> Suite 1</option>
            <?php
            $sql = "SELECT * FROM `executiveSuites`";
            $result = $db->query($sql);
            while($row = $result->fetch_assoc()) {
              echo "<option value =".$row['SuiteNumber']." data-rent=".$row['TargetRent']." data-sqft=".$row['SqFt'].">".$row['SuiteNumber']."</option>";
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

        <div class="form-group col">
          <label for="moveInDate" class="form-label">Move In Date</label>
          <div class="input-group date">
            <input type="text" class="form-control" id="inputMoveInDate" value=>
          </div>
        </div>
      </div>
    </div>
    <!-- end of Basic Info Tab -->

    <!-- contact info tab -->
    <div class="tab-pane fade " id="contact">
      <div class="form-group row mt-4">
        <div class="form-group col">
          <label for="tenantName" class="form-label">Contact Name</label>
          <input type="text" class="form-control" id="inputContactName" placeholder="Contact Name">
        </div>
      </div>
      <div class="form-group row mt-4">
        <div class="form-group col">
          <label for="tenantName" class="form-label ">Address</label>
          <input type="text" class="form-control" id="inputAddress1" placeholder="Street Address">
        </div>

        <div class="form-group col">
          <label for="tenantName" class="form-label ">City, State Zip</label>
          <input type="text" class="form-control" id="inputAddress2" placeholder="City, State Zip">
        </div>
      </div>

      <div class="form-group row mt-4">
        <div class="form-group col-4">
          <label for="tenantName" class="form-label ">Phone</label>
          <input type="text" class="form-control" id="inputContactPhone" placeholder="Phone Number">
        </div>

        <div class="form-group col">
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
              <tr><td><div class="form-check form-switch ml-3"><input class="form-check-input " type="checkbox" id="incentive1">Third Month Free</div></td></tr>
              <tr><td><div class="form-check form-switch ml-3"><input class="form-check-input " type="checkbox" id="incentive2">Third Month Free</div></td></tr>
              <tr><td><div class="form-check form-switch ml-3"><input class="form-check-input " type="checkbox" id="incentive3">Third Month Free</div></td></tr>
              <tr><th class="table-primary">Additional Guarantees</th></tr>
              <tr><td><div class="form-check form-switch ml-3"><input class="form-check-input " type="checkbox" id="guarantee1">Personal Guarantee</div></td></tr>
              <tr><td><div class="form-check form-switch ml-3"><input class="form-check-input " type="checkbox" id="guarantee2">Document Review</div></td></tr>
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
</body>
<script>
$( document ).ready(function() {
//$('#incentives').hide();
<?php echo $blankLease;?>

$('#moveInDate').datepicker({startDate: 0,autoclose: true});

$("#inputMoveInDate").datepicker().datepicker("setDate", new Date('<?php echo $moveindate;?>'));
$("#leaseWarning").hide();

$("#modalButton").on("click",function(){
var totalRent =   $("#inputBaseRent").val()*(1+SalexTax);
var telecom = calcTelecom()
var SecurityDeposit = $("#inputBaseRent").val()*1.25;
var DueAtSigning = totalRent + telecom[2] + SecurityDeposit + $('#furnitureRent').val();

var leaseValues = [$("#inputBaseRent").val(), $("#inputBaseRent").val()*SalexTax, totalRent, telecom[0],
      telecom[1], telecom[2], SecurityDeposit, $('#furnitureRent').val() ,DueAtSigning, DueAtSigning*.05, DueAtSigning*1.05];
$('.abs').each(function(index){
  $('.abs:eq('+index+')').html(currencyFormatter.format(leaseValues[index]));
});
$("#modalDueAtSigning").toggle();

});
loadLease();
calcTelecom();

$(':input:not(#inputSuiteNumber)').change(function(){
  calcTelecom();
  checkIfAcceptablePrice();
  document.getElementById('cbInternet').checked = true;
});
});


</script>
