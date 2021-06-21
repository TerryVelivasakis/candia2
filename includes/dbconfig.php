<?php
$servername = "localhost";
$username = "terry";
$password = "nalgene2";
$dbname = "CandiaIntranet";

$db = mysqli_connect($servername,$username,$password,$dbname);
//$configuration = array('username' => 'MAIN\Terry','password' => '9One4StupidPassword01!');
  if (!$db) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
            }
