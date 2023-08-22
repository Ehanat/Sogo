<?php
// Connect to the database
require_once("../db.php");

// delete product
if (isset($_GET['delete_id'])) {
    $product_id = $_GET['delete_id'];


    $stmt = $conn->query("SELECT * FROM products WHERE id = $product_id");
    $product = $stmt->fetch_assoc();


    unlink("../assets/uploads/" . $product['image1']);
    unlink("../assets/uploads/" . $product['image2']);
    unlink("../assets/uploads/" . $product['image3']);
    unlink("../assets/uploads/" . $product['image4']);
    unlink("../assets/uploads/" . $product['video']);

    // Close the statement
    $stmt->close();

    $delete_sql = "DELETE FROM products WHERE id='$product_id';";
    $delete = mysqli_query($conn, $delete_sql);
    header("Location:product_list.php");
    exit();
}
