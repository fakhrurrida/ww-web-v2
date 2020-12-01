<?php
    include_once 'php-config/dbh-config.php';
    $cookie_name = 'username';
    $uname = '';
      if(!isset($_COOKIE[$cookie_name])) {
        header('location:../html/login.php');
      } else {
        $uname = $_COOKIE[$cookie_name];
      }
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;900&display=swap" rel="stylesheet">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="../css/transaction_history.css">
        <link rel="stylesheet" href="../css/nonlogin.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
       <title>Willy Wangky: Transaction History</title>
    </head>
    <body>
        <?php
            include('html_template/header.php');
        ?>
        <div class="transaction_field">
            <h1>Transaction History</h1>
            <table id="transaction_table">
                <thead>
                    <tr id="table_top">
                        <th>Chocolate Name</th>
                        <th>Amount</th>
                        <th>Total Price</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT cokelat.id_cokelat, nama_cokelat, jumlah_terjual, date_transaction, time_transaction, penjualan.id_user,
                        address, price FROM cokelat LEFT JOIN penjualan ON cokelat.id_cokelat = penjualan.id_cokelat
                        WHERE penjualan.id_user = '$uname'
                        ORDER BY date_transaction DESC;";
                        $result = mysqli_query($conn, $sql);
                        $result_check = mysqli_num_rows($result);
                        if ($result_check > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<tr>";
                                echo "<td><a href='detail_user.php?id=".$row['id_cokelat']."'>" .$row['nama_cokelat']."</a></td>";
                                echo "<td>" .$row['jumlah_terjual']."</td>";
                                echo "<td>" ."Rp. ".number_format(($row['jumlah_terjual']*$row['price']),2,",",".") ."</td>";
                                echo "<td>" .$row['date_transaction']."</td>";
                                echo "<td>". $row['time_transaction']."</td>";
                                echo "<td>". $row['address']."</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <?php include('html_template/footer.php') ?>
    </body>
</html>
