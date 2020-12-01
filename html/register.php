<?php
    include '../php/register_handling.php';
?>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/register.css">
   <title>Willy Wangky: Register</title>
</head>
<body>
    <div class="sebuah_container">
    <div class="login">
        <div class="judulnya">
            <h1>Willy Wangky®<br>Account Registration</h1>
        </div>
        <div class="kotaknya">
            <form id="register_form">
            <label>Name</label>
            <input type="text" placeholder="Enter your fullname..." name="nama" id="nama">
            <div class="username">
                <label>Username</label>
                <input type="text" placeholder="Enter username..." name="username" id="username">
                <span></span>
            </div>
            <div class="email">
                <label>Email address</label>
                <input type="text" placeholder="Enter your email address..." name="email" id="email">
                <span></span>
            </div>
            <div class="password">
                <label>Password</label>
                <input type="password" placeholder="Enter your password..." name="password" id="password">
                <span></span>
            </div>
            <div class="confirmpassword">
                <label>Confirm Password</label>
                <input type="password" placeholder="Enter your password again..." name="confirmpassword" id="confirmpassword">
                <span></span>           
            </div>
            <button type="button" name="reg_btn" id="reg_btn">Register</button>
            <div class="reminder">
            Already had an account? <a href="login.php">Login</a>
            </div>
            </form>
        </div>
    </div>
    <div class="pikcer"></div>
    </div>
</body>
</html>
<script src="../js/setup.js"></script>
<script src="../js/register_script.js"></script>
