<?php 
session_start();
$_SESSION["loggedin"] = true;
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
if($_SESSION["email"])
{
 echo $page;
}
else
{
  if(isset($_POST["submit"]))
  {
    $_SESSION["unauthorized"] = "User unauthorized, please try again or create account.";
  }
    header("Location: login.php");
    exit; 
}
$page = '<html>
    <head>
        <title>Featured Aircraft</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
        //Cessna 150
        $(document).ready(function(){
          $("#cessna").hover(function(){
            $(this).css({opacity: 0.6}, 500);
            }, function () {
              $(this).css({opacity: 1.0}, 500);
           });
        });
           $(document).ready(function(){
             $("#cessna").hover(function(){
               $("#plane").text("Cessna 150");
             });
           });
           $(document).ready(function(){
             $("#cessna").mouseleave(function(){
               $("#plane").text("");
             });
           });
           //Harbin Y-12
           $(document).ready(function(){
          $("#harbin").hover(function(){
            $(this).css({opacity: 0.6}, 500);
            }, function () {
              $(this).css({opacity: 1.0}, 500);
           });
        });
           $(document).ready(function(){
             $("#harbin").hover(function(){
               $("#plane").text("Harbin Y-12");
             });
           });
           $(document).ready(function(){
             $("#harbin").mouseleave(function(){
               $("#plane").text("");
             });
           });
           //GAF Nomad
           $(document).ready(function(){
          $("#nomad").hover(function(){
            $(this).css({opacity: 0.6}, 500);
            }, function () {
              $(this).css({opacity: 1.0}, 500);
           });
        });
           $(document).ready(function(){
             $("#nomad").hover(function(){
               $("#plane").text("GAF Nomad");
             });
           });
           $(document).ready(function(){
             $("#nomad").mouseleave(function(){
               $("#plane").text("");
             });
           });
        </script> 
    </head>
    <body>
        <!-- header -->
        <div class="logo">
            <img src="images/logo.png" alt="Logo" style="width: 400px; height: 100px;">
        </div>
        <h1><i><Strong>Ubuntu Regional Airport</strong></i></h1>
        <div class="header">
            <a href="homepage.php">Home</a>
            <a href="aircraft.php" style="pointer-events: none;">Aircraft</a>
            <a href="scheduling.php">Scheduling</a>
            <a href="login.php">Logout</a>
        </div>
        <img id="titleImage" src="images/airplane.png" alt="Runway Image">
        <!-- content -->
        <h2 class="aircraftType">Featured Aircraft:</h2>
        <h2 id="plane" class="aircraftType"></h2>
        <div class="aircraft">
            <img id="cessna" src="images/cessna150.jpeg" alt="Cessna 150 Airplane Image" style="width: 500px; height: 400px;">
            <img id="harbin" src="images/harbinY12.jpg" alt="Harbin Y12 Airplane Image" style="width: 500px; height: 400px;">
            <img id="nomad" src="images/gafNomad.jpg" alt="GAF Nomad Aiplane Image" style="width: 500px; height: 400px;">
        </div>
    </body>
</html>';
?>
