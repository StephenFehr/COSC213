<html>
    <head>
        <title>Featured Aircraft</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script> 
        $(document).ready(function(){
          $(".aircraft").hover(function(){
            $(this).animate({opacity: 0.5}, 500);
            }, function () {
              $(this).animate({opacity: 1.0}, 500);
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
        <h2>Featured Aircraft.</h2>
        <div class="aircraft">
            <img id="cessna" src="images/cessna150.jpeg" alt="Cessna 150 Airplane Image" style="width: 500px; height: 400px;">
            <img id="harbin" src="images/harbinY12.jpg" alt="Harbin Y12 Airplane Image" style="width: 500px; height: 400px;">
            <img id="nomad" src="images/gafNomad.jpg" alt="GAF Nomad Aiplane Image" style="width: 500px; height: 400px;">
        </div>
    </body>
</html>
