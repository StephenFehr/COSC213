<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->
<html>
    <head>
        <title>Create Account</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <!-- header -->
        <div class="logo">
            <img src="images/logo.png" alt="Logo" style="width: 400px; height: 100px;">
        </div>
        <h1 class="regional"><i><Strong>Ubuntu Regional Airport</strong></i></h1>
        <div class="header">
            <a href="login.php">Return to Login</a>
        </div>
        <img id="titleImage" src="images/airplane.png" alt="Runway Image">
        <!-- content -->
        <div>
        <h2>Please create account.</h2>
        <?php
        session_start();
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = strtolower($_POST['email']);
        $password = $_POST['password'];
        if(isset($_POST["create_account"]))
        {
            //connect to server and select database
            $mysqli = mysqli_connect("localhost", "cs213user", "letmein", "airfieldDB");

            //create and issue the query
            $targetemail = filter_input(INPUT_POST, 'email');
            $sql = "SELECT email FROM users WHERE email = '$targetemail'";

            $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

            //get the number of rows in the result set; should be 1 if a match
            if (mysqli_num_rows($result) == 1) {

                //email is already used message
                echo '<h3>The email address ' . $email . ' is already in use, please try again.</h3>';
            } else {
                //connect to server and select database
                $connect = new mysqli("localhost", "cs213user", "letmein", "airfieldDB");
                if ($connect->connect_error) {
                    die("Connection failed: " . $connect->connect_error);
                }
                
                //insert new account information into users database
                $sql = "INSERT INTO users VALUES ('$firstname', '$lastname', '$email', SHA1('$password'))";

                if ($connect->query($sql) == true) {
                    echo '<h2>Thank you '.$firstname.' '.$lastname.', your account ' . $email . ' has been created. Please login to access content.</h2>';
                    echo '<a href="login.php">Go To Login</a>';
                }
            }
        }
        ?>
        <form name="form" method="post" action="<?php echo $PHP_SELF; ?>">
            <fieldset>
                <legend><h3>User Information</h3></legend>
                <p><strong>First name:</strong><br>
                    <input type="text" name="firstname" required></p>
                <p><strong>Last name:</strong><br>
                    <input type="text" name="lastname" required></p>
                <p><strong>Email:</strong><br>
                    <input type="email" name="email" required></p>
                <p><strong>Password:</strong><br>
                    <input type="password" name="password" required></p>
                <p><input type="submit" name="create_account" value="Create Account"></p>
            </fieldset>
        </form>
    </body>
</html>

