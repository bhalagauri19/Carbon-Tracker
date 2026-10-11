<?php
// Start session
session_start();

// If user not logged in redirect to login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Carbon Tracker Dashboard</title>

<style>

/* Page background */
body{
    margin:0;
    font-family: Arial, sans-serif;
    height:100vh;

    background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);

    display:flex;
    justify-content:center;
    align-items:center;
}

/* Dashboard container */
.dashboard{

    width:450px;

    background: rgba(255,255,255,0.08);

    backdrop-filter: blur(12px);

    border-radius:12px;

    padding:35px;

    text-align:center;

    color:white;

    box-shadow:0 15px 35px rgba(0,0,0,0.5);
}

/* Title */
.dashboard h1{

    margin-bottom:10px;

    color:#00e676;
}

/* Welcome text */
.dashboard p{

    margin-bottom:25px;

    color:#e0e0e0;
}

/* Button container */
.menu{

    display:flex;

    flex-direction:column;

    gap:15px;
}

/* Buttons */
.menu a{

    text-decoration:none;

    padding:12px;

    border-radius:6px;

    background:#00c853;

    color:white;

    font-weight:bold;

    transition:0.3s;
}

/* Hover effect */
.menu a:hover{

    background:#00e676;

    transform:scale(1.05);
}

/* Logout button color */
.logout{

    background:#e53935;
}

.logout:hover{

    background:#ff5252;
}

</style>

</head>

<body>

<div class="dashboard">

<h1>🌍 Carbon Tracker</h1>

<p>Welcome, <b><?php echo $_SESSION['name']; ?></b></p>

<div class="menu">

<a href="add_activity.php">➕ Add Activity</a>

<a href="report.php">📊 View Carbon Report</a>

<a href="graph.php">📈 View Graph</a>

<a href="logout.php" class="logout">🚪 Logout</a>

</div>

</div>

</body>
</html>