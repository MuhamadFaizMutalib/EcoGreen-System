<?php
include 'config.php';
error_reporting(0);
session_start();

$user_id = $_SESSION['user_id'];

if (isset($_POST['add_to_cart'])) {
    if (!isset($user_id)) {
        $message[] = 'Please Login to get your Trees';
    } else {
        $tree_name = $_POST['tree_name'];
        $tree_id = $_POST['tree_id'];
        $tree_image = $_POST['tree_image'];
        $tree_price = $_POST['tree_price'];
        $tree_quantity = $_POST['quantity'];
        $total_price = number_format($tree_price * $tree_quantity);
        $select_tree = mysqli_query($conn, "SELECT * FROM cart WHERE name= '$tree_name' AND user_id='$user_id' ") or die('query failed');

        if (mysqli_num_rows($select_tree) > 0) {
            $message[] = 'This Tree is already in your cart';
        } else {
            mysqli_query($conn, "INSERT INTO cart (`tree_id`,`user_id`,`name`, `price`, `image`, `quantity` ,`total`) VALUES('$tree_id','$user_id','$tree_name','$tree_price','$tree_image','$tree_quantity', '$total_price')") or die('Add to cart Query failed');
            $message[] = 'Tree Added To Cart Successfully';
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
    <link rel="stylesheet" href="./css/index_tree.css">
    <title>Selected Products</title>

    <style>
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
    <?php
    include 'index_header.php';
    ?>
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
    <div class="details">
        <?php
        if (isset($_GET['details'])) {
            $get_id = $_GET['details'];
            $get_tree = mysqli_query($conn, "SELECT * FROM `tree_info` WHERE tid = '$get_id'") or die('query failed');
            if (mysqli_num_rows($get_tree) > 0) {
                while ($fetch_tree = mysqli_fetch_assoc($get_tree)) {
        ?>
                    <div class="row_box">
                        <form style="display: flex ;" action="" method="POST">
                            <div class="col_box">
                                <img src="./added_trees/<?php echo $fetch_tree['image']; ?>" alt="<?php echo $fetch_tree['name']; ?>">
                            </div>
                            <div class="col_box">
                                <h4>Species: <?php echo $fetch_tree['species']; ?></h4>
                                <h1>Tree Name: <?php echo $fetch_tree['name']; ?></h1>
                                <h3>Price: RM <?php echo $fetch_tree['price']; ?></h3>
                                <label for="quantity">Quantity:</label>
                                <input type="number" name="quantity" value="1" min="1" max="10" id="quantity">
                                <div class="buttons">


                                    <input class="hidden_input" type="hidden" name="tree_name" value="<?php echo $fetch_tree['name'] ?>">
                                    <input class="hidden_input" type="hidden" name="tree_id" value="<?php echo $fetch_tree['tid'] ?>">
                                    <input class="hidden_input" type="hidden" name="tree_image" value="<?php echo $fetch_tree['image'] ?>">
                                    <input class="hidden_input" type="hidden" name="tree_price" value="<?php echo $fetch_tree['price'] ?>">
                                    <input type="submit" name="add_to_cart" value="Add To Cart" class="btn">
                                </div>
                                <h3>Tree Details</h3>
                                <p><?php echo $fetch_tree['description']; ?></p>
                            </div>
                        </form>
                    </div>
        <?php
                }
            }
        } else {
            echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
        }
        ?>
    </div>
    <script src="./js/admin.js"></script>
    <script>
        setTimeout(() => {
            const box = document.getElementById('messages');
            box.style.display = 'none';
        }, 5000);
    </script>
</body>

</html>