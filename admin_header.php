<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Admin Interface</title>
</head>
<body>
    
<header><div class="mainlogo">
        <div class="logo">
            <a href="admin_index.php"><span class="em">GROW</span>
            <span class="me">GREEN</span></a>
        </div><p>Admin Panel</p></div>
        <div class="nav">
            <a href="admin_index.php"><span class="fas fa-home"></span> Home</a>
            <a href="add_trees.php"><span class="fas fa-plus"></span> Add Trees</a>
            <a href="admin_orders.php"><span class="fas fa-file-invoice"></span> Orders</a>
            <a href="users_detail.php"><span class="fas fa-users"></span> Users</a>

        </div>
        <div class="right">
            <div class="log_info">
                <p>Welcome <?php echo $_SESSION['admin_name'];?></p> 
            </div>
            <a class="Btn" href="admin_logout.php?logout=<?php echo $_SESSION['admin_name'];?>"><span class="fas fa-sign-out-alt"></span>logout</a>
        </div>
    </header>

</body>
</html>