<?php require $_SERVER["DOCUMENT_ROOT"].'includes/loadme.php';?>

<div class="container">
  <table class="table">
    <tr><th>Due at Lease Signing</th></tr>
  </table>
  <div class="alert alert-dismissible alert-warning" id="leaseWarning">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <h4 class="alert-heading">Warning!</h4>
    <p class="mb-0">Best check yo self, you're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, <a href="#" class="alert-link">vel scelerisque nisl consectetur et</a>.</p>
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
      <a class="nav-link" data-bs-toggle="tab" href="#misc">Incentives and Personal Guarantee</a>
    </li>
  </ul>

  <div id="myTabContent" class="tab-content">
<!-- Start of Basic Info Tab -->
    <div class="tab-pane fade show active p-1" id="basic">
      <div class="form-group row mt-4">
        <div class="form-group col">
          <label for="leaseName" class="form-label ">Tenant Name</label>
          <input type="text" class="form-control" id="leaseName" placeholder="Name for Lease">
        </div>
      </div>
      <div class="form-group row mt-4">
        <div class="form-group col">
          <label for="exampleSelect1" class="form-label">Suite Number</label>
          <select class="form-select" id="suiteNumber">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
          </select>
        </div>
        <div class="form-group col">
          <label class="form-label">Base Rent</label>

          <div class="input-group">
            <span class="input-group-text">$</span>
            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
            <span class="input-group-text">.00</span>
          </div></div>

          <div class="form-group col">
            <label for="moveInDate" class="form-label">Move In Date</label>
            <div class="input-group date">
              <input type="text" class="form-control" id="moveInDate" value=>
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
      <input type="text" class="form-control" id="leaseName" placeholder="Contact Name">
    </div>
  </div>
  <div class="form-group row mt-4">
    <div class="form-group col">
      <label for="tenantName" class="form-label ">Address</label>
      <input type="text" class="form-control" id="leaseName" placeholder="Contact Name">
    </div>

    <div class="form-group col">
      <label for="tenantName" class="form-label ">City, State Zip</label>
      <input type="text" class="form-control" id="leaseName" placeholder="Contact Name">
    </div>
  </div>

  <div class="form-group row mt-4">
    <div class="form-group col-4">
      <label for="tenantName" class="form-label ">Phone</label>
      <input type="text" class="form-control" id="leaseName" placeholder="Contact Name">
    </div>

    <div class="form-group col">
      <label for="tenantName" class="form-label ">Email</label>
      <input type="text" class="form-control" id="leaseName" placeholder="Contact Name">
    </div>
  </div>

</div>
<!-- contact info tab -->

<!-- Signage tab -->
<div class="tab-pane fade" id="signage">
  <div class="form-group row mt-4">
    <div class="form-group col-5">
      <label for="tenantName" class="form-label ">Directory</label>
      <input type="text" class="form-control" id="directoryLine1" placeholder="Directory Line 1">
      <input type="text" class="form-control" id="directoryLine2" placeholder="Directory Line 2">
    </div>
  </div>
<div class="form-group row mt-4">
    <div class="form-group col-5">
      <label for="tenantName" class="form-label ">Door Sign</label>
      <input type="text" class="form-control" id="leaseName" placeholder="Contact Name">
    </div>
  </div>
</div>
<!-- Signage tab -->
<div class="tab-pane fade" id="telecom">

  <div class="btn-group" role="group" aria-label="Basic radio toggle button group" data-bs-toggle="tooltip" data-bs-placement="bottom" title="No Telecom Services">
    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off"  checked="">
    <label class="btn btn-outline-primary" for="btnradio1">None</label>
    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" checked="">
    <label class="btn btn-outline-primary" for="btnradio2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Phone, Fax, and Phone Answering">VIP</label>
    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" checked="">
    <label class="btn btn-outline-primary" for="btnradio3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Phone and Fax">Executive</label>
    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" checked="">
    <label class="btn btn-outline-primary" for="btnradio3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Phone Only">Basic</label>
  </div>
</div>
<div class="tab-pane fade" id="furniture">
<p>furniture form</p>
</div>
<div class="tab-pane fade" id="misc">
<p>all the other shit</p>
</div>
</div>



<button class="btn btn-lg btn-primary mt-3" type="button" onclick='$("#leaseWarning").toggle();'>Block button</button>


</div>

<script>
$( document ).ready(function() {
$('#moveInDate').datepicker({

clearBtn: true,
startDate: 0,
autoclose: true

});
$("#moveInDate").datepicker().datepicker("setDate", new Date());
$("#leaseWarning").hide();
});


</script>
