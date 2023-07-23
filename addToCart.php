<?php
session_start();
if (isset($_POST['add_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_id = $_POST['product_id'];
    $qty = $_POST['qty'];

    array_push($_SESSION["product_id"], $product_id);
    array_push($_SESSION["qty"], $qty);

    header("Location: index.php");
    exit();
}
