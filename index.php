<?php
require $_SERVER["DOCUMENT_ROOT"].'/includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';
session_start();
?>

<div class="container">
  <div class='mt-3'></div>
  <div class='row'>
    <div class="col-3">
      <div class='row '>
        <?php include $_SERVER["DOCUMENT_ROOT"].'/mainPage/actionList.php';?>
      </div>
      <div class='row '>

      </div>
    </div>
    <div class="col ">
      <ul class="nav nav-tabs">

        <li class="nav-item">
          <a class="nav-link active" data-bs-toggle="tab" href="#DentsAndLog">Main</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#WorkOrders">Work Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " data-bs-toggle="tab" href="#tenantInfo">Tenant Info</a>
        </li>
<?php
session_start();
if ($_SESSION['hourly']) {
echo '<li class="nav-item"><a class="nav-link " data-bs-toggle="tab" href="#timeSheet">Time Sheet</a></li>';
}
?>
      </ul>
      <div id="myTabContent" class="tab-content p-2 tabBorder">

        <div class="tab-pane fade show active" id="DentsAndLog">
          <div class='row mpFramedInner mx-1'>
            <?php include $_SERVER["DOCUMENT_ROOT"].'/mainPage/incidentalCharge.php';?>
          </div>
          <div class='row mt-2 mpFramedInner mx-1'>
            <?php include $_SERVER["DOCUMENT_ROOT"].'/mainPage/checkLog.php';?>
          </div>
        </div>
        <div class="tab-pane fade " id="WorkOrders">
          <div class='row mpFramedInner mx-1'>
          <?php include $_SERVER["DOCUMENT_ROOT"].'/mainPage/workOrders.php';?>
        </div>
      </div>
        <div class="tab-pane fade " id="tenantInfo">
          <div class='row mx-1'>
          <?php include $_SERVER["DOCUMENT_ROOT"].'/mainPage/tenantInfo.php';?>
        </div>
        </div>

        <div class="tab-pane fade " id="timeSheet">
          <div class='row mpFramedInner mx-1'>
          <?php include $_SERVER["DOCUMENT_ROOT"].'/mainPage/timeSheet.php';?>
        </div>
      </div>

      </div>

    </div>
    <div class="col-3 ">
      <?php include $_SERVER["DOCUMENT_ROOT"].'/mainPage/phoneStatus.php';?>
    </div>
  </div>
</div>
<?php?>
