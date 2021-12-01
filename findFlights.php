<?php
    $id = (int) $_GET["flighID"];  // or $id = (int) $_POST["facultyid"];
    $mysqli = mysqli_connect("localhost", "cs213user", "letmein", "airfield");
    $sql = "SELECT * FROM flights WHERE flights.flight_id = $id";
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
               
    if (mysqli_num_rows($result)< 1){
        header ("Location: bookings.php");
                 }
    else {
        $row = mysqli_fetch_array($result);
        $resultstr = "<h2> Flights from ".$row['pilot_id'].", Tail number: ".$row['plane_id']."</h2>";
        $resultstr .= "<pre>";
        $resultstr .= sprintf("Flight Number\t\tDate\n");
        $resultstr .= sprintf("%'-55s\n","");
        $resultstr .= sprintf("%s\t%s\t%s\n",$row['flight_id'], $row['schedule']);
        while ($row = mysqli_fetch_array($result)){
            $resultstr .= sprintf("%s\t%s\t%s\n",$row['flight_id'], $row['schedule']);
        } //while   
        $resultstr .= "</pre>";
        echo $resultstr;
    } //else
?>
