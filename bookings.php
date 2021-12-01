<html>
    <head>
        <title>Book a Flight</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
         <script>
              function showPlanes() {
              var xhttp = new XMLHttpRequest();
                    
              xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("planes").innerHTML = this.responseText;
                    }
              };
              xhttp.open("GET", "findPlanes.php", true);
              xhttp.send();
            }
             
             function showFLights(str) {
              var xhttp = new XMLHttpRequest();
              
                if (str=="") {
                    document.getElementById("flights").innerHTML="";
                    return;
                }
                    
              xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("flights").innerHTML = this.responseText;
                    }
              };
              xhttp.open("GET", "findFlights.php?flightID="+str, true);
              xhttp.send();
            
            }
             
        </script>
        
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
        <h2>Book a flight.</h2>
        <p style="color: red;"><strong>Please note that current COVID-19 travel restrictions may affect all flights and bookings.</strong></p>
        <div class="booking">
            <form method="post" action="login.php">
                
                <button type="button" onclick="showPLanes()"> Air Craft </button> 
                <br>
                <br>
                <label for="airline"><strong>Select airline:</strong></label>
                <select name="airline">
                    <option>Ubuntu Air</option>
                    <option>Apache Airlines</option>
                    <option>Private Charter</option>
                </select>
                <p>&nbsp;&nbsp;</p>
                <label for="date"><strong>Select date:</strong></label>
                <input type="date" required>
                <br><br>
                <input type="submit" name="submit" value="Check Availability">
            </form>
        </div>
    </body>
</html>
