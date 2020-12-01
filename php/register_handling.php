<?php
include 'sqlconfig.php';

if (isset($_POST['username_check'])) {
  $username = $_POST['username'];
  $sql = "SELECT * FROM user WHERE id_user='$username'";
  $results = mysqli_query($db, $sql);
  if (mysqli_num_rows($results) > 0) {
      echo "taken";
  }else{
      echo 'not_taken';
  }
  exit();
}

if (isset($_POST['email_check'])) {
  $email = $_POST['email'];
  $sql = "SELECT * FROM user WHERE email='$email'";
  $results = mysqli_query($db, $sql);
  if (mysqli_num_rows($results) > 0) {
      echo "taken";
  }else{
      echo 'not_taken';
  }
  exit();
}

if (isset($_POST['confirm_password'])){
    echo "taken";
    exit();
}

if (isset($_POST['password_check'])){
    echo "taken";
    exit();
}

if (isset($_POST['save'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM user WHERE id_user='$username'";
    $results = mysqli_query($db, $sql);
    if (mysqli_num_rows($results) > 0) {
        echo "exists";
        exit();
    }else{
        $query = "INSERT INTO user
            VALUES ('$username', '$nama', '".md5($password)."', '$email', 1)";
        $results = mysqli_query($db, $query);
        echo 'Saved!';
        $cookie_uname = 'username';
        $cookie_uvalue = $username;
        setcookie($cookie_uname, $cookie_uvalue, time() + (86400 * 30), "/");
        header("location:../html/dashboard.php");
    }
}
?>
