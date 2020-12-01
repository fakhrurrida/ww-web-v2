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
        <link rel="stylesheet" href="../css/detail_page.css">
        <link rel="stylesheet" href="../css/nonlogin.css">
        <title>Willy Wangky: Chocolate Detail</title>
    </head>
    <body>
        <?php
            include('html_template/header.php');
        ?>

        <div class="content">
                <?php
                    $id = $_GET['id'];
                    $sql = "SELECT cokelat.id_cokelat, img_link, nama_cokelat, price, total_amount, description, jumlah_terjual, sum(jumlah_terjual) as jumlah
                    FROM cokelat  LEFT JOIN penjualan ON cokelat.id_cokelat = penjualan.id_cokelat WHERE cokelat.id_cokelat = '$id'
                    GROUP BY nama_cokelat";
                    $result = mysqli_query($conn, $sql);
                    $query_result = mysqli_num_rows($result);
                    $row = mysqli_fetch_assoc($result);
                    if ($query_result){
                        echo
                        "<div class ='result'> <div class='section_img'>".
                            '<img src="'.$row['img_link'].'" alt="coklat" align="left">'.
                        "</div>".
                        "<div class ='result_text'>".
                            "<div class='merek_coklat'>". $row['nama_cokelat']. "</div>"
                            ."Rp. ".number_format($row['price'],2,",",".")
                            ."<br><br>Total Amount: <b>". ($row['total_amount'])
                            ."</b><br>Amount Sold: <b>". ($row['jumlah'])
                            ."</b><br><br><b>Description</b><br>".
                            $row['description']. "<br>".
                        "</div> </div>";
                    }
                ?>

        </div>
        <div class = "sub-btn">
            <?php 
                if ($role_id==1){
                    echo "<button id='buynow_submit' onclick='location.href =\"buy_page.php?id=".$id."\"' type=\"submit\" name=\"buynow_submit\">Buy Now</button>";
                }
                elseif ($role_id==2){
                    echo "<button id='buynow_submit' onclick='location.href =\"add_stock.php?id=".$id."\"' type=\"submit\" name=\"buynow_submit\">Add Stock</button>";
                }
            ?>
        </div>
    </body>
</html>
