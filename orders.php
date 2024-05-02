<?php

include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="./css/hello.css">

   <style>
      .placed-orders .title {
         text-align: center;
         margin-bottom: 20px;
         text-transform: uppercase;
         color: black;
         font-size: 40px;
      }

      .placed-orders .box-container {
         max-width: 1200px;
         margin: 0 auto;
         display: flex;
         flex-wrap: wrap;
         align-items: center;
         gap: 20px;
      }

      .placed-orders .box-container .empty {
         flex: 1;
      }

      .placed-orders .box-container .box {
         flex: 1 1 400px;
         border-radius: .5rem;
         padding: 15px;
         border: 2px solid brown;
         background-color: white;
         padding: 10px 20px;
      }

      .placed-orders .box-container .box p {
         padding: 10px 0 0 0;
         font-size: 20px;
         color: gray;
      }

      .placed-orders .box-container .box p span {
         color: black;
      }
   </style>

</head>

<body>

   <?php include 'index_header.php'; ?>
   <section class="placed-orders">

      <h1 class="title">placed orders</h1>

      <div class="box-container">

         <?php
         $select_tree = mysqli_query($conn, "SELECT * FROM `confirm_order`WHERE user_id = '$user_id' ORDER BY order_date DESC") or die('query failed');
         if (mysqli_num_rows($select_tree) > 0) {
            while ($fetch_tree = mysqli_fetch_assoc($select_tree)) {
         ?>
               <div class="box">
                  <p> Order Date : <span><?php echo $fetch_tree['order_date']; ?></span> </p>
                  <p> Order Id : <span># <?php echo $fetch_tree['order_id']; ?> </p>
                  <p> Name : <span><?php echo $fetch_tree['name']; ?></span> </p>
                  <p> Mobile Number : <span><?php echo $fetch_tree['number']; ?></span> </p>
                  <p> Email Id : <span><?php echo $fetch_tree['email']; ?></span> </p>
                  <p> Address : <span><?php echo $fetch_tree['address']; ?></span> </p>
                  <p> Payment Method : <span><?php echo $fetch_tree['payment_method']; ?></span> </p>
                  <p> Your orders : <span><?php echo $fetch_tree['total_trees']; ?></span> </p>
                  <p> Total price : <span>RM <?php echo $fetch_tree['total_price']; ?></span> </p>
                  <p> Payment status : <span style="color:black">Completed</span></p>
               </div>

         <?php
            }
         } else {
            echo '<p class="empty">You have not placed any order yet!!!!</p>';
         }
         ?>
      </div>

   </section>

   <?php include 'index_footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>