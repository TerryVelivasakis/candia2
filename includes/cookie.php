<?php
session_start();


if ($_SESSION['baby'] != 'guy'){
  $loginURL = "http://".$_SERVER['HTTP_HOST']."/login.html";
  header("Location: $loginURL");
  //echo $loginURL;
}
