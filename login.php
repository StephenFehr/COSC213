<?php
session_start();
$_SESSION["loggedin"] = false;
$_SESSION["invalid"];
if($_SESSION["invalid"] > 0)
{
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
          $("#login").click(function(){
            $("#error").text("User unauthorized, please try again.");
          });
        });
        </script>';
}
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->
<html>
    <head>
        <title>Login</title>
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
        <img id="titleImage" src="images/airplane.png" alt="Runway Image">
        <!-- content -->
        <br>
        <h2>Welcome, please sign in below to access content.</h2>
        <h3 style="color: red;" id="error"></h3>
        <h3 style="color: red;"><?php echo $_SESSION["unauthorized"]; ?></h3>
        <div>
            <form id="login" method="post" action="homepage.php">
                <fieldset>
                    <legend><h3>User Login</h3></legend>
                    <label for="validEmail"><strong>Email:</strong></label>
                    <input type="email" name="validEmail">
                    <label for="validPassword"><strong>Password:</strong></label>
                    <input type="password" name="validPassword">
                    <input type="submit" id="login" name="submit" value="Login">
                </form>
                <br><br>
                <a href="createAccount.php">Create Account</a>
            </fieldset>
        </div>
    </body>
</html>
