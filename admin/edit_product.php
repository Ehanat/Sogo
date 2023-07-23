<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Connect to the database
require_once("../db.php");

$category_sql = "SELECT * FROM category";
$category_result = $conn->query($category_sql);

if (isset($_GET['edit_id'])) {
    $product_id = $_GET['edit_id'];
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $product_result = $conn->query($sql);
    $product = $product_result->fetch_assoc();
}

// delete assets
if (isset($_GET['delete_image'])) {
    $image = $_GET['delete_image'];
    $sql = "UPDATE products SET $image = NULL WHERE id = $product_id";
    $conn->query($sql);
    header("Location: edit_product.php?edit_id=$product_id");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        tbody a {
            color: #7F8487;
            text-decoration: none;
        }

        .delete:hover {
            color: brown;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <!-- header  -->
    <?php include_once("header.html") ?>

    <!-- side nav -->
    <div id="layoutSidenav">
        <!-- side bar  -->
        <?php include_once("sidebar.html") ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="row justify-content-between align-items-center mb-4">
                        <div class="col-md-auto col-12 mb-2">
                            <h3 class="mt-4">Өнімді өңдеу</h3>
                        </div>
                    </div>
                    <div class="row mb-n6">
                        <div class="col-xl-8 col-12 mb-6">
                            <div class="row mb-n6">
                                <div class="col-12 mb-6">
                                    <div class="card">
                                        <div class="card-head border-bottom">
                                            <h4 class="title m-3">Негізгі ақпарат</h4>
                                        </div>
                                        <div class="card-body">
                                            <form action="edit_product_inc.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="product_id" value="<?php echo $product['id'] ?>">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="product_name">Аты</label>
                                                        <input type="text" class="form-control" value="<?php echo $product['product_name'] ?>" name="product_name" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="product_price">Бағасы</label>
                                                        <input type="number" class="form-control" value="<?php echo $product['product_price'] ?>" name="product_price" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="product_qty">Саны/Қорап</label>
                                                        <input type="number" class="form-control" value="<?php echo $product['product_qty'] ?>" name="product_qty" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="category">Каталог</label>
                                                        <select class="form-select" required name="category">
                                                            <option value="<?php echo $product['category'] ?>"><?php echo $product['category'] ?></option>
                                                            <?php
                                                            while ($category = $category_result->fetch_assoc()) {
                                                                echo "<option value='" . $category['category'] . "'>" . $category['category'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description">Сипаттама</label>
                                                        <textarea class="form-control" name="description"><?php echo $product['description'] ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Img 1: </td>
                                                                <td><img src="../assets/uploads/<?php echo $product['image1'] ?>" alt="image1" height="80px"></td>
                                                                <td>
                                                                <td>
                                                                    <a class='edit' href='#' style='padding-left:20px'><i class='fa fa-pencil' aria-hidden='true'></i></a>
                                                                    <a class='delete ' href='#' style='padding-left:20px'><i class='fa fa-trash' aria-hidden='true'></i> </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Img 2: </td>
                                                                <td><img src="../assets/uploads/<?php echo $product['image2'] ?>" alt="image2" height="80px"></td>
                                                                <td>
                                                                <td>
                                                                    <a class='edit' href='#' style='padding-left:20px'><i class='fa fa-pencil' aria-hidden='true'></i></a>
                                                                    <a class='delete ' href='#' style='padding-left:20px'><i class='fa fa-trash' aria-hidden='true'></i> </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Img 3: </td>
                                                                <td><img src="../assets/uploads/<?php echo $product['image3'] ?>" alt="image3" height="80px"></td>
                                                                <td>
                                                                <td>
                                                                    <a class='edit' href='#' style='padding-left:20px'><i class='fa fa-pencil' aria-hidden='true'></i></a>
                                                                    <a class='delete ' href='#' style='padding-left:20px'><i class='fa fa-trash' aria-hidden='true'></i> </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Img 4: </td>
                                                                <td><img src="../assets/uploads/<?php echo $product['image4'] ?>" alt="image3" height="80px"></td>
                                                                <td>
                                                                <td>
                                                                    <a class='edit' href='#' style='padding-left:20px'><i class='fa fa-pencil' aria-hidden='true'></i></a>
                                                                    <a class='delete ' href='#' style='padding-left:20px'><i class='fa fa-trash' aria-hidden='true'></i> </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Video: </td>
                                                                <td><video src="../assets/uploads/<?php echo $product['video'] ?>" alt="Video" height="200px"></video></td>
                                                                <td>
                                                                <td>
                                                                    <a class='edit' href='#' style='padding-left:20px'><i class='fa fa-pencil' aria-hidden='true'></i></a>
                                                                    <a class='delete ' href='#' style='padding-left:20px'><i class='fa fa-trash' aria-hidden='true'></i> </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button type="submit" name="edit_product" class="btn btn-primary">Өзгерту</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?PHP require_once("../footer.html") ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>


</body>

</html>