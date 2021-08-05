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
echo '<tr>';
if ($row['status'] == 0){ $suite = 'Past';}else {$suite = $row['suiteNumber'];}
echo '<td>'.$suite.'</td>';
echo '<td>'.$row['contactName'].'</td>';
echo '<td>'.$row['tenantName'].'</td>';
echo '<td>'.$row['contactPhone'].'</td>';
echo '<td>'.$row['contactCell'].'</td>';
echo '<td><a href="'.$row['contactEmail'].'">'.$row['contactEmail'].'</a></td>';
echo '<td>'.$property[$row['Property']].'</td>';
}

$sql = "SELECT * FROM `tenantContacts` JOIN executiveLease ON tenantContacts.leaseID = executiveLease.leaseID";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
echo '<tr>';
if ($row['status'] == 0){ $suite = 'Past';}else {$suite = $row['suiteNumber'];}
echo '<td>'.$suite.'</td>';
echo '<td>'.$row['addContactName'].'</td>';
echo '<td>'.$row['tenantName'].'</td>';
echo '<td>'.$row['addPhone'].'</td>';
echo '<td>'.$row['addCell'].'</td>';
echo '<td><a href="'.$row['addEmail'].'">'.$row['addEmail'].'</a></td>';
echo '<td>'.$property[$row['Property']].'</td>';
}


 ?>
</tbody>
</table>
</div>

<script>

$(document).ready(function(){

  $('#contactTable').DataTable({});
  });
</script>
