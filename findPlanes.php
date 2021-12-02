<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
    {
        header("Location: login.php");
        exit;
    }
    $mysqli = mysqli_connect("localhost", "cs213user", "letmein", "airfield");
    $sql = "SELECT * from planes;";
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
               
    if (mysqli_num_rows($result)< 1){
        header ("Location: scheduling.php");
    }
    else {
        echo "<h2> Available Planes: </h2>";
        echo "<pre>";
        printf("Tail Number\tModel\t\t\tSeats\tGVW\tCatergory\n");
        printf("%'-85s\n","");
        while ($row = mysqli_fetch_array($result)){
            printf("%s\t%-24s%s\t%s\t%s\n", $row['plane_id'],$row['model'],
                   $row['seats'],$row['gvw'],$row['category']);
        
                     } //while     
        echo "</pre>";
     
    } //else   
?>

