<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if (isset($_POST['add_trees'])) {
  $species = mysqli_real_escape_string($conn, $_POST['species']);
  $treename = mysqli_real_escape_string($conn, $_POST['treename']);

  $price = $_POST['price'];
  $desc = mysqli_real_escape_string($conn, ($_POST['tdesc']));
  $img = $_FILES["image"]["name"];
  $img_temp_name = $_FILES["image"]["tmp_name"];
  $img_file = "./added_trees/" . $img;


  if (empty($species)) {
    $message[] = 'Please Enter Tree name';
  } elseif (empty($treename)) {
    $message[] = 'Please Enter Species';
  } elseif (empty($price)) {
    $message[] = 'Please Enter Tree price';
  }elseif (empty($desc)) {
    $message[] = 'Please Enter Tree descriptions';
  } elseif (empty($img)) {
    $message[] = 'Please Choose Image';
  } else {

    $add_tree = mysqli_query($conn, "INSERT INTO tree_info(`name`, `species`, `price`, `description`, `image`) VALUES('$species','$treename','$price','$desc','$img')") or die('Query failed');

    if ($add_tree) {
      move_uploaded_file($img_temp_name, $img_file);
      $message[] = 'New Tree Added Successfully';
    
      // Redirect the user after successful form submission
      header('Location: add_trees.php');
      exit; // Important: Stop executing the current script after the redirect
    } else {
      $message = 'Tree Not Added Successfully';
    }    
  }
  header('Location: add_trees.php');
  exit;
}


if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM `tree_info` WHERE tid = '$delete_id'") or die('query failed');
  header('location:add_trees.php');
}


if(isset($_POST['update_product'])){

  $update_p_id = $_POST['update_p_id'];
  $update_name = $_POST['update_name'];
  $update_species = $_POST['update_species'];
  $update_description = $_POST['update_description'];
  $update_price = $_POST['update_price'];

  mysqli_query($conn, "UPDATE `tree_info` SET name = '$update_name', species='$update_species', description ='$update_description', price = '$update_price' WHERE tid = '$update_p_id'") or die('query failed');

  $update_image = $_FILES['update_image']['name'];
  $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
  $update_image_size = $_FILES['update_image']['size'];
  $update_folder = './added_trees/'.$update_image;
  $update_old_image = $_POST['update_old_image'];

  if(!empty($update_image)){
     if($update_image_size > 2000000){
        $message[] = 'image file size is too large';
     }else{
        mysqli_query($conn, "UPDATE `tree_info` SET image = '$update_image' WHERE tid = '$update_p_id'") or die('query failed');
        move_uploaded_file($update_image_tmp_name, $update_folder);
        unlink('uploaded_img/'.$update_old_image);
     }
  }

  header('location:./add_trees.php');

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <link rel="stylesheet" href="./css/registerstyle.css">
  <title>Add Tree</title>
</head>

<body>
  <?php
  include './admin_header.php'
  ?>
  <?php
  if (isset($message)) {
    foreach ($message as $message) {
      echo '
        <div class="message" id="messages"><span>' . $message . '</span>
        </div>
        ';
    }
  }
  ?>
  
<a class="update_btn" style="position: fixed ; z-index:100;" href="total_trees.php">See All Trees</a>
  <div class="container_box">
    <form action="" method="POST" enctype="multipart/form-data">
      <h3>Grow <a href="index.php"><span>Green</span></a></h3>
      <input type="text" name="species" placeholder="Enter Tree Name" class="text_field ">
      <input type="text" name="treename" placeholder="Enter Tree species" class="text_field">
      <input type="number" min="0" name="price" class="text_field" placeholder="enter product price">
      
      <textarea name="tdesc" placeholder="Enter Tree description" id="" class="text_field" cols="18" rows="5"></textarea>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="text_field">
      <input type="submit" value="Add Tree" name="add_trees" class="btn text_field">
    </form>
  </div>

  <section class="edit-product-form">

<?php
   if(isset($_GET['update'])){
      $update_id = $_GET['update'];
      $update_query = mysqli_query($conn, "SELECT * FROM `tree_info` WHERE tid = '$update_id'") or die('query failed');
      if(mysqli_num_rows($update_query) > 0){
         while($fetch_update = mysqli_fetch_assoc($update_query)){
?>
<form action="" method="post" enctype="multipart/form-data">
   <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['tid']; ?>">
   <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
   <img src="./added_trees/<?php echo $fetch_update['image']; ?>" alt="">
   <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="Enter Tree Name">
   <input type="text" name="update_species" value="<?php echo $fetch_update['species']; ?>" class="box" required placeholder="Enter species">
   
   <input type="text" name="update_description" value="<?php echo $fetch_update['description']; ?>" class="box" required placeholder="enter product description">
   <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="enter product price">
   <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
   <input type="submit" value="update" name="update_product" class="delete_btn" >
   <input type="reset" value="cancel" id="close-update" class="update_btn" >
</form>
<?php
      }
   }
   }else{
      echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
   }
?>

</section>
  <section class="show-products">

   <div class="box-container">

      <?php
         $select_tree = mysqli_query($conn, "SELECT * FROM tree_info ORDER BY date DESC LIMIT 2;") or die('query failed');
         if(mysqli_num_rows($select_tree) > 0){
            while($fetch_tree = mysqli_fetch_assoc($select_tree)){
      ?>
      <div class="box">
         <img class="trees_images" src="added_trees/<?php echo $fetch_tree['image']; ?>" alt="">
         <div class="name">Species: <?php echo $fetch_tree['species']; ?></div>
         <div class="name">Tree Name: <?php echo $fetch_tree['name']; ?></div>
         <div class="price">Price: RM <?php echo $fetch_tree['price']; ?></div>
         <a href="add_trees.php?update=<?php echo $fetch_tree['tid']; ?>" class="update_btn">update</a>
         <a href="add_trees.php?delete=<?php echo $fetch_tree['tid']; ?>" class="delete_btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

</section>



<script src="./js/admin.js"></script>
<script>
setTimeout(() => {
  const box = document.getElementById('messages');

  box.style.display = 'none';
}, 8000);
</script>
</body>

</html>