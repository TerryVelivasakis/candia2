<style>
th{
vertical-align: top;
}

</style>
<form action="#" method="post">
<table>
<tr><th>Suite<th>Line 1<th>line2</tr>

<tr><td><input type="text" size="5" name = "ste1">
<td><input type="text" name = "lna1">
<td><input type="text" name = "lnb1">

<tr><td><input type="text" size="5" name = "ste2">
<td><input type="text" name = "lna2">
<td><input type="text" name = "lnb2">

<tr><td><input type="text" size="5" name = "ste3">
<td><input type="text" name = "lna3">
<td><input type="text" name = "lnb3">

<tr><td><input type="text" size="5" name = "ste4">
<td><input type="text" name = "lna4">
<td><input type="text" name = "lnb4">

<tr><td><input type="text" size="5" name = "ste5">
<td><input type="text" name = "lna5">
<td><input type="text" name = "lnb5">

<tr><td><input type="text" size="5" name = "ste6">
<td><input type="text" name = "lna6">
<td><input type="text" name = "lnb6">

<tr><td><input type="text" size="5" name = "ste7">
<td><input type="text" name = "lna7">
<td><input type="text" name = "lnb7">

<tr><td><input type="text" size="5" name = "ste8">
<td><input type="text" name = "lna8">
<td><input type="text" name = "lnb8">

<tr><td><input type="text" size="5" name = "ste9">
<td><input type="text" name = "lna9">
<td><input type="text" name = "lnb9">

<tr><td><input type="text" size="5" name = "ste10">
<td><input type="text" name = "lna10">
<td><input type="text" name = "lnb10">

<tr><td><input type="text" size="5" name = "ste11">
<td><input type="text" name = "lna11">
<td><input type="text" name = "lnb11">

  <tr><td><input type="text" size="5" name = "ste12">
  <td><input type="text" name = "lna12">
  <td><input type="text" name = "lnb12">


</table>
<input type="submit">
</form>
<?php

include $_SERVER['DOCUMENT_ROOT']."/includes/dirconfig.php";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$x=1;
while ($x <= 12){
if ($_POST['ste'.$x] != "" && $_POST['lna'.$x] != ""){
$sql =  "INSERT INTO `Tenants` (`ID`, `Suite`, `Line1`, `Line2`) VALUES (NULL, '".addslashes($_POST['ste'.$x])."', '".addslashes($_POST['lna'.$x])."', '".addslashes($_POST['lnb'.$x])."')";
echo $sql."<br>";
if ($conn->query($sql) === TRUE) {
  //  echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
    $errs = 1;
}

}
$x++;
}
?>
