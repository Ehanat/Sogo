<?php

require_once("../db.php");

if (isset($_POST['edit_product'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_qty = $_POST['product_qty'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    $sql = "UPDATE products SET product_name = ?, product_price = ?, product_qty = ?, description = ?, category = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssissi", $product_name, $product_price, $product_qty, $description, $category, $product_id);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit();
}
