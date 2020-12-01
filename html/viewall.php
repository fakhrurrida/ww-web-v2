<?php
    include_once 'php-config/dbh-config.php';
    $cookie_name = 'username';
    $uname = '';
      if(!isset($_COOKIE[$cookie_name])) {
        header('location:../html/login.php');
      } else {
        $uname = $_COOKIE[$cookie_name];
      }
      $sql = "SELECT user.nama_lengkap
      FROM user 
      WHERE user.id_user = '$uname';";
      $result = mysqli_query($conn, $sql);
      $result_check = mysqli_num_rows($result);
      if ($result_check > 0){
        foreach (mysqli_fetch_assoc($result) as $row){
            $name = $row;
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/nonlogin.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
  </head>
  <body>

    <!-- Navigation Bar -->
    <?php
      include_once 'php-config/dbh-config.php';
      include('html_template/header.php');
    ?>

    <!-- Dashboard -->
    <section id='dashboard' class="dashboard">

      <!-- Dashboard Title -->
      <div class="header-dashboard">
        <?php
          echo '<div class="dashboard-title"><h1>Hello, '.$name.'!</h1></div>';
        ?>
      </div>

      <!-- Box Container -->
      <div class="box-container">

        <!-- GET LIST OF ALL CHOCOLATE -->
        <?php
          $sql = "SELECT cokelat.id_cokelat, nama_cokelat, img_link, sum(jumlah_terjual) AS jumlah_penjualan, price FROM cokelat LEFT JOIN penjualan ON cokelat.id_cokelat = penjualan.id_cokelat GROUP BY nama_cokelat ORDER BY jumlah_penjualan DESC;";
          $result = mysqli_query($conn, $sql);
          $result_check = mysqli_num_rows($result);

          if ($result_check > 0){
           while($row = mysqli_fetch_assoc($result)){
             // <!-- Box -->
              echo "<a class='box' href='detail_user.php?id=".$row['id_cokelat']."'>".
              "<div class='box-header'>
                <h3 class='box-title'>".$row['nama_cokelat']."</h3>
              </div>
              <div class='box-body'>
                <img src='".$row['img_link']."' class='box-image' alt='chocolate-image'>
              </div>
              <div class='box-footer'>
                <p class='amount'>Amount sold: ".$row['jumlah_penjualan']. "</p>
                <p class='price'>Price: Rp. " .number_format($row['price'],2,",",".")."</p>
              </div> </a>";
           }
          }
        ?>
    </section>

    <!-- Footer -->
    <?php
      include('html_template/footer.php');
    ?>
  </body>
</html>
