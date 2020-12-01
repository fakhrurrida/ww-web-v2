<?php 
    include '../php/add_chocolate_handling.php'; 
    include('php-config/dbh-config.php');
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
    if ($role_id != 2){
        echo($role_id);
        header('location:../html/dashboard.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="../css/add_new_chocolate.css">
        <link rel="stylesheet" href="../css/nonlogin.css">
       <title>Willy Wangky: Add New Chocolate</title>
    </head>
    <body>
        <?php
        include_once 'php-config/dbh-config.php';
        include('html_template/header.php');
        ?>
        <div class="transaction_field"> 
            <h1>Add New Chocolate</h1>
            <form action="../php/add_chocolate_handling.php" id="add_chocolate" method="POST" enctype="multipart/form-data">
                <div class="nama">
                    <label>
                        Name
                    </label>
                    <input type="text" name="nama" id="nama">
                </div>
                <div class="harga">
                    <label>
                        Price
                    </label>
                    <input type="text" name="price" id="price">
                </div>
                <div class="deskripsi">
                    <label>
                        Description
                    </label>
                    <input type="text" name="deskripsi" id="deskripsi">
                </div>
                <div class="gambar">
                    <label>
                        Image
                    </label>
                    <input type="file" name="gambar" id="gambar" accept="image/x-png, image/gif, image/jpeg, image/jpg">    
                </div>
                <div class="jumlah">
                    <label>
                        Amount
                    </label>
                    <input type="number" name="jumlah" id="jumlah">
                </div> 
                <div class="bahan">
                    <label>
                        Recipe
                    </label>
                    <input type="text" name="bahan" id="bahan">
                </div>
                <div class="jumlah_bahan">
                    <label>
                        Quantity
                    </label>
                    <input type="text" name="quantity" id="quantity">
                </div>
                <button type="submit" name="register" id="reg_btn">Add Chocolate</button>  
            </form> 
        </div>
        <div class = "bahan_container">
            <h3>Daftar Bahan pada Supplier</h3>
            <table class = "tabel_bahan">
                <tr>
                    <th>Nama bahan</th>
                    <th>Nama supplier</th>
                    <th>Harga</th>
                </tr>
            </table>
        </div>
        <?php
            include('html_template/footer.php');
        ?>
        <script type="text/javascript" src="../js/add_chocolate.js"></script>
    </body>
</html>