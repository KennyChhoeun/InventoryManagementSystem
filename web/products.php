<?php

session_start();
//check if user loggedin
if(!isset($_SESSION['loggedin'])) {
  header('Location: index.html');
  exit;
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Products</title>
    <link rel="icon" href="https://img.icons8.com/office/344/box--v1.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <meta name="theme-color" content="#712cf9">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>
    <style>
    <meta name="theme-color"content="#712cf9"><style>.bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }
    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img class="navbar-brand" src="https://img.icons8.com/office/344/box--v1.png" alt="" height="40" width="40"
            padding-top="20px">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="products.php">Products <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="inOut.php">In/Out</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <br><br><br>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Products</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">

                                <form action="" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search"
                                            value="<?php if(isset($_GET['search'])) {echo $_GET['search']; } ?>"
                                            class="form-control" placeholder="Search products">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <a class="btn btn-primary" href="create.php" role="button">Add Product</a>
                        <div class="card mt-4">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SKU</th>
                                            <th>Make</th>
                                            <th>Model</th>
                                            <th>Location</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $con = mysqli_connect("us-cdbr-east-05.cleardb.net","bd7487fa6428f9","97323a24","heroku_980dce8454d6e8d");
                                        
                                        if(isset($_GET['search']))
                                        {
                                            $filtervalues = $_GET['search'];
                                            $query = "SELECT * FROM products WHERE CONCAT(sku,make,model,product_condition) LIKE '%$filtervalues%' ";
                                            $result = $con->query($query);
                                            
                                        } else {
                                            $query = "SELECT * FROM products";
                                            $result = $con->query($query);
                                        }

                                        while($row = $result->fetch_assoc()) {
                                            echo "
                                            <tr>
                                            <td>$row[SKU]</td>
                                            <td>$row[make]</td>
                                            <td>$row[model]</td>
                                            <td>$row[product_condition]</td>
                                            <td>$row[quantity]</td>
                                            <td>
                                                <a class='btn btn-primary btn-sm' href='/edit.php?SKU=$row[SKU]'>Edit</a>
                                                <a class='btn btn-danger btn-sm' href='/delete.php?SKU=$row[SKU]'>Delete</a>
                                                <a class='btn btn-success btn-sm' href='/plus.php?SKU=$row[SKU]'>+</a>
                                                <a class='btn btn-warning btn-sm' href='/minus.php?SKU=$row[SKU]'>-</a>
                                            </td>
                                        </tr>";
                                        }
                                        ?>


                                    </tbody>


                            </div>
                        </div>
                    </div>
                </div>




</body>