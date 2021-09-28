<head>
<title>Candia Holdings Intranet</title>
</head>

<?php
session_start();
//$propertyName = "Candia Tower";
$sql = "SELECT * FROM property WHERE propertyID = ".$_SESSION['property'];
$result = $db->query($sql);
$property = $result->fetch_assoc();
$currentActive = '<span class="visually-hidden">(current)</span>';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary no-print">
  <div class="container-fluid">
    <a class="navbar-brand" id='brandProperty' href="http:\\<?php echo $_SERVER['SERVER_NAME']?>"><?php echo $property['propertyNickname'];?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">



<?php

$headerQuery = "SELECT DISTINCT header FROM nav WHERE access <= ".$_SESSION['access']." ORDER BY headerOrder";
$groups = $db->query($headerQuery);

while($header = $groups->fetch_assoc()) {
  echo '<li class="nav-item dropdown">';
  echo '<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><strong>'.$header['header'].'</strong></a>';
  echo '<div class="dropdown-menu">';
  $linkQuery = "SELECT * FROM nav WHERE Header ='".$header['header']."' ORDER BY linkOrder";
  $links = $db->query($linkQuery);
  while($link = $links->fetch_assoc()) {
    echo '<a class="dropdown-item" href="'.$link['linkURL'].'">'.$link['link'].'</a>';
    if ($link['breakAfter'] == 1){echo '<div class="dropdown-divider"></div>';}
  }
  echo "</div></li>";
}
?>

</ul>
<div class="d-flex" style='margin-right: 6vw'>
<ul class="navbar-nav me-auto mx-5">
  <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-users"></i></a>
  <div class="dropdown-menu">
    <a class="dropdown-item clickable" href="#">Profile</a>
    <a class="dropdown-item clickable" onclick ='$("#userModal").show()'>Change Property</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item clickable" onclick ='logout()'>Log out <i class="fas fa-sign-out-alt"></i></a></li>
  </div>
</ul>

</div>
</div>


</div>
</nav>


<div class="modal" id='userModal'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick ='$("#userModal").hide()'>
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <select class=form-select id='workingProperty'>
          <?php
          $sql = "SELECT * FROM `property`";
          $result = $db->query($sql);
        while($row = $result->fetch_assoc()) {
        echo "<option value = ".$row['propertyID'].">".$row['propertyName']."</option>";
            }
          ?>
        </select>
<script>


</script>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick='changeProperty()'>Change Property</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick ='$("#userModal").hide()'>Cancel</button>
      </div>
    </div>
  </div>
</div>

<script>

document.getElementById('workingProperty').value=<?php session_start(); echo $_SESSION['property'];?>;

function changeProperty(){
  loginData = {action: 'changeProperty', newProperty: document.getElementById('workingProperty').value}
var jqxhr = $.post( '/php+js/userFunctions.php', loginData, function() {})
  .done(function(data) {
    location.reload();}
  )
  .fail(function() {alert( "error" );});
}

function logout(){

  var jqxhr = $.post( '/php+js/userFunctions.php', {action: 'logout'}, function() {})
    .done(function(data){location.reload();})
    .fail(function() {alert( "error" );});
  }


</script>
