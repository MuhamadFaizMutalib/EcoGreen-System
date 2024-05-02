<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
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
      .cart-btn1,
      .cart-btn2 {
         display: inline-block;
         margin-top: 0.4rem;
         padding: 0.2rem 0.8rem;
         cursor: pointer;
         color: white;
         font-size: 15px;
         border-radius: .5rem;
         text-transform: capitalize;
      }

      .cart-btn1 {
         margin-left: 40%;
         background-color: red;
      }

      .cart-btn2 {
         background-color: #ffa41c;
         color: black;
      }

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
         border: 2px solid rgb(9, 218, 255);
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

      .message {
         position: sticky;
         top: 0;
         margin: 0 auto;
         width: 61%;
         background-color: #fff;
         padding: 6px 9px;
         display: flex;
         align-items: center;
         justify-content: space-between;
         z-index: 100;
         gap: 0px;
         border: 2px solid rgb(68, 203, 236);
         border-top-right-radius: 8px;
         border-bottom-left-radius: 8px;
      }

      .message span {
         font-size: 22px;
         color: rgb(240, 18, 18);
         font-weight: 400;
      }

      .message i {
         cursor: pointer;
         color: rgb(3, 227, 235);
         font-size: 15px;
      }
   </style>

</head>

<body>

   <?php include 'admin_header.php'; ?>
   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
        <div class="message" id= "messages"><span>' . $message . '</span>
        </div>
        ';
      }
   }
   ?>

   <section class="placed-orders">

      <h1 class="title">placed orders</h1>

      <div class="box-container">
         <?php
         $select_orders = mysqli_query($conn, "SELECT * FROM `confirm_order`") or die('query failed');
         if (mysqli_num_rows($select_orders) > 0) {
            while ($fetch_tree = mysqli_fetch_assoc($select_orders)) {
         ?>
               <div class="box">
                  <p> Order Date : <span><?php echo $fetch_tree['order_date']; ?></span> </p>
                  <p> Order Id : <span>#<?php echo $fetch_tree['order_id']; ?> </p>
                  <p> Name : <span><?php echo $fetch_tree['name']; ?></span> </p>
                  <p> Mobile Number : <span><?php echo $fetch_tree['number']; ?></span> </p>
                  <p> Email Id : <span><?php echo $fetch_tree['email']; ?></span> </p>
                  <p> Address : <span><?php echo $fetch_tree['address']; ?></span> </p>
                  <p> Payment Method : <span><?php echo $fetch_tree['payment_method']; ?></span> </p>
                  <p> Your orders : <span><?php echo $fetch_tree['total_trees']; ?></span> </p>
                  <p> Total price : <span>RM<?php echo $fetch_tree['total_price']; ?></span> </p>
                  <input type="hidden" name="order_id" value="<?php echo $fetch_tree['order_id']; ?>">
                  Payment Status : Completed
                  <br>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no orders placed yet!</p>';
         }
         ?>
      </div>

   </section>


   <script src="js/admin_script.js"></script>
   <script>
      setTimeout(() => {
         const box = document.getElementById('messages');
         box.style.display = 'none';
      }, 8000);
   </script>

</body>

</html>