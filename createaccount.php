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
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = strtolower($_POST['email']);
$password = $_POST['password'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$date = date('Y-m-d');
$form = true;
$path = "/var/www/html/uploaddir/$email";

//@myokanagan.bc.ca validation, email and message variables
$OKextension = "@myokanagan.bc.ca";
$emailOK = strtolower($firstname . "." . $lastname . $OKextension);
$to = $emailOK; //----------------------------------------------------------------->might need quotes to make a string ""
$subject = "Thank You For Joining!";
$message = "Welcome to join us! Our annual dinner meeting is scheduled on Friday, November 26, 2021 starting at 7:00 pm "
        . "in the Conference Hall of Caprice Hotel in Kelowna. Please call 250-767-7897 for details.";

//connect to server and select database
$mysqli = mysqli_connect("localhost", "cs213user", "letmein", "testDB");

//create and issue the query
$targetemail = filter_input(INPUT_POST, 'email');
$sql = "SELECT email FROM members WHERE email = '$targetemail'";

$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

//get the number of rows in the result set; should be 1 if a match
if (mysqli_num_rows($result) == 1) {

    //email is already used
    echo '<h3>The email address "' . $email . '" is already in use, try again!</h3>';
} else {
    //connect to server and select database
    $connect = new mysqli("localhost", "cs213user", "letmein", "testDB");
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    //set authorization cookie using curent Session ID
    setcookie("auth", session_id(), time() + 60 * 30, "/", "", 0);

    //make a user directory and store user in database
    $sql = "INSERT INTO members VALUES ('$firstname', '$lastname', '$email', SHA1('$password'), '$age', '$gender', '$date')";
    if ($connect->query($sql) == true && isset($_POST['submit'])) {

        //check if user email is a @myokanagan.bc.ca email
        if ($email == $emailOK) {
            
            include ("maillist_include.php");
            include ("gmail.php");            

            gmail($to, $subject, $message);
            //umask(000);//---------------------------------------------------------->may not need this???
            //mkdir($path, 0733);//-------------------------------------------------->turn on before submitting
            echo '<h3>Thank you for signin up! Check your email ' . $emailOK . ' for more information!</h3>';
            echo '<a href="lottoLogin.html">Go to Login</a>';
        } else {
            //umask(000);//---------------------------------------------------------->may not need this???
            //mkdir($path, 0733);//-------------------------------------------------->turn on before submitting
            echo $emailOK;
            echo '<h3>Your account "' . $email . '" has been created. Thank you for joining us!</h3>';
            echo '<a href="lottoLogin.html">Go to Login</a>';
        }
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

