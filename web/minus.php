<?php

if (isset($_GET['SKU'])) {
    $SKU = $_GET['SKU'];
    $connection = new mysqli("us-cdbr-east-05.cleardb.net","bd7487fa6428f9","97323a24","heroku_980dce8454d6e8d");

    $sql = "SELECT * FROM PRODUCTS WHERE SKU=$SKU";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    $make = $row['make'];
    $model = $row['model'];
    $location = $row['product_condition'];
    $quantity = $row['quantity'];

    $newQuantity = $quantity-1;
    $sql1 = "UPDATE PRODUCTS SET make = '$make', model = '$model', product_condition = '$location', quantity = '$newQuantity' where SKU = '$SKU'";
    $connection->query($sql1);
}

header("location: products.php");
exit;

?>