<?php
session_start();

//check database for valid email and password fields
$mysqli = mysqli_connect("localhost", "cs213user", "letmein", "airfieldDB");
$validEmail = filter_input(INPUT_POST, 'validEmail');
$validPassword = filter_input(INPUT_POST, 'validPassword');

//query database
$sql = "SELECT firstname, lastname, email, password FROM users WHERE email = '".$validEmail."' AND password = SHA1('".$validPassword."')";

//get results from valid input query
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
if($_SESSION["loggedin"] == true || mysqli_num_rows($result) == 1)
{
  
  //get user information
  while($info = mysqli_fetch_array($result))
  {
    $email = stripslashes($info["email"]);
    $firstname = stripslashes($info["firstname"]);
    $lastname = stripslashes($info["lastname"]);
  }
  $_SESSION["loggedin"] = true;
  $_SESSION["email"] = $email;
  $_SESSION["auth_user"] = $firstname." ".$lastname;
}
    if($_SESSION["loggedin"] == true)
    {
      $_SESSION["unauthorized"] = ""; 
    }
else
{
    if($_SESSION["loggedin"] == false)
    {
      $_SESSION["unauthorized"] = "User unauthorized, please try again or create account.";
    }
    header("Location: login.php");
    exit; 
}
?>

  <!DOCTYPE html>
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
              <a href="aircraft.php">Aircraft</a>
              <a href="scheduling.php">Scheduling</a>
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

            <?php
                $col = array("Flight ID", "Model", "Departure");
                $numcol = count($col);
                $mysqli = mysqli_connect("localhost", "cs213user", "letmein", "airfield");
                $sql = "SELECT f.flight_id, p.model, f.schedule FROM flights f, planes p WHERE p.plane_id = f.plane_id AND f.schedule < (curdate() + 7)";
                $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

               //get the number of rows in the result set; should be 1 if a match
                if (mysqli_num_rows($result) < 1) {
                   echo "<p> No Upcoming Flights </p>";
                   } else {

                   echo "<h2> Upcoming Flights: </h2>";

                   echo "<table><tr>";
                   for ($i = 0; $i < count($col); $i++) {
                     echo "<th>" . $col[$i];
                   }
                   echo "</tr>";
                   while ($row = mysqli_fetch_array($result)) {
                     for ($i = 0; $i < count($col); $i++) {
                        echo"<td>" . $row[$i];
                     }
                     echo "</tr>";
                  } //while
               }
            echo "</table>";
            ?>

      </body>
  </html>
