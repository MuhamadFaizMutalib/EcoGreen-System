<?php
include 'config.php';
session_start();

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    $select_users = mysqli_query($conn, "SELECT * FROM admin_info WHERE email = '$email' and password='$password' ") or die('query failed');


    if (mysqli_num_rows($select_users) == 1) {
        $row = mysqli_fetch_assoc($select_users);
        if ($row['email'] == $email && $row['password'] == $password) {
            $_SESSION['admin_name'] = $row['firstname'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_index.php');
        }
    }

    $message[] = 'Incorrect Email Id or Password!';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/registerStyle.css" />
    <title>Login Here</title>
    <style>
        .container form .link {
            text-decoration: none;
            color: white;
            border-radius: 17px;
            padding: 8px 18px;
            margin: 0px 10px;
            background: rgb(0, 0, 0);
            font-size: 20px;
        }

        .container form .link:hover {
            background: rgb(0, 167, 245);
        }
    </style>
</head>

<body>
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

    <div class="container">
        <form action="" method="post">
            <h3 style="color:white">Welcome to <a href="index.php"><span style="color:indigo">Grow</span><span style="color:lightgreen">Green</span></a></h3>
            <input type="email" name="email" placeholder="Enter Email Id" required class="text_field">
            <input type="password" name="password" placeholder="Enter password" required class="text_field">
            <input type="submit" value="Login" name="login" class="btn text_field">
            <p>Don't have an Account? <br> <a class="link" href="admin_register.php">Sign Up</a><a class="link" href="admin_index.php">Back</a></p>
        </form>
    </div>


    <script>
        setTimeout(() => {
            const box = document.getElementById('messages');
            box.style.display = 'none';
        }, 8000);
    </script>
</body>

</html>