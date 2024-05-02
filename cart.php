<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

$message = [];

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $remove_query = "DELETE FROM `cart` WHERE id='$remove_id'";
if (mysqli_query($conn, $remove_query)) {
    $message[] = 'Removed Successfully';
} else {
    $message[] = 'Failed to remove item from cart';
}
    header('location:cart.php');
    exit;
}

if (isset($_POST['update'])) {
    $update_cart_id = $_POST['cart_id'];
    $tree_price = $_POST['tree_price'];
    $update_quantity = $_POST['update_quantity'];
    $total_price = $tree_price * $update_quantity;

    $update_query = "UPDATE `cart` SET `quantity`='$update_quantity', `total`='$total_price' WHERE `id`='$update_cart_id'";
    if (mysqli_query($conn, $update_query)) {
        $message[] = $user_name . ', your cart has been updated successfully';
    } else {
        $message[] = 'Failed to update cart';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="css/hello.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cart</title>
        <style>
            .cart-btn1,.cart-btn2{
                display: inline-block;
                margin: auto;
                padding:0.8rem 1.2rem;
                cursor: pointer;
                color:white;
                font-size: 15px;
                border-radius: .5rem;
                text-transform: capitalize;
            }
            .cart-btn1{
                margin-left: 40%;
                background-color: #ffa41c;
                color: black;
            }
            .cart-btn2{
                background-color: rgb(0, 167, 245);
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
        <?php
        include 'index_header.php';
        ?>
        <div class="cart_form">
        <?php
            if (!empty($message)) {
                foreach ($message as $msg) {
                    echo '<div class="message" id="messages"><span>' . $msg . '</span></div>';
                }
            }
        ?>  
        <table style="width: 70%; align-items:center; margin:10px auto;" >
            <thead>
                <th>Product</th>
                <th>Name</th>
                <th>price</th>
                <th>Quantity</th>
                <th>Total (RM)</th>
            </thead>
            <tbody>
                <?php
                    $total = 0;
                    $select_tree = mysqli_query($conn, "SELECT id, name, price, image, quantity, total FROM cart WHERE user_id = $user_id");
                    if (mysqli_num_rows($select_tree) > 0) {
                    while ($row = mysqli_fetch_assoc($select_tree)) {
                ?>
                <tr>
                <td><img style="height: 90px;" src="./added_trees/<?php echo $row['image']; ?>" alt=""></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td>
                <form action="" method="POST">
                    <input type="number" name="update_quantity" min="1" max="10" value="<?php echo $row['quantity']; ?>">
                    <input type="hidden" name="cart_id" value="<?php echo $row['id']; ?>">
                    <input class="hidden_input" type="hidden" name="tree_price" value="<?php echo $row['price'] ?>">
                    <button style="background:transparent ;" name="update"><img style="height: 26px; width: 26px; cursor:pointer;" src="./images/update1.png" alt="update"></button> | 
                    <a style="color: red;" href="cart.php?remove=<?php echo $row['id'];?>"> Remove</a>
                </form>


                </td>
                <td><?php $sub_total=$row['price']*$row['quantity']; echo $subtotal=number_format($row['price']*$row['quantity']); ?></td>
                </tr>

                <?php
                    $total += $sub_total;
                    }
                    } else {
                        echo '<p class="empty">There is nothing in cart yet !!!!!!!!</p>';
                    }
                ?>
                <tr>
                <th style="text-align:center;" colspan="3">Total</th>
                <th colspan="2">RM <?php echo $total; ?></th>
                </tr>
            </tbody>
        </table>
        <a href="checkout.php" class="btn cart-btn1" style="display:<?php if($total>1){ echo 'inline-block'; }else{ echo 'none'; };?>" > &nbsp; Proceed to Checkout</a> <a class="cart-btn2" href="index.php">Continue Shoping</a>
        </div>
        <?php include'index_footer.php'; ?>

        <script>
            setTimeout(() => {
                const box = document.getElementById('messages');
                box.style.display = 'none';
            }, 5000);
        </script>
    </body>
</html>