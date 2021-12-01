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
            
            <form>
             <button type="button" onclick="showPLanes()"> Air Craft</button>&nbsp;&nbsp;&nbsp;Find flights taken by Tail Number: 
            <?php
             $mysqli = mysqli_connect("localhost", "cs213user", "letmein", "airfield");  
             $result=mysqli_query($mysqli, "SELECT model,plane_id FROM planes");
             if(mysqli_num_rows($result)> 0){
                $select= '<select name="plane_id" onchange="showFlights(this.value)">';
                $select.='<option value="">Select a plane:</option>';
                while($row=mysqli_fetch_array($result)){
                    $select.='<option value="'.$row['model'].'">'.$row['plane_id'].'</option>';
                }
             mysqli_free_result($result);
            mysqli_close($mysqli);
            }
            $select.='</select>';
            echo $select;
            ?>
        </form>     
            
        </div>
        <div id="planes"></div>
        <div id="flights"></div>

    </body>
</html>
