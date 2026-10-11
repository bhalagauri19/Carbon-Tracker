<?php
// Start the session to store user login data
session_start();

// Include database connection file
include "db_connect.php";

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get email entered from login form
    $email = $_POST['email'];

    // Get password entered from login form
    $password = $_POST['password'];

    // SQL query to check if user exists with given email
    $sql = "SELECT * FROM users WHERE email='$email'";

    // Execute the query
    $result = $conn->query($sql);

    // Check if exactly one user record is found
    if ($result->num_rows == 1) {

        // Fetch user data as associative array
        $user = $result->fetch_assoc();

        // Verify entered password with hashed password from database
        if (password_verify($password, $user['password'])) {

            // Store user information in session variables
            $_SESSION['user_id'] = $user['id'];   // User ID
            $_SESSION['name'] = $user['name'];    // User name

            // Redirect user to dashboard
            header("Location: dashboard.php");

        } else {
            // If password does not match
            echo "<script>alert('Incorrect password!');</script>";
        }

    } else {
        // If no user is found with given email
        echo "<script>alert('User not found!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Carbon Tracker - Login</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

/* Background eco theme */
body {
    margin:0;
    padding:0;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
}

/* Login container */
.form-box {

    width:380px;

    background: rgba(255,255,255,0.08);

    backdrop-filter: blur(12px);

    box-shadow:0 15px 35px rgba(0,0,0,0.5);

    border-radius:12px;

    color:white;
}

/* Header */
.form-header {

    background:#00c853;

    padding:16px;

    text-align:center;

    font-size:22px;

    font-weight:bold;

    border-top-left-radius:12px;
    border-top-right-radius:12px;
}

/* Form body */
.form-body {

    padding:25px;
}

/* Input fields */
.form-body input {

    width:100%;

    padding:10px;

    margin-bottom:15px;

    border:none;

    border-radius:5px;

    outline:none;

    box-sizing:border-box;
}

/* Button */
.form-body button {

    width:100%;

    padding:12px;

    background:#00c853;

    color:white;

    border:none;

    border-radius:6px;

    font-size:16px;

    cursor:pointer;

    transition:0.3s;
}

/* Hover effect */
.form-body button:hover {

    background:#00e676;

    transform:scale(1.03);
}

/* Register link */
.register-link {

    text-align:center;

    margin-top:12px;
}

.register-link a{

    color:#a5d6a7;

    text-decoration:none;
}

/* Password wrapper */
.password-wrapper {

    position:relative;
}

/* Space for eye icon */
.password-wrapper input {

    padding-right:42px;
}

/* Eye icon */
.password-wrapper i {

    position:absolute;

    right:14px;

    top:50%;

    transform:translateY(-50%);

    cursor:pointer;

    color:#333;
}

</style>

</head>

<body>

<div class="form-box">

<div class="form-header">🌍 Carbon Tracker Login</div>

<div class="form-body">

<form method="POST">

<input type="email" name="email" placeholder="Email" required>

<div class="password-wrapper">

<input type="password" name="password" id="loginPassword" placeholder="Password" required>

<i class="fa fa-eye"
onclick="togglePassword('loginPassword', this)">
</i>

</div>

<button type="submit">Login</button>

</form>

<div class="register-link">
<a href="register.php">New user? Register</a>
</div>

</div>

</div>

<script>

/* Toggle password visibility */

function togglePassword(inputId, icon) {

const input = document.getElementById(inputId);

if (input.type === "password") {

    input.type = "text";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");

} else {

    input.type = "password";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");

}

}

</script>

</body>
</html>