<?php
include 'sqlconfig.php';

$username2 = $_POST['username'];
$pass = md5($_POST['password']);

$query = "SELECT user.id_user FROM user WHERE email='$username2' AND user.password='$pass'";
$results = mysqli_query($db, $query);
$hasil = mysqli_num_rows($results);
foreach (mysqli_fetch_assoc($results) as $row){
    $username = $row;
}
echo ($username);
echo ($pass);

if($hasil > 0){
    $cookie_uname = 'username';
    $cookie_uvalue = $username;
    setcookie($cookie_uname, $cookie_uvalue, time() + (86400 * 30), "/");
    header("location:../html/dashboard.php");
}
else{
    header("location:../html/login.php");
}
?>