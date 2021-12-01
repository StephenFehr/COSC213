<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
session_start();
if (isset($_POST["submit"])) {
    $message = "Flight is available for booking. Please log in or create account to confirm booking.";  
}
else
{
    $message = "Flight is available for booking. Please log in or create account to confirm booking.";
    $error = "Unauthorized user, please try again.";
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
        <div class="header">
            <a href="homepage.html">Home</a>
            <a href="features.php">Features</a>
            <a href="bookings.php">Bookings</a>
            <a href="logout.php">Logout</a>
        </div>
        <img id="titleImage" src="images/airplane.png" alt="Runway Image">
        <!-- content -->
        <br>
        <div>
            <form method="post" action="confirmflight.php">
                <h3><?php echo $message; ?><h3>
                <h4 style="color: red;"><?php echo $error; ?></h4>
                <label for="validEmail"><strong>Email:</strong></label>
                <input type="email" name="validEmail">
                <label for="validPassword"><strong>Password:</strong></label>
                <input type="password" name="validPassword">
                <input type="submit" name="submit" value="Login">
            </form>
            <br>
            <a href="createaccount.php">Create Account</a>
        </div>
    </body>
</html>
