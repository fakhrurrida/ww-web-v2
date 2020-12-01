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

<?php
    if (isset($_POST['buy_submit'])) {
      echo "<script>
        alert(Your transaction successful!)
      </script>";
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

    <?php
      include('html_template/header.php');
    ?>

    <!-- Dashboard -->
    <section class="dashboard">

      <!-- Dashboard Title -->
      <div class="header-dashboard">
        <div class="dashboard-title"><h1><?php echo "Hello, $name!" ?></h1></div>
        <div class="view"><a href="viewall.php" class="view-link">View All Chocolate</a></div>
      </div>

      <!-- Box Container -->
      <div class="box-container">

        <!-- GET LIST OF CHOCOLATE -->
        <?php
          $sql = "SELECT cokelat.id_cokelat, img_link, nama_cokelat, sum(jumlah_terjual) AS jumlah_penjualan, price FROM cokelat JOIN penjualan ON cokelat.id_cokelat = penjualan.id_cokelat GROUP BY nama_cokelat ORDER BY jumlah_penjualan DESC LIMIT 10;";
          $result = mysqli_query($conn, $sql);
          $result_check = mysqli_num_rows($result);

          if ($result_check > 0){
           while($row = mysqli_fetch_assoc($result)){
             // <!-- Box -->
              echo "<a class='box' href='detail_user.php?id=".$row['id_cokelat']."'>
                <div class='box-header'>
                  <h3 class='box-title'>".$row['nama_cokelat']."</h3>
                </div>
                <div class='box-body'>
                  <img src='".$row['img_link']."' class='box-image' alt='chocolate-image'>
                </div>
                <div class='box-footer'>
                  <p class='amount'>Amount sold: ".$row['jumlah_penjualan']. "</p>
                  <p class='price'>Price: Rp. " .number_format($row['price'],2,",",".")."</p>
                </div>
            </a>";
           }
          }
        ?>
    </section>
    <?php
      include('html_template/footer.php');
    ?>
  </body>
</html>
