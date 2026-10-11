<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

$name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Activity</title>

<style>

*{
box-sizing:border-box;
}

body{
margin:0;
font-family:Arial;
background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
color:white;
min-height:100vh;
display:flex;
flex-direction:column;
}

/* Header */

.header{
background:#1b5e20;
padding:20px;
text-align:center;
font-size:28px;
font-weight:bold;
}

/* Center container */

.container{
flex:1;
display:flex;
justify-content:center;
align-items:center;
}

/* Card */

.card{
width:380px;
background:rgba(255,255,255,0.12);
padding:35px;
border-radius:12px;
backdrop-filter:blur(10px);
box-shadow:0 8px 20px rgba(0,0,0,0.4);
}

/* Labels */

label{
font-size:16px;
display:block;
margin-bottom:6px;
}

/* Inputs */

select,
input{
width:100%;
padding:12px;
border:none;
border-radius:6px;
margin-bottom:18px;
font-size:15px;
}

/* Button */

button{
width:100%;
padding:12px;
background:#00c853;
color:white;
border:none;
border-radius:6px;
font-size:16px;
cursor:pointer;
margin-top:5px;
}

button:hover{
background:#00e676;
}

/* Back button */

.back{
display:block;
text-align:center;
margin-top:18px;
padding:12px;
background:#2e7d32;
color:white;
text-decoration:none;
border-radius:6px;
}

.back:hover{
background:#388e3c;
}

</style>

</head>

<body>

<div class="header">
🌍 Add Daily Activity
</div>

<div class="container">

<div class="card">

<form action="save_activity.php" method="POST">

<label>Select Activity</label>

<select name="activity_type" required>

<option value="">-- Select Activity --</option>

<!-- Transport -->
<option value="car_travel">🚗 Car Travel</option>
<option value="bike_travel">🏍 Motorbike Travel</option>
<option value="bus_travel">🚌 Bus Travel</option>
<option value="train_travel">🚆 Train Travel</option>
<option value="flight_travel">✈ Flight Travel</option>

<!-- Energy -->
<option value="electricity_usage">⚡ Electricity Usage</option>
<option value="air_conditioner">❄ Air Conditioner</option>
<option value="heater_usage">🔥 Room Heater</option>
<option value="washing_machine">🧺 Washing Machine</option>
<option value="refrigerator">🧊 Refrigerator</option>

<!-- Food -->
<option value="vegetarian_meal">🥗 Vegetarian Meal</option>
<option value="nonveg_meal">🍗 Non-Veg Meal</option>
<option value="fast_food">🍔 Fast Food</option>
<option value="dairy_products">🥛 Dairy Products</option>

<!-- Digital -->
<option value="online_streaming">📺 Online Streaming</option>
<option value="video_gaming">🎮 Video Gaming</option>
<option value="laptop_usage">💻 Laptop Usage</option>
<option value="mobile_charging">📱 Mobile Charging</option>

<!-- Lifestyle -->
<option value="online_shopping">🛒 Online Shopping</option>
<option value="delivery_service">📦 Delivery Service</option>

<!-- Low Carbon -->
<option value="cycling">🚴 Cycling</option>
<option value="walking">🚶 Walking</option>
<option value="gym_workout">🏋 Gym Workout</option>

</select>

<label>Enter Quantity</label>

<input type="number" name="quantity" placeholder="Enter quantity (km / hours / units)" required>

<button type="submit">Save Activity</button>

</form>

<a class="back" href="dashboard.php">⬅ Back to Dashboard</a>

</div>

</div>

</body>
</html>