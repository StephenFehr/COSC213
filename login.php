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
        </div>
        <img id="titleImage" src="images/airplane.png" alt="Runway Image">
        <!-- content -->
        <br>
        <div>
            <form method="post" action="homepage.php">
                <fieldset>
                    <legend><h3>User Information</h3></legend>
                    <h3><?php echo $message; ?><h3>
                    <h4 style="color: red;"><?php echo $error; ?></h4>
                    <label for="validEmail"><strong>Email:</strong></label>
                    <input type="email" name="validEmail">
                    <label for="validPassword"><strong>Password:</strong></label>
                    <input type="password" name="validPassword">
                    <input type="submit" name="submit" value="Login">
                </form>
                <br>
                <a href="createAccount.php">Create Account</a>
            </fieldset>
        </div>
    </body>
</html>
