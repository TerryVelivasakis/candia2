<?php


include $_SERVER['DOCUMENT_ROOT']."/includes/dirconfig.php";

$dbname = "WBdirectory";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = mysqli_query($conn, "SELECT * FROM `Announcements` WHERE AnnID =".$_GET['q']);

      while($row = mysqli_fetch_array($result)) {
$annctxt=$row['Announcement'];
$rununtil =$row['RunUntil'];
$anncimg =$row['Annimg'];
$runfrom =$row['RunFrom'];
}

$runner = str_replace(" ", "T", $rununtil);
$runner2 = str_replace(" ", "T", $runfrom);
//echo $runner;
echo '<input type="hidden" id="annctext" value="'. htmlspecialchars($annctxt).'">';
echo '<input type="hidden" id="runtilh" value="'. $runner.'">';
echo '<input type="hidden" id="anncimg" value="'. $anncimg.'">';
echo '<input type="hidden" id="runfh" value="'. $runner2.'">';





?>
