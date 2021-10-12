






<select>
  <option value="0"> New Tenant Listing</option>



<?php
include $_SERVER['DOCUMENT_ROOT']."/includes/dirconfig.php";

$dbname = "WBdirectory";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = mysqli_query($conn, "SELECT * FROM `Tenants`");

while($row = mysqli_fetch_array($result)) {

echo '<option value="'.$row['ID'].'"> '.$row['Line1'].'</option>';


}

?>
</select>
