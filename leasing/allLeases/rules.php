<?php

$sqlProperty = "SELECT * FROM property WHERE propertyID = 1";
$result = $db->query($sqlProperty);
$property = $result->fetch_assoc();
$sqlRules = "SELECT * FROM rules";
$rules = $db->query($sqlRules);
?>
<div class="heading">
<?php echo strtoupper($property['propertyName']);?><br>
RULES AND REGULATIONS<br>
as of <?php echo date("F j, Y")?>
</div>
<?php
echo "<ol>";

while($row = $rules->fetch_assoc()) {
echo "<li><p>";
echo $row['Rule'];
echo "</p></li>";
}
echo "</ol>";
?>
