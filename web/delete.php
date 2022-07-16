<?php

if (isset($_GET['SKU'])) {
    $SKU = $_GET['SKU'];

    $connection = new mysqli("us-cdbr-east-05.cleardb.net","CREDENTIALS","CREDENTIALS","CREDENTIALS");
    $sql = "DELETE FROM PRODUCTS WHERE SKU=$SKU";
    $connection->query($sql);
}

header("location: products.php");
exit;

?>