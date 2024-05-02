<?php
include 'config.php';

session_start();

if (isset($_SESSION['user_name'])) {
   $user_id = $_SESSION['user_id'];

   if (isset($_POST['add_to_cart'])) {
      $tree_name = $_POST['tree_name'];
      $tree_id = $_POST['tree_id'];
      $tree_image = $_POST['tree_image'];
      $tree_price = $_POST['tree_price'];
      $tree_quantity = '1';

      $total_price = number_format($tree_price * $tree_quantity);
      $select_tree = mysqli_query($conn, "SELECT * FROM cart WHERE tid= '$tree_id' AND user_id='$user_id' ") or die('query failed');

      if (mysqli_num_rows($select_tree) > 0) {
         $message[] = 'This Tree is already in your cart';
      } else {
         mysqli_query($conn, "INSERT INTO cart (`user_id`,`tree_id`,`name`, `price`, `image`,`quantity` ,`total`) VALUES('$user_id','$tree_id','$tree_name','$tree_price','$tree_image','$tree_quantity', '$total_price')") or die('Add to cart Query failed');
         $message[] = 'Tree Added To Successfully';
         header('location:index.php');
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>search page</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <style>
      .search-form form {
         max-width: 1200px;
         margin: 30px auto;
         display: flex;
         gap: 15px;
      }

      .search-form form .search_btn {
         margin-top: 0;
      }

      .search-form form .box {
         width: 100%;
         padding: 12px 14px;
         border: 2px solid rgb(0, 167, 245);
         font-size: 20px;
         color: black;
         border-radius: 5px;
      }

      .search_btn {
         display: inline-block;
         padding: 10px 25px;
         cursor: pointer;
         color: white;
         font-size: 18px;
         border-radius: 5px;
         text-transform: capitalize;
         background-color: rgb(0, 167, 245);
      }

      .buybtn {
         background-color: rgb(255, 187, 0);
         padding: 5px 10px;
         margin: 6px;
         border-radius: 10px;
         color: white;
         text-transform: capitalize;
      }
   </style>
</head>

<body>

   <?php include 'index_header.php'; ?>

   <section class="search-form">

      <form action="" method="POST">
         <input type="text" class="box" name="search_box" placeholder="search products...">
         <input type="submit" name="search_btn" value="search" class="search_btn">
      </form>

   </section>

   <div class="msg">
      <?php
      if (isset($_POST['search_btn'])) {
         $search_box = $_POST['search_box'];

         echo '<h4>Search Result for "' . $search_box . '"</h4>';
      };
      ?>
   </div>
   <section class="show-products">
      <div class="box-container">

         <?php
         if (isset($_POST['search_btn'])) {
            $search_box = $_POST['search_box'];

            $search_box = filter_var($search_box, FILTER_SANITIZE_STRING);
            $select_products = mysqli_query($conn, "SELECT * FROM `tree_info` WHERE name LIKE '%{$search_box}%' OR species LIKE '%{$search_box}%'");
            if (mysqli_num_rows($select_products) > 0) {
               while ($fetch_tree = mysqli_fetch_assoc($select_products)) {
         ?>

                  <div class="box" style="width: 255px;height: 342px;">
                     <a href="tree_details.php?details=<?php echo $fetch_tree['tid'];
                                                         echo '-name=', $fetch_tree['name']; ?>"> <img style="height: 200px;width: 125px;margin: auto;" src="added_trees/<?php echo $fetch_tree['image']; ?>" alt=""></a>
                     <div style="text-align:left ;">
                        <div class="name" style="font-size: 12px;">Species: <?php echo $fetch_tree['species']; ?></div>
                        <div style="font-weight: 500; font-size:18px; " class="name">Tree Name: <?php echo $fetch_tree['name']; ?></div>
                     </div>
                     <div class="price">Price: RM <?php echo $fetch_tree['price']; ?></div>

                     <form action="" method="POST">
                        <input class="hidden_input" type="hidden" name="tree_name" value="<?php echo $fetch_tree['name'] ?>">
                        <input class="hidden_input" type="hidden" name="tree_image" value="<?php echo $fetch_tree['image'] ?>">
                        <input class="hidden_input" type="hidden" name="tree_price" value="<?php echo $fetch_tree['price'] ?>">
                        <button class="buybtn" onclick="myFunction()" name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                           <a href="tree_details.php?details=<?php echo $fetch_tree['tid'];
                                                               echo '-name=', $fetch_tree['name']; ?>" id="adventure" class="update_btn">Buy</a>
                        </button>
                     </form>
                  </div>
         <?php
               }
            } else {
               echo '<p class="empty">Could not find "' . $search_box . '"! </p>';
            }
         };
         ?>
      </div>
   </section>




   <?php include 'index_footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>