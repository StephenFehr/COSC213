<?php
session_start();
$_SESSION["loggedin"] = false;
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
        <div>
            <form method="post" action="homepage.php">
                <fieldset>
                    <legend><h3>User Login</h3></legend>
                    <label for="validEmail"><strong>Email:</strong></label>
                    <input type="email" name="validEmail" required>
                    <label for="validPassword"><strong>Password:</strong></label>
                    <input type="password" name="validPassword" required>
                    <input type="submit" name="submit" value="Login">
                </form>
                <br><br>
                <a href="createAccount.php">Create Account</a>
            </fieldset>
        </div>
    </body>
</html>
