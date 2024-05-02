<?php
include 'config.php';

error_reporting(0);
session_start();

$user_id = $_SESSION['user_id'];

if (isset($_POST['add_to_cart'])) {
    if (!isset($user_id)) {
        $message[] = 'Please Login to get your Tree';
    } else {
        $tree_name = $_POST['tree_name'];
        $tree_id = $_POST['tree_id'];
        $tree_image = $_POST['tree_image'];
        $tree_price = $_POST['tree_price'];
        $tree_quantity = '1';

        $total_price = number_format($tree_price * $tree_quantity);

        $select_tree = mysqli_query($conn, "SELECT * FROM cart WHERE tree_id= '$tree_id' AND user_id='$user_id' ") or die('query failed');

        if (mysqli_num_rows($select_tree) > 0) {
            $message[] = 'This Tree is already in your cart';
        } else {
            mysqli_query($conn, "INSERT INTO cart (`user_id`,`tree_id`,`name`, `price`, `image`,`quantity` ,`total`) VALUES('$user_id','$tree_id','$tree_name','$tree_price','$tree_image','$tree_quantity', '$total_price')") or die('Add to cart Query failed');
            $message[] = 'Tree Added To Cart Successfully';
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
    <link rel="stylesheet" href="css/hello.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
    <title>Grow Green</title>

    <style>
        img {
            border: none;
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

        .slide {
            width: 100%;
            height: 800px;
        }
    </style>
</head>

<body>
    <?php include 'index_header.php' ?>
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


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100 slide" src="imageslide/tree3.jpg" alt="First slide">
            </div>

            <div class="carousel-item">
                <img class="d-block w-100 slide" src="imageslide/tree1.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 slide" src="imageslide/tree2.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <section id="New">

        <div class="container px-5 mx-auto">
            <h2 class="m-8 font-extrabold text-4xl text-center border-t-2 " style="color: rgb(0, 167, 245);">
                New Arrived
            </h2>
        </div>
    </section>
    <section class="show-products">
        <div class="box-container">

            <?php
            $select_tree = mysqli_query($conn, "SELECT * FROM `tree_info` ORDER BY date DESC LIMIT 8") or die('query failed');
            if (mysqli_num_rows($select_tree) > 0) {
                while ($fetch_tree = mysqli_fetch_assoc($select_tree)) {
            ?>

                    <div class="box" style="width: 255px; height:355px;">
                        <a href="tree_details.php?details=<?php echo $fetch_tree['tid'];
                                                            echo '-name=', $fetch_tree['name']; ?>"> <img style="height: 200px;width: 125px;margin: auto;" src="added_trees/<?php echo $fetch_tree['image']; ?>" alt=""></a>
                        <div style="text-align:left ;">

                            <div style="font-weight: 500; font-size:18px; text-align: center; " class="name"> <?php echo $fetch_tree['name']; ?></div>
                        </div>
                        <div class="price">Price: RM <?php echo $fetch_tree['price']; ?></div>

                        <form action="" method="POST">
                            <input class="hidden_input" type="hidden" name="tree_name" value="<?php echo $fetch_tree['name'] ?>">
                            <input class="hidden_input" type="hidden" name="tree_id" value="<?php echo $fetch_tree['tid'] ?>">
                            <input class="hidden_input" type="hidden" name="tree_image" value="<?php echo $fetch_tree['image'] ?>">
                            <input class="hidden_input" type="hidden" name="tree_price" value="<?php echo $fetch_tree['price'] ?>">
                            <button onclick="myFunction()" name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                                <a href="tree_details.php?details=<?php echo $fetch_tree['tid'];
                                                                    echo '-name=', $fetch_tree['name']; ?>" class="update_btn">Know More</a>
                        </form>

                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>
    <section id="Tree">
        </div>

        <div class="container px-5 mx-auto">
            <h2 class="text-gray-400 m-8 font-extrabold text-4xl text-center border-t-2 text-red-800" style="color: rgb(0, 167, 245);">
                Tree
            </h2>
        </div>
    </section>
    <section class="show-products">
        <div class="box-container">
            <?php
            $select_tree = mysqli_query($conn, "SELECT * FROM `tree_info`") or die('query failed');
            if (mysqli_num_rows($select_tree) > 0) {
                while ($fetch_tree = mysqli_fetch_assoc($select_tree)) {
            ?>

                    <div class="box" style="width: 255px;height: 355px;">
                        <a href="tree_details.php?details=<?php echo $fetch_tree['tid'];
                                                            echo '-name=', $fetch_tree['name']; ?>"> <img style="height: 200px;width: 125px;margin: auto;" src="added_trees/<?php echo $fetch_tree['image']; ?>" alt=""></a>
                        <div style="text-align:left ;">

                            <div style="font-weight: 500; font-size:18px; text-align: center; " class="name"> <?php echo $fetch_tree['name']; ?></div>
                        </div>
                        <div class="price">Price: RM <?php echo $fetch_tree['price']; ?></div>

                        <form action="" method="POST">
                            <input class="hidden_input" type="hidden" name="tree_name" value="<?php echo $fetch_tree['name'] ?>">
                            <input class="hidden_input" type="hidden" name="tree_image" value="<?php echo $fetch_tree['image'] ?>">
                            <input class="hidden_input" type="hidden" name="tree_price" value="<?php echo $fetch_tree['price'] ?>">
                            <button name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                                <a href="tree_details.php?details=<?php echo $fetch_tree['tid'];
                                                                    echo '-name=', $fetch_tree['name']; ?>" class="update_btn">Know More</a>
                        </form>

                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>
    <hr style="color: black; width:5px;">
    <?php include 'index_footer.php'; ?>

    <script>
        setTimeout(() => {
            const box = document.getElementById('messages');


            box.style.display = 'none';
        }, 8000);
    </script>


</body>

</html>