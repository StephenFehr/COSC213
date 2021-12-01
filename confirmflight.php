<?php
session_start();
if((!filter_input(INPUT_POST, 'validEmail')) || (!filter_input(INPUT_POST, 'validPassword')))
{
  header("Location: login.php");
  exit;
}
//check database for valid email and password fields
$mysqli = mysqli_connect("localhost", "cs213user", "letmein", "airfieldDB");
$validEmail = filter_input(INPUT_POST, 'validEmail');
$validPassword = filter_input(INPUT_POST, 'validPassword');

//query database
$sql = "SELECT email, password FROM users WHERE email = '".$validEmail."' AND password = SHA1('".$validPassword."')";

//get results from valid input query
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
if(mysqli_num_rows($result) == 1){
  $authenticated = "User Authenticated";
}
else
{
  header("Location: login.php");
  exit;
}
?>


