<?php
    include_once 'php-config/dbh-config.php'
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="../css/result_page.css">
        <link rel="stylesheet" href="../css/nonlogin.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
       <title>Willy Wangky: Result Page</title>
    </head>
    <body>
        <?php
            include('html_template/header.php');
        ?>
        <div class="result-page">
          <div class="result_title">
              <h1>Searchin' dis?</h1>
          </div>
          <div class="result_bottom">
              <?php
                  $result_per_page = 5;
                  if (isset($_POST['submit_button'])){
                      $search = mysqli_real_escape_string($conn, $_POST['search']);
                  } elseif (isset($_GET['page'])){
                      $search  = $_GET['search'];
                  }
                  $sql = "SELECT cokelat.id_cokelat, nama_cokelat, price, total_amount, description, jumlah_terjual, sum(jumlah_terjual) as jumlah
                   FROM cokelat  LEFT JOIN penjualan ON cokelat.id_cokelat = penjualan.id_cokelat WHERE nama_cokelat LIKE '%$search%'
                  GROUP BY nama_cokelat";
                  $result = mysqli_query($conn, $sql);
                  $number_of_result = $query_result = mysqli_num_rows($result);
                  $number_of_page = ceil($number_of_result/$result_per_page);
                  if (!isset($_GET['page'])){
                      $page = 1;
                  } else{
                      $page = $_GET['page'];
                  }
              ?>
              <?php
                  $this_page_first_result = ($page-1)*$result_per_page;
                  if ((isset($_POST['submit_button'])) || (isset($_GET['page']))) {
                      if (isset($_POST['submit_button'])){
                          $search = mysqli_real_escape_string($conn, $_POST['search']);
                      } elseif (isset($_GET['page'])){
                          $search  = $_GET['search'];
                      }
                      $sql = "SELECT cokelat.id_cokelat, img_link, nama_cokelat, price, total_amount, description, jumlah_terjual, sum(jumlah_terjual) as jumlah
                      FROM cokelat  LEFT JOIN penjualan ON cokelat.id_cokelat = penjualan.id_cokelat WHERE nama_cokelat LIKE '%$search%'
                      GROUP BY nama_cokelat LIMIT $this_page_first_result, $result_per_page;";
                      $result = mysqli_query($conn, $sql);
                      $query_result = mysqli_num_rows($result);
                      if ($query_result > 0){
                          while($row = mysqli_fetch_assoc($result)){
                                echo "<a href='detail_user.php?id=".$row['id_cokelat']."'>".
                              '<div class ="result_section">'.
                              "<div class='section_img'>".
                              '<img src="'.$row['img_link'].'" alt="coklat" align="left">'.
                              "</div>".
                              "<div class ='result_text'>".
                              "<h2>". $row['nama_cokelat']. "</h2>"
                              ."Amount sold:". ($row['jumlah'])
                              ."<br>Price: "."Rp. ".number_format($row['price'],2,",",".") .
                              "<br>Amount remaining: ". ($row['total_amount']-$row['jumlah']).
                              "<br><br><span>Description: </span><br>".
                              $row['description']. "<br>".
                              "</div>".
                              "</div>".
                              "</a>"
                              ;
                          }
                      }
                      else {
                          echo "There are no result matching your search!";
                      }
                  }

              ?>
          </div>
          <a href='#' class="to-top">
              <i class="fas fa-chevron-up"></i>
          </a>

          <div class='paging'>
              <ul>
              <?php
                  echo 'page: ';
                  for ($page=1;$page<=$number_of_page;$page++) {
                      echo '<a href="result_page.php?page=' . $page . "&search=". $search.'">' . $page . '</a> ';
                  }
              ?>
              </ul>
          </div>
        </div>

        <!-- Footer -->
        <?php include('html_template/footer.php'); ?>

        <script src="../js/result_page.js"></script>
    </body>
</html>
