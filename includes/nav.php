<?php
//$propertyName = "Candia Tower";
$sql = "SELECT * FROM property WHERE propertyID = 1";
$result = $db->query($sql);
$property = $result->fetch_assoc();
$currentActive = '<span class="visually-hidden">(current)</span>';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><?php echo $property['propertyNickname'];?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">

<?php

$headerQuery = "SELECT DISTINCT header FROM nav";

$groups = $db->query($headerQuery);
while($header = $groups->fetch_assoc()) {
  echo '<li class="nav-item dropdown">';
  echo '<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">'.$header['header'].'</a>';
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
</div></ul></div></nav>
