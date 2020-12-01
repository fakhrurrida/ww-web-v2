<!doctype html>
<?php
    $cookie_uname = 'username';
    $cookie_uvalue = 'loggedout';
    setcookie($cookie_uname, $cookie_uvalue, time() - 3600, "/");
?>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/login.css">
   <title>Willy Wangky: Login</title>
</head>
<body>
    <div class="sebuah_container">
        <div class="pikcer"></div>
        <div class="login">
            <div class="judulnya">
                <h1>Willy Wangky®<br> Account Login</h1>
            </div>
            <div class="kotaknya">
                <form action="../php/login_handling.php" method="POST" onsubmit="return validasi()">

                <input type="text" name="username" id="username" placeholder="Email Address">
              
                <input type="password" name="password" id="password" placeholder="Password">
                <button type="submit" value="Login" class="tombol_login">Login</button>
                Don't have account? <a href="register.php">Register</a>
                </form>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    function validasi(){
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        if (username != "" && password != ""){
            return true;
        }
        else{
            alert("Username dan Password tidak boleh kosong!");
            return false;
        }
    }
</script>

</html>