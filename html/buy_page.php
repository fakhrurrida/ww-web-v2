<?php
    include_once 'php-config/dbh-config.php';
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
    if ($role_id != 1){
        echo($role_id);
        header('location:../html/dashboard.php');
    }
?>

<!-- Validator -->
<?php

    $address = '';
    $amount = '';

   $errors = ['amount' => '', 'address' => '', 'others' =>''];
   if (isset($_POST['buy_submit'])) {

     // Redireect
     if (!empty($_POST['address']) && $_POST['amount']) {

       // Save the data to database
       // Get ID from URL
       $id = $_GET['id'];

       // Get Transaction Date and Time
       date_default_timezone_set("Asia/Bangkok");
       $date = date("Y-m-d");
       $time = date("H:i:s");

       // Escape bad char
       $amount = mysqli_real_escape_String($conn, $_POST['amount']);
       $address = mysqli_real_escape_String($conn, $_POST['address']);

       // Write query
       $query = "INSERT INTO penjualan VALUES(DEFAULT, '$amount', '$date', '$time', '$address', '$uname', '$id')";
      
       // Make request to WS Factory
      try{
        $request = 1;
        $params = 0;
        $soap_client = new SoapClient('url', $request);
        $response = $soap_client->ubahSaldo(params);
      }catch (Exception $e){
        echo $e -> getMessage();
      }

       //Save to Database
       if (mysqli_query($conn, $query)) {
         //redirect to Dashboard page
         header('location:dashboard.php');
       } else {
         echo "Query ERROR!";
       }

     }
     else {
       // Check Address
       if (empty($_POST['address'])) {
          $errors['address'] = "Please input your address!";
       }
       else {
          $address = $_POST['address'];
       }

       // Check Amount
       if (!$_POST['amount']) {
          $errors['amount'] = "You haven't bought anything yet!";
       }
       else {
          $amount = $_POST['amount'];
       }

     }
    }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Custom CSS -->
    <link rel="stylesheet" href='../css/nonlogin.css'>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700;900&display=swap" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <title>Buy Page</title>
  </head>
  <body>

    <!-- Navigation Bar -->
    <?php
      include('html_template/header.php');
     ?>

     <?php
        $id = $_GET['id'];
         $sql = "SELECT cokelat.id_cokelat, nama_cokelat, price, total_amount, description, jumlah_terjual, sum(jumlah_terjual) as jumlah, img_link
         FROM cokelat LEFT JOIN penjualan ON cokelat.id_cokelat = penjualan.id_cokelat WHERE cokelat.id_cokelat = '$id'
         GROUP BY nama_cokelat";
         $result = mysqli_query($conn, $sql);
         $query_result = mysqli_num_rows($result);
         $row = mysqli_fetch_assoc($result);
         // Setting variables
         $name = $row['nama_cokelat'];
         $amount = $row['total_amount'] - $row['jumlah'];
         $price = $row['price'];
         $sold = $row['jumlah'];
         if (!$sold) {
           $sold = 0;
         }
         $desc = $row['description'];
         $img = $row['img_link'];

         if (!$query_result){
           echo "<h1 class='no-buy'>You don't have any chocolate to buy!</h1>";
         }
         elseif (!$amount) {
           echo "<h1 class= \"out-of-stock\">Item out of stock!</h1>";
           echo "<a class='back' href='dashboard.php'>Back to Dashboard</a>";
         }
         else {
           echo "<!-- Buy Page -->
           <form class=\"buying-form\" action=\"\" method=\"POST\">
             <section id='buypage' class=\"buypage\">
               <h1 class=\"buypage-title\">Your Cart <i class=\"fas fa-shopping-cart\"></i></h1>
               <div class=\"buy-item\">

                 <!-- Buying Item image -->
                 <div class=\"img-container item\">
                   <img src=\"".$img."\" class=\"img-item\" alt=\"Chocolate Image \">
                 </div>

                 <!-- Buying Item Description -->
                 <div class=\"desc-container item\">
                   <div class=\"description\">
                     <h3 class=\"item-title\">".$name."</h1>
                     <table class=\"desc\">
                       <tbody>
                         <tr class=\"row\">
                           <td class=\"sold\">Amount Sold</td>
                           <td id='sold-value' class=\"sold-value\">: "."$sold"."</td>
                         </tr>
                         <tr class=\"row\">
                           <td class=\"price\">Price</td>
                           <td id='price-value' class=\"price-value\">: Rp".$price.",00</td>
                         </tr>
                         <tr class=\"row\">
                           <td class=\"remain\">Amount remaining</td>
                           <td id='remain-value' class=\"remain-value\">: ".$amount."</td>
                         </tr>
                       </tbody>
                     </table>
                     <h6 class=\"desc title-desc\">Description</h6>
                     <p class='desc-text'>"
                       .$desc."
                     </p>

                     <!-- Amount to Buy -->
                     <div class=\"buying\">
                        <div class=\"amount-to-buy\">
                          <div class=\"buy-amount-text\">Amount to Buy:</div>
                          <div class=\"buy-amount-box\">
                            <button type=\"button\" name=\"button\" class=\"dec amount-btn\" onclick='decrementValue()'>&#8722;</button>
                            <input class=\"amount-value\" name=\"amount\" id='amount' value='0'>
                            <button type=\"button\" name=\"button\" class=\"inc amount-btn\" onclick='incrementValue()'>+</button>
                          </div>
                          <div class='decrement' id='decrement'>
                            ".$errors['amount']."
                          </div>
                        </div>
                        <div class=\"total-price\">
                          <div class=\"total-price-text\">Total Price:</div>
                          <h4 id='buying-price' class=\"buying-price\" >0</h4>
                        </div>
                     </div>
                   </div>
                 </div>
               </div>

               <!-- Address -->
               <div class=\"address-container\">
                  <h3 class=\"address-text\">Fill your Address:</h3>
                  <div class=\"address-fill-container\">
                    <textarea id=\"address\" name=\"address\" class=\"address\" value=".$address."></textarea>
                  </div>
                  <div class='address-error'>".$errors['address']."</div>
               </div>

               <!-- Button -->
               <div class=\"button-container\">
                 <button type=\"button\" name=\"button\" class=\"cancel btn\">Cancel</button>
                 <button type=\"submit\" name=\"buy_submit\" class=\"buy btn\">Buy</button>
               </div>
             </section>
           </form>";
         }
     ?>

      <!-- Footer -->
     <?php
       include('html_template/footer.php');
     ?>
    <script type="text/javascript" src="../js/buy_page.js"></script>

  </body>
</html>
