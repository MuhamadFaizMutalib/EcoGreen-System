<?php include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}


$users_no = mysqli_query($conn, "SELECT * FROM users_info") or die('query failed');
$usercount = mysqli_num_rows($users_no);
$admin_no = mysqli_query($conn, "SELECT * FROM admin_info") or die('query failed');
$admin_count = mysqli_num_rows($admin_no);
$trees_no = mysqli_query($conn, "SELECT * FROM tree_info") or die('query failed');
$treescount = mysqli_num_rows($trees_no);
$orders = mysqli_query($conn, "SELECT * FROM confirm_order") or die('query failed');
$orders_count = mysqli_num_rows($orders);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/admin.css" />
    <title>Grow Green Admin</title>
  </head>

  <body >
    <?php include'admin_header.php';?>
    <br/>
    
    <div class="main_box">
      <div class="card" style="width: 15rem">
        <img class="card-img-top" src="./images/order.png" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title">Number Of Orders Received</h5>
          <p class="card-text">
          <?php echo $orders_count; ?>
          </p>
          <a href="admin_orders.php" class="btn btn-primary">Details</a>
        </div>
      </div>
      <div class="card" style="width: 15rem">
        <img class="card-img-top" src="./images/treee.png" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title">Number Of Tree Available</h5>
          <p class="card-text">
          <?php echo $treescount; ?>
          </p>
          <div class="buttons" style="display: flex;">
          <a href="total_trees.php" class="btn btn-primary">See Trees</a>
          <a href="add_trees.php" class="btn btn-primary">Add Tree</a>
          </div>
        </div>
      </div>
      <div class="card" style="width: 15rem">
        <img class="card-img-top" src="./images/user.png" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title">Number Of Registered Admins</h5>
          <p class="card-text">
            <?php echo $admin_count; ?>
          </p>
          <a href="admin_details.php" class="btn btn-primary">Details</a>
        </div>
      </div>
      <div class="card" style="width: 15rem">
        <img class="card-img-top" src="./images/user.png" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title">Number Of Registered Users</h5>
          <p class="card-text">
            <?php echo $usercount; ?>
          </p>
          <a href="users_detail.php" class="btn btn-primary">Details</a>
        </div>
      </div>
    </div>
  </body>
</html>
