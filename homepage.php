<?php
session_start();
$_SESSION["invalid"]++;
if((!filter_input(INPUT_POST, 'validEmail')) || (!filter_input(INPUT_POST, 'validPassword')))
{
  if($_SESSION["loggedin"] == false)
  {
    header("Location: login.php");
    exit;
  }
}
//check database for valid email and password fields
$mysqli = mysqli_connect("localhost", "cs213user", "letmein", "airfieldDB");
$validEmail = filter_input(INPUT_POST, 'validEmail');
$validPassword = filter_input(INPUT_POST, 'validPassword');

//query database
$sql = "SELECT firstname, lastname, email, password FROM users WHERE email = '".$validEmail."' AND password = SHA1('".$validPassword."')";

//get results from valid input query
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
if(mysqli_num_rows($result) == 1){

  //get user information
  while($info = mysqli_fetch_array($result))
  {
    $email = stripslashes($info["email"]);
    $firstname = stripslashes($info["firstname"]);
    $lastname = stripslashes($info["lastname"]);
  }
  $_SESSION["email"] = $email;
  $_SESSION["auth_user"] = $firstname." ".$lastname;
  
echo '<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->
<html>
    <head>
        <title>DNS Airfield</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <!-- header -->
        <div class="logo">
            <img src="images/logo.png" alt="Logo" style="width: 400px; height: 100px;">
        </div>
        <h1><i><Strong>Ubuntu Regional Airport</strong></i></h1>
        <div class="header">
            <a href="homepage.php" style="pointer-events: none;">Home</a>
            <a href="features.php">Features</a>
            <a href="bookings.php">Bookings</a>
            <a href="login.php">Logout</a>
        </div>
        <img id="titleImage" src="images/airplane.png" alt="Runway Image">
        <!-- content -->
        <div>
            <h2>Welcome <?php echo $_SESSION["auth_user"] ?> to DNS Airfield.</h2>
            <p>DNS Airfield is a regional airfield that can accommodate small to medium single and twin prop aircraft. 
                The single runway is 1,585m(5,200 feet) in length and 61m(200 feet) wide.
                The airfield houses 5 hangar bays and a small terminal. 
                DNS Airfield accepts both private and commercial aviation in classes of fixed wing and rotary aircraft.</p>
        </div>
        <div class="schedule">
            <p id="arrivals">Arrivals</p>
            <p id="departures">Departures</p>
        </div>
    </body>
</html>';
}
else
{
  $_SESSION["unauthorized"] = "User unauthorized, please try again.";
  header("Location: login.php");
  exit; 
}
?>
