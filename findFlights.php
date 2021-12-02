<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
    {
        header("Location: login.php");
        exit;
    }
    $id = $_GET["PlaneID"];
    $mysqli = mysqli_connect("localhost", "cs213user", "letmein", "airfield");
    $sql = "SELECT * FROM flights f, planes p, pilots pi WHERE p.plane_id = f.plane_id AND pi.pilot_id = f.pilot_id AND f.plane_id = '".$id."'";
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
               
    if (mysqli_num_rows($result)< 1){
        header ("Location: scheduling.php");
                 }
    else {
        $row = mysqli_fetch_array($result);
        $resultstr = "<h2> Flights from ".$row['model'].", Tail number: ".$row['plane_id']."</h2>";
        $resultstr .= "<pre>";
        $resultstr .= sprintf("Flight Number\t\tDate\tPilot\n");
        $resultstr .= sprintf("%'-55s\n","");
        $resultstr .= sprintf("%s\t%s\t%s\n",$row['flight_id'], $row['schedule'], $row['fname']." ".$row['lname']);
        while ($row = mysqli_fetch_array($result)){
             $resultstr .= sprintf("%s\t%s\t%s\n",$row['flight_id'], $row['schedule'], $row['fname']." ".$row['lname']);
        } //while   
        $resultstr .= "</pre>";
        echo $resultstr;
    } //else
?>
