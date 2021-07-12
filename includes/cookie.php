<?php
session_start();
$accessLevel = 2;
$currentProperty = 2;
/*
if ($accessLevel == 2 ){
  $loginURL = "http://".$_SERVER['HTTP_HOST']."/login.html";
  header("Location: $loginURL");
  //echo $loginURL;
}
