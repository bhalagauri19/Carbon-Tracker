<?php

session_start();
include "db_connect.php";

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$activity = $_POST['activity_type'];
$quantity = $_POST['quantity'];

/* Carbon factors for activities */

$carbon_factors = [

    // Transport
    "car_travel" => 0.21,
    "bike_travel" => 0.10,
    "bus_travel" => 0.05,
    "train_travel" => 0.04,
    "flight_travel" => 0.25,

    // Energy
    "electricity_usage" => 0.85,
    "air_conditioner" => 1.20,
    "heater_usage" => 1.00,
    "washing_machine" => 0.60,
    "refrigerator" => 0.30,

    // Food
    "vegetarian_meal" => 1.50,
    "nonveg_meal" => 2.50,
    "fast_food" => 2.00,
    "dairy_products" => 1.80,

    // Digital
    "online_streaming" => 0.15,
    "video_gaming" => 0.12,
    "laptop_usage" => 0.10,
    "mobile_charging" => 0.02,

    // Lifestyle
    "online_shopping" => 1.00,
    "delivery_service" => 0.80,

    // Low carbon
    "walking" => 0.01,
    "cycling" => 0.005,
    "gym_workout" => 0.02
];

/* Get carbon factor */

if(isset($carbon_factors[$activity])){
    $factor = $carbon_factors[$activity];
}else{
    $factor = 0.01; // default factor for any new activity
}

/* Calculate carbon */

$carbon = $quantity * $factor;

/* Insert activity into database */

$sql = "INSERT INTO activities (user_id, activity_type, quantity, carbon)
        VALUES ('$user_id','$activity','$quantity','$carbon')";

if($conn->query($sql) === TRUE){

    header("Location: report.php");
    exit();

}else{

    echo "Error: " . $conn->error;

}

$conn->close();

?>