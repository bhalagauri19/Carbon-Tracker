<?php
// Include database connection file
include "db_connect.php";

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get user-entered full name
    $name = $_POST['name'];

    // Get user-entered email
    $email = $_POST['email'];

    // Hash the password before storing in database
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // SQL query to insert new user into users table
    $sql = "INSERT INTO users (name, email, password)
            VALUES ('$name', '$email', '$password')";

    // Execute the query
    if ($conn->query($sql)) {

        // Show success alert and redirect to login page
        echo "<script>
                alert('Registration successful! Please login.');
                window.location='login.php';
              </script>";
    } else {
        // Display database error if query fails
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Carbon Tracker - Register</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

/* Page background (same eco theme as index page) */
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

/* Registration form container */
.form-box {

    width:380px;

    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(12px);

    box-shadow:0 15px 35px rgba(0,0,0,0.5);

    border-radius:12px;

    color:white;
}

/* Header section */
.form-header {

    background: #00c853;

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

/* Register button */
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

/* Login link */
.login-link {

    text-align:center;

    margin-top:12px;
}

.login-link a{

    color:#a5d6a7;

    text-decoration:none;
}

/* Password field wrapper */
.password-wrapper {

    position:relative;
}

/* Extra space for eye icon */
.password-wrapper input {

    padding-right:42px;
}

/* Eye icon styling */
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

<!-- Registration form container -->
<div class="form-box">

<!-- Form title -->
<div class="form-header">🌍 Carbon Tracker Register</div>

<div class="form-body">

<form method="POST">

<!-- Full name -->
<input type="text" name="name" placeholder="Full Name" required>

<!-- Email -->
<input type="email" name="email" placeholder="Email" required>

<!-- Password -->
<div class="password-wrapper">

<input type="password" name="password" id="regPassword"
placeholder="Password" required>

<i class="fa fa-eye"
onclick="togglePassword('regPassword', this)">
</i>

</div>

<button type="submit">Register</button>

</form>

<div class="login-link">
<a href="login.php">Already registered? Login</a>
</div>

</div>

</div>

<script>

// Toggle password visibility
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