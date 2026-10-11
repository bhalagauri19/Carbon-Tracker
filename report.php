<?php
session_start();
include "db_connect.php";

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
}

$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'];

// Get user activities
$sql = "SELECT * FROM activities WHERE user_id='$user_id' ORDER BY date DESC";
$result = $conn->query($sql);

// Calculate total carbon
$total_carbon = 0;
$total_activities = $result->num_rows;

while($row = $result->fetch_assoc()){
    $total_carbon += $row['carbon'];
}

// Carbon level check
$status = "";
$status_color = "";

if($total_carbon < 20){
    $status = "Safe Level";
    $status_color = "green";
}
elseif($total_carbon < 50){
    $status = "Moderate Level";
    $status_color = "orange";
}
else{
    $status = "High Carbon Footprint";
    $status_color = "red";
}

// Fetch activities again for table
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>

<title>Carbon Report</title>

<style>

body{
    margin:0;
    font-family: Arial;
    background: linear-gradient(135deg,#0f2027,#2c5364);
    color:white;
}

/* header */

.header{
    background:#1b5e20;
    padding:20px;
    text-align:center;
    font-size:26px;
    font-weight:bold;
}

/* container */

.container{
    width:90%;
    margin:auto;
    margin-top:30px;
}

/* summary cards */

.cards{
    display:flex;
    gap:20px;
    margin-bottom:30px;
}

.card{
    flex:1;
    background:white;
    color:black;
    padding:20px;
    border-radius:8px;
    text-align:center;
    box-shadow:0 4px 10px rgba(0,0,0,0.3);
}

.card h2{
    margin:10px 0;
}

/* report status */

.status{
    font-size:20px;
    font-weight:bold;
}

/* table */

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    color:black;
    border-radius:8px;
    overflow:hidden;
}

table th{
    background:#2e7d32;
    color:white;
    padding:12px;
}

table td{
    padding:10px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

tr:hover{
    background:#f2f2f2;
}

/* back button */

.back-btn{
    margin-top:20px;
    display:inline-block;
    padding:10px 20px;
    background:#2e7d32;
    color:white;
    text-decoration:none;
    border-radius:5px;
}

.back-btn:hover{
    background:#1b5e20;
}

</style>
</head>

<body>

<div class="header">
🌍 Carbon Emission Report
</div>

<div class="container">

<!-- SUMMARY CARDS -->

<div class="cards">

<div class="card">
<h3>User</h3>
<h2><?php echo $name; ?></h2>
</div>

<div class="card">
<h3>Total Activities</h3>
<h2><?php echo $total_activities; ?></h2>
</div>

<div class="card">
<h3>Total Carbon</h3>
<h2><?php echo number_format($total_carbon,2); ?> kg CO₂</h2>
</div>

<div class="card">
<h3>Status</h3>
<h2 class="status" style="color:<?php echo $status_color; ?>">
<?php echo $status; ?>
</h2>
</div>

</div>

<!-- ACTIVITIES TABLE -->

<table>

<tr>
<th>Activity</th>
<th>Quantity</th>
<th>Carbon (kg CO₂)</th>
<th>Date</th>
</tr>

<?php

if($result->num_rows > 0){

while($row = $result->fetch_assoc()){

echo "<tr>
<td>".$row['activity_type']."</td>
<td>".$row['quantity']."</td>
<td>".$row['carbon']."</td>
<td>".$row['date']."</td>
</tr>";

}

}else{

echo "<tr><td colspan='4'>No activities found</td></tr>";

}

?>

</table>

<br>

<a class="back-btn" href="dashboard.php">⬅ Back to Dashboard</a>

</div>

</body>
</html>