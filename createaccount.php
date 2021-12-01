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
        <h1 class="regional"><i><Strong>Ubuntu Regional Airport</strong></i></h1>
        <div class="header">
            <a href="homepage.html">Home</a>
            <a href="features.php">Features</a>
            <a href="bookings.php">Bookings</a>
            <a href="logout.php">Logout</a>
        </div>
        <img id="titleImage" src="images/airplane.png" alt="Runway Image">
        <!-- content -->
        <div>
<?php
session_start();
$username = $_POST['username'];
$email = strtolower($_POST['email']);
$password = $_POST['password'];
$form = true;
$message = "A confirmation email has been sent to '.email.'";

//connect to server and select database
$mysqli = mysqli_connect("localhost", "cs213user", "letmein", "airfieldDB");

//create and issue the query
$targetemail = filter_input(INPUT_POST, 'email');
$sql = "SELECT email FROM members WHERE email = '$targetemail'";

$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

//get the number of rows in the result set; should be 1 if a match
if (mysqli_num_rows($result) == 1) {

    //email is already used
    echo '<h3>The email address "' . $email . '" is already in use, please try again.</h3>';
} else {
    //connect to server and select database
    $connect = new mysqli("localhost", "cs213user", "letmein", "airfieldDB");
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    //make a user directory and store user in database
    $sql = "INSERT INTO members VALUES ('$username', $email', SHA1('$password'))";
    if ($connect->query($sql) == true && isset($_POST['submit'])) {
        echo '<h3>Your account "' . $email . '" has been created. Thank you for joining us!</h3>';
        echo '<a href="bookings.php">Go To Bookings</a>';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Create Account</title>
    </head>
    <body style="background-color: bisque">
        <form name="form" method="post" action="<?php echo $PHP_SELF; ?>">
            <fieldset>
                <legend><h3>User Information</h3></legend>
                <p><strong>Username:</strong><br>
                    <input type="text" name="username" required/></p>
                <p><strong>Email:</strong><br>
                    <input type="email" name="email" required/></p>
                <p><strong>Password:</strong><br>
                    <input type="password" name="password" required/></p>
                <p><input type="submit" name="submit" value="Create Account"/></p>
            </fieldset>
        </form>
    </body>
</html>

