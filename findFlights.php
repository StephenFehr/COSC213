<?php
    $id = (int) $_GET["plane_id"];
    $mysqli = mysqli_connect("localhost", "cs213user", "letmein", "airfield");
    $sql = "SELECT * FROM flights f, planes p, pilots pi 
			WHERE p.plane_id = f.plane_id AND pi.pilot_id = f.pilot_id AND f.plane_id = $id";
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
               
    if (mysqli_num_rows($result)< 1){
        header ("Location: bookings.php");
                 }
    else {
        $row = mysqli_fetch_array($result);
        $resultstr = "<h2> Flights from ".$row['p.model'].", Tail number: ".$row['f.plane_id']."</h2>";
        $resultstr .= "<pre>";
        $resultstr .= sprintf("Flight Number\t\tDate\tPilot\n");
        $resultstr .= sprintf("%'-55s\n","");
        $resultstr .= sprintf("%s\t%s\t%s\n",$row['f.flight_id'], $row['f.schedule'], $row['pi.fname']." ".$row['pi.lname']);
        while ($row = mysqli_fetch_array($result)){
             $resultstr .= sprintf("%s\t%s\t%s\n",$row['f.flight_id'], $row['f.schedule'], $row['pi.fname']." ".$row['pi.lname']);
        } //while   
        $resultstr .= "</pre>";
        echo $resultstr;
    } //else
?>
