<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
if (isset($_POST['add_card'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_size = $_POST['product_size'];
    $product_color = $_POST['product_color'];
    $qty = $_POST['product_qty'];

    $product_info = array("id" => $product_id, "name" => $product_name, "price" => $product_price, "size" => $product_size, "color" => $product_color, "qty" => $qty);
    array_push($_SESSION['cart'], $product_info);
    header('Location: detail.php?id=' . $product_id);
    exit();
};
