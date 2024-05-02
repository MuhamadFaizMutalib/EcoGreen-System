<head>
    <style>
        * {
            text-decoration: none;
            list-style: none;
            color: black;
        }

        footer {
            background-color: rgb(55, 128, 120);
        }

        h2 {
            font-size: 20px;
            font-weight: 700
        }

        .flex {
            display: flex;
        }

        ul li:not(:first-child) {
            padding: 5px;
        }

        .short_links ul {
            margin: 0 110px;
        }

        .sub_main .dropdown .dropbtn {
            border: none;
            cursor: pointer;
        }

        .sub_main .dropdown {
            position: relative;
            display: inline-block;
        }

        .sub_main .dropdown .dropdown-content {
            display: none;
            position: absolute;
            background-color: #CCCCCC;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .sub_main .dropdown .dropbtn .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .sub_main .dropdown .dropbtn .dropdown-content a:hover {
            background-color: #f1f1f1
        }

        .sub_main .dropdown:hover .dropdown-content {
            display: flex;
            flex-direction: column;
        }
    </style>
    <link rel="stylesheet" href="./css/hello.css">
</head>

<footer style="margin: 30px auto 0; bottom: 0; width: 100%;">
    <div class="main" style="align-items:center; padding:40px; ">
        <div style=" align-items:center; justify-content:center; margin:20px 0 0 ;" class="cmsg flex">
            <p>Designed By Omurice | Copyright &copy; <script>
                    document.write(new Date().getFullYear())
                </script> All Rights are reserved by &nbsp</p>
            <div style="font-size: 30px;" class="logo">
                <a href="index.php"><span style="font-size: 15px;">GROW</span>
                    <span class="me" style="font-size: 15px;">GREEN</span></a>
            </div>
        </div>
    </div>
</footer>