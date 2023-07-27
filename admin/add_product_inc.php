<?php
require_once("../db.php");

function uploadImages($name, $conn, $product_name)
{
    $fileName = $_FILES["$name"]['name'];
    $fileTmpName = $_FILES["$name"]['tmp_name'];
    $fileSize = $_FILES["$name"]['size'];
    $fileError = $_FILES["$name"]['error'];
    $fileType = $_FILES["$name"]['type'];

    $fileExt = explode('.', $fileName);

    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'mp4', 'mov');

    try {
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = '../assets/uploads/' . $fileNameNew;
                try {
                    $sql = "UPDATE products SET $name = '$fileNameNew' WHERE product_name = '$product_name'";
                    mysqli_query($conn, $sql);
                    move_uploaded_file($fileTmpName, $fileDestination);
                } catch (mysqli_sql_exception $e) {
                    echo "error on upload assets";
                }
            }
        }
    } catch (Exception $e) {
        echo "Error here";
    }
}


if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_qty = $_POST['product_qty'];
    $descriptions = $_POST['description'];
    $sizes = $_POST['scales'];
    $size_list = '';
    foreach ($sizes as $size) {
        $size_list = $size_list . "," . $size;
    }
    $colors = $_POST['Colors'];
    $color_list = '';
    foreach ($colors as $color) {
        $color_list = $color_list . "," . $color;
    }

    $category = $_POST['category'];

    $fileNames = ['image1', 'image2', 'image3', 'image4', 'video'];
    try {
        $sql = "INSERT INTO products (product_name, product_price, product_qty, description,category, size, color) VALUES ('$product_name', '$product_price', '$product_qty','$descriptions','$category', '$size_list', '$color_list')";
        mysqli_query($conn, $sql);
    } catch (mysqli_sql_exception) {
        echo 'server error';
    }
    foreach ($fileNames as $fileName) {
        uploadImages($fileName, $conn, $product_name);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Loading Page</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .loading-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        .loading-message {
            font-size: 24px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="loading-container">
        <h1 class="loading-message" id="loadingMessage" class="color:black">өнім жүктелуде...</h1>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Show loading message after 3 seconds
            setTimeout(function() {
                var loadingMessage = document.getElementById("loadingMessage");
                loadingMessage.style.display = "block";
                loadingMessage.style.color = "green";
                loadingMessage.textContent = "Жүктеу сәтті аяқтаңыз";

                // Redirect to another page after 1 second
                setTimeout(function() {
                    window.location.href = "add_products.php"; // Replace with your desired page URL
                }, 1000);
            }, 1000);
        });
    </script>
</body>

</html>