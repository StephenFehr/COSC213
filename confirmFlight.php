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
$sql = "SELECT firstname, lastname, email, password FROM users WHERE email = '".$validEmail."' AND password = SHA1('".$validPassword."')";

//get results from valid input query
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
if(mysqli_num_rows($result) == 1){
  
  //get user information
  while($info = mysqli_fetch_array($result))
  {
    $firstname = stripslashes($info["firstname"]);
    $lastname = stripslashes($info["lastname"]);
  }
  $_SESSION["auth_user"] = $firstname." ".$lastname;
  $authenticated = "Welcome ".$_SESSION["auth_user"].", please confirm your flight details.";
  
  //set authorization cookie
  setcookie("auth", session_id(), time() + 60 * 30, "/", "", 0);
}
else
{
  header("Location: login.php");
  exit;
}
$total;
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->
<html>
    <head>
        <title>Confirm Flight</title>
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
            <a href="homepage.html">Home</a>
            <a href="features.php">Features</a>
            <a href="bookings.php">Bookings</a>
            <a href="logout.php">Logout</a>
        </div>
        <img id="titleImage" src="images/airplane.png" alt="Runway Image">
        <!-- content -->
      <br>
      <h2><?php echo $authenticated; ?><h2>
      <br>
      <h2>Total: <?php echo $total; ?></h2>
        <form name="form" method="post" action="purchase">
            <fieldset>
              <div>
                <legend><h3>Payment Information</h3></legend>
                  <p><strong>Name on Card:</strong><br>
                      <input type="text" name="fullName" required></p>
                  <p><strong>Credit Card Number:</strong><br>
                      <input type="text" name="cardNumber" required></p>
                  <p><strong>Expiry:</strong><br>
                      <input type="text" name="Expiry" required></p>
                  <p><strong>CVV:</strong><br>
                      <input type="text" name="cvv" required></p>               
                  <p><input type="submit" name="submit" value="Continue to Checkout"></p>
                </div>
            </fieldset>
        </form>
    </body>
</html>
