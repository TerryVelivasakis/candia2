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
$crmDB = mysqli_connect($servername,$username,$password,'CandiaCRM');

if (!$crmDB) {
  echo "Error: Unable to connect to MySQL." . PHP_EOL;
  echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
  echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
  exit;
          }

$hrDB = mysqli_connect($servername,$username,$password,'CandiaHR');

if (!$hrDB) {
  echo "Error: Unable to connect to MySQL." . PHP_EOL;
  echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
  echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
  exit;
          }

$dirDB = mysqli_connect($servername,$username,$password,'CandiaDirectory');

if (!$dirDB) {
  echo "Error: Unable to connect to MySQL." . PHP_EOL;
  echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
  echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
  exit;
          }
