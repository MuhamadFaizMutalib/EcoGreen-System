<?php
include 'config.php';


session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}


if (isset($_GET['delete_user'])) {
    $delete_id = $_GET['delete_user'];
    mysqli_query($conn, "DELETE FROM `admin_info` WHERE Id = '$delete_id'") or die('query failed');
    header('location:users_detail.php');
}


if (isset($_POST['update_user'])) {

    $update_id = $_POST['update_id'];
    $update_name = $_POST['update_name'];
    $update_sname = $_POST['update_sname'];
    $update_email = $_POST['update_email'];
    $update_password = $_POST['update_password'];
    $update_user_type = $_POST['update_user_type'];

    mysqli_query($conn, "UPDATE `admin_info` SET firstname = '$update_name', lastname='$update_name', email ='$update_email', password = '$update_password' WHERE Id = '$update_id'") or die('query failed');

    header('location:admin_detail.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/registerstyle.css">
    <link rel="stylesheet" href="./css/index_tree.css">
    <title> Admin Data</title>
</head>

<body>
    <?php
    include 'admin_header.php';
    ?>
  
        <section class="show-products">
    <div class="box-container">

   <?php
      $select_user = mysqli_query($conn, "SELECT Id,firstname,lastname,email,password FROM admin_info") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         while($fetch_user = mysqli_fetch_assoc($select_user)){
   ?>
   <div class="box">
       <div class="name">User ID: <?php echo $fetch_user['Id']; ?></div>
      <div class="name">Name: <?php echo $fetch_user['firstname']; ?>&nbsp;<?php echo $fetch_user['lastname']; ?></div>
      
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>
    </div>
    </section>

    <section class="edit_user-form">
        <div class="edit-product-form">
            <?php
            if (isset($_GET['update_user'])) {
                $update_id = $_GET['update_user'];
                $update_query = mysqli_query($conn, "SELECT * FROM `admin_info` WHERE Id = '$update_id'") or die('query failed');
                if (mysqli_num_rows($update_query) > 0) {
                    while ($fetch_update = mysqli_fetch_assoc($update_query)) {
            ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="update_id" value="<?php echo $fetch_update['Id']; ?>">
                            <input type="text" value="<?php echo $fetch_update['firstname'] ?>" name="update_name" placeholder="Enter Name" required class="box ">
                            <input type="text" value="<?php echo $fetch_update['lastname'] ?>" name="update_sname" placeholder="Enter Surname" required class="box">
                            <input type="email" value="<?php echo $fetch_update['email'] ?>" name="update_email" placeholder="Enter Email Id" required class="box">
                            <input type="password" value="<?php echo $fetch_update['password'] ?>" name="update_password" placeholder="Enter password" required class="box">
                            <input type="submit" value="Update" name="update_user" class="delete_btn">
                            <input   type="reset" value="cancel" id="close-update_user" class="update_btn">
                        </form>
            <?php
                    }
                }
            } else {
                echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
            }
            ?>

        </div>
    </section>

    <script>
        document.querySelector('#close-update_user').onclick = () => {
            document.querySelector('.edit-product-form').style.display = 'none';
            window.location.href = 'users_detail.php';
        }
    </script>

</body>

</html>