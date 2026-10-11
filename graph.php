<?php
session_start();
include "db_connect.php";

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'];

/* Get activity carbon totals */

$sql = "SELECT activity_type, SUM(carbon) as total_carbon
        FROM activities
        WHERE user_id='$user_id'
        GROUP BY activity_type";

$result = $conn->query($sql);

$activities = [];
$carbon = [];

while($row = $result->fetch_assoc()){
    $activities[] = $row['activity_type'];
    $carbon[] = $row['total_carbon'];
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Carbon Graph</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
margin:0;
font-family:Arial;
background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
color:white;
}

/* Header */

.header{
background:#1b5e20;
padding:20px;
text-align:center;
font-size:28px;
font-weight:bold;
}

/* Main container */

.container{
width:90%;
margin:auto;
margin-top:30px;
text-align:center;
}

/* Graph layout */

.graph-row{
display:flex;
justify-content:center;
align-items:flex-start;
gap:40px;
flex-wrap:wrap;
}

/* Chart box */

.chart-box{
width:420px;
background:rgba(255,255,255,0.1);
padding:20px;
border-radius:10px;
}

/* Canvas styling */

canvas{
background:white;
border-radius:8px;
padding:10px;
}

/* Back button */

.back{
display:inline-block;
margin-top:30px;
padding:10px 20px;
background:#00c853;
color:white;
text-decoration:none;
border-radius:6px;
}

.back:hover{
background:#00e676;
}

</style>

</head>

<body>

<div class="header">
📊 Carbon Emission Analysis
</div>

<div class="container">

<div class="graph-row">

<!-- Bar Chart -->

<div class="chart-box">

<h3>Carbon Emission by Activity</h3>

<canvas id="barChart" width="380" height="240"></canvas>

</div>

<!-- Pie Chart -->

<div class="chart-box">

<h3>Activity Contribution</h3>

<canvas id="pieChart" width="320" height="240"></canvas>

</div>

</div>

<a class="back" href="dashboard.php">⬅ Back to Dashboard</a>

</div>

<script>

/* Data from PHP */

const activities = <?php echo json_encode($activities); ?>;
const carbon = <?php echo json_encode($carbon); ?>;

/* Bar Chart */

new Chart(document.getElementById("barChart"),{

type:"bar",

data:{
labels:activities,
datasets:[{
label:"Carbon Emission (kg CO₂)",
data:carbon,
backgroundColor:"#4CAF50"
}]
},

options:{
responsive:false,

plugins:{
legend:{
display:true
}
},

scales:{

y:{
beginAtZero:true,
title:{
display:true,
text:"Carbon (kg CO₂)"
},
ticks:{
stepSize:2
},
grid:{
color:"#ccc"
}
},

x:{
title:{
display:true,
text:"Activity Type"
}
}

}

}

});

/* Pie Chart */

new Chart(document.getElementById("pieChart"),{

type:"pie",

data:{
labels:activities,
datasets:[{
data:carbon,
backgroundColor:[
"#4CAF50",
"#FF9800",
"#2196F3",
"#F44336",
"#9C27B0"
]
}]
},

options:{
responsive:false
}

});

</script>

</body>
</html>