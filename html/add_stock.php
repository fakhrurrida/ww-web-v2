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
    if ($role_id != 2){
        echo($role_id);
        header('location:../html/dashboard.php');
    }
?>

<!-- Validator -->
<?php

    $amount = '';

   $errors = ['amount' => '', 'others' =>''];
   if (isset($_POST['buy_submit'])) {

    // Redireect
    if ($_POST['amount']) {

      // Save the data to database
      // Get ID from URL
      $id = $_GET['id'];

      // Escape bad char
      $amount = mysqli_real_escape_String($conn, $_POST['amount']);

      // Write query
      $query = "UPDATE cokelat SET cokelat.total_amount = cokelat.total_amount + '$amount' WHERE cokelat.id_cokelat = '$id'";

      //Save to Database
      if (mysqli_query($conn, $query)) {
        //redirect to Dashboard page
        header('location:dashboard.php');
      } else {
        echo "Query ERROR!";
      }

    }
    else {
      // Check Amount
      if (!$_POST['amount']) {
         $errors['amount'] = "You haven't added anything yet!";
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
    <title>Add Stock</title>
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
         $amount = $row['total_amount'];
         $price = $row['price'];
         $sold = $row['jumlah'];
         if (!$sold) {
           $sold = 0;
         }
         $desc = $row['description'];
         $img = $row['img_link'];

         if (!$query_result){
           echo "<h1 class='no-buy'>You don't have any chocolate to add!</h1>";
         }
         else {
           echo "<!-- Add Stock Page -->
           <form class=\"buying-form\" action=\"\" method=\"POST\">
             <section id='buypage' class=\"buypage\">
               <h1 class=\"buypage-title\">Your Product<i class=\"fas fa-shopping-cart\"></i></h1>
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

                     <!-- Amount to Add -->
                     <div class=\"buying\">
                        <div class=\"amount-to-buy\">
                          <div class=\"buy-amount-text\">Amount to Add:</div>
                          <div class=\"buy-amount-box\">
                            <button type=\"button\" name=\"button\" class=\"dec amount-btn\" onclick='decrementValue()'>&#8722;</button>
                            <input class=\"amount-value\" name=\"amount\" id='amount' value='0'>
                            <button type=\"button\" name=\"button\" class=\"inc amount-btn\" onclick='incrementValue()'>+</button>
                          </div>
                          <div class='decrement' id='decrement'>
                            ".$errors['amount']."
                          </div>
                        </div>
                     </div>
                   </div>
                 </div>
               </div>

               <!-- Button -->
               <div class=\"button-container\">
                 <button type=\"button\" name=\"button\" class=\"cancel btn\">Cancel</button>
                 <button type=\"submit\" name=\"buy_submit\" class=\"buy btn\">Add</button>
               </div>
             </section>
           </form>";
         }
     ?>

      <!-- Footer -->
     <?php
       include('html_template/footer.php');
     ?>
    <script type="text/javascript" src="../js/add_stock.js"></script>

  </body>
</html>
