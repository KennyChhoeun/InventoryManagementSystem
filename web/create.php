<?php

session_start();
//check if user loggedin
if(!isset($_SESSION['loggedin'])) {
  header('Location: index.html');
  exit;
}
?>

<?php
$SKU = "";
$make = "";
$model = "";
$location = "";
$quantity = "";

$errorMessage = "";
$successMessage = "";


$conn = new mysqli("us-cdbr-east-05.cleardb.net","CREDENTIALS","CREDENTIALS","CREDENTIALS");

if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
    $SKU = $_POST['SKU'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $location = $_POST['location'];
    $quantity = $_POST['quantity'];

    try {
        do {
            if (empty($SKU) || empty($make) || empty($model) || empty($location) || empty($quantity)) {
                $errorMessage = "All fields are required!";
                break;
            } 
    
            // add new product to DB_SERVER
            $sql = "INSERT INTO PRODUCTS (SKU, make, model, product_condition, quantity) 
                    VALUES ('$SKU', '$make', '$model', '$location', '$quantity')";
            $result = $conn->query($sql);
    
    
            if(!$result) {
                $errorMessage = "Something went wrong: " . $conn->error;
                break;
            }
    
    
            $SKU = "";
            $make = "";
            $model = "";
            $location = "";
            $quantity = "";
    
            $successMessage = "Product Added Successfully!";
    
            header("location: products.php");
            exit;
        } while (false);
    } catch (mysqli_sql_exception $e) {
        $errorMessage = "Duplicate SKU, please try a different SKU";
    }
    
}

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Create a product</title>
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

    <div class="container my-5">
        <h2>New Product</h2>
        <br>

        <?php
        if(!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
            </div>
            ";
        }
        ?>

        <form method="POST">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">SKU</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="SKU" value="<?php echo $SKU; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Make</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="make" value="<?php echo $make; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Model</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="model" value="<?php echo $model; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Location</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="location" value="<?php echo $location; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Quantity</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="quantity" value="<?php echo $quantity; ?>">
                </div>
            </div>
            <?php
            if (!empty($successMessage)) {
                echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
            </div>
            ";
            }
            ?>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="products.php" role="button" class="btn btn-outline-primary">Cancel</a>
        </form>
    </div>



</body>

</html>