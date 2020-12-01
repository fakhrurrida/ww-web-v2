<?php
    include('php-config/dbh-config.php');
    $role_id = 3;
    $cookie_name = 'username';
    $uname = '';
      if(!isset($_COOKIE[$cookie_name])) {
        header('location:../html/login.php');
      } else {
        $uname = $_COOKIE[$cookie_name];
      }
    $sql = "SELECT user.role
            FROM user
            WHERE user.id_user = '$uname';";
    $result = mysqli_query($conn, $sql);
    $result_check = mysqli_num_rows($result);
    if ($result_check > 0){
        foreach (mysqli_fetch_assoc($result) as $row){
            $role_id = $row;
        }
    }
?>
<!DOCTYPE html>
<html>
  <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Custom CSS -->
      <link rel="stylesheet" href="../../css/nonlogin.css">
      <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
      <script src='../js/buy_page.js'></script>
      <title>Willy Wangky: Transaction History</title>
  </head>
  <body>
    <nav class="nav-bar">


      <!-- List Menu ---------------------------------------------------------->
      <div class="menu" id="menu">

        <!-- Toggle Button ---------------------------------------------------->
        <div class="toggler-container">
          <button class="toggler" type="button" data-toggle="collapse" data-target="#menu" onclick="toggle()">
              <span class="toggler-icon"><i class="fas fa-bars"></i></span>
          </button>
        </div>

        <div class="menu-container" id="menuContainer">
          <!-- Menu List -->
          <ul class="menu-list">
              <li class="menu-item"><a href="dashboard.php" class="item-link">Home</a></li>
              <?php
                if ($role_id==1){
                  echo '<li class="menu-item"><a href="transaction_history.php" class="item-link">History</a></li>';
                }
                elseif ($role_id==2){
                  echo '<li class="menu-item"><a href="add_new_chocolate.php" class="item-link">Add Chocolate</a></li>';
                }

              ?>
              <div class="account-menu">
                <ul class="account-manage-list">
                  <li class="login-item"><a href="login.php" class="account-link">Logout</a>
                </ul>
              </div>
          </ul>
        </div>

        <!-- Search ----------------------------------------------------------->
        <div class="search-container">
            <form action="result_page.php" method="POST" class="search-bar">
                <input class="search-box" type="text" name="search" placeholder="What chocolate do you like?">
                <button class="search-btn" type="submit" name="submit_button">
                <i class="fas fa-search"></i>
                </button>
            </form>
        </div>


        <!-- Account Management -->
        <div class="account-manage">
            <div class="sign-in"><a class="account-link" href="login.php">Logout</a></div>
        </div>
      </div>
    </nav>
  </body>
</html>
