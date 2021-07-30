<?php
require $_SERVER["DOCUMENT_ROOT"].'/includes/loadme.php';
require $_SERVER["DOCUMENT_ROOT"].'/includes/nav.php';
?>
<div class='container mt-2'>
<table class='table table-striped' id='contactTable'>
<thead>
  <tr class='table-info'>
    <th>Suite</th>
    <th>Name</th>
    <th>Company</th>
    <th>Phone</th>
    <th>Cell</th>
    <th>Email</th>
    <th>Property</th>
  </tr>
</thead>
<tbody>
<?php

$sql = "SELECT * FROM `property`";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
  $property[$row['propertyID']] = $row['propertyNickname'];
}
$sql = "SELECT * FROM `executiveLease`";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
echo '<tr><td>'.$row['suiteNumber'].'</td>';
echo '<td>'.$row['contactName'].'</td>';
echo '<td>'.$row['tenantName'].'</td>';
echo '<td>'.$row['contactPhone'].'</td>';
echo '<td>'.$row['contactCell'].'</td>';
echo '<td>'.$row['contactEmail'].'</td>';
echo '<td>'.$property[$row['Property']].'</td>';

}

$sql = "SELECT tenantContacts.*, executiveLease.tenantName, executiveLease.Property, executiveLease.suiteNumber FROM tenantContacts JOIN executiveLease ON executiveLease.leaseID = tenantContacts.leaseID WHERE executiveLease.property =".$currentProperty;
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
  echo '<tr><td>'.$row['suiteNumber'].'</td>';
  echo '<td>'.$row['addContactName'].'</td>';
  echo '<td>'.$row['tenantName'].'</td>';
  echo '<td>'.$row['addPhone'].'</td>';
  echo '<td>'.$row['addCell'].'</td>';
  echo '<td>'.$row['addEmail'].'</td>';
  echo '<td>'.$property[$row['Property']].'</td>';
}
 ?>
</tbody>
</table>
</div>

<script>
  console.log('ready');
$(document).ready(function(){
  console.log('ready');
  $('#contactTable').DataTable({});
  });
</script>
