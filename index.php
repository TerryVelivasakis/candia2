<?php
require $_SERVER["DOCUMENT_ROOT"].'/includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';
?>

<div class="container">
  <div class='mt-3'></div>
  <div class='row'>
    <div class="col-3">
      <div class='row '>
        <?php include $_SERVER["DOCUMENT_ROOT"].'/mainPage/actionList.php';?>
      </div>
      <div class='row '>
        <?php include $_SERVER["DOCUMENT_ROOT"].'/mainPage/tenantInfo.php';?>
      </div>
    </div>
    <div class="col ">
      <div class='row'>
        <div class="col-8">
        <?php include $_SERVER["DOCUMENT_ROOT"].'/mainPage/incidentalCharge.php';?>
      </div>
      <div class='col-4 mpFramedInner'>
        <?php include $_SERVER["DOCUMENT_ROOT"].'/mainPage/checkLog.php';?>
      </div>
      </div>
      <div class='row mt-3 mpFramedInner mx-1'>
        <?php include $_SERVER["DOCUMENT_ROOT"].'/mainPage/workOrders.php';?>
      </div>
    </div>
    <div class="col-3 ">
      <?php include $_SERVER["DOCUMENT_ROOT"].'/mainPage/phoneStatus.php';?>
    </div>
  </div>
</div>
