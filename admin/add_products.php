<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
require_once("../db.php");

$category_sql = "SELECT * FROM category";
$category_result = $conn->query($category_sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Өнімді қосыңыз</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
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
                            <h3 class="mt-4">Add Product</h3>
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
                                            <form action="add_product_inc.php" method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <input type="text" class="form-control" placeholder="Өнім атауы" name="product_name" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <input type="number" class="form-control" placeholder="Өнім бағасы" name="product_price" required>
                                                    </div>
                                                </div>
                                                <div class="row  mb-3">
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control" placeholder="Қораптағы саны" name="product_qty" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-select" required name="category">
                                                            <option value="">Каталогты таңдаңыз</option>
                                                            <?php
                                                            while ($category = $category_result->fetch_assoc()) {
                                                                echo "<option value='" . $category['category'] . "'>" . $category['category'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="dropdown">
                                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Размер
                                                            </button>
                                                            <ul class="scales dropdown-menu ps-4 overflow-auto">
                                                                <?php
                                                                for ($i = 35; $i <= 40; $i++) { ?>
                                                                    <div>
                                                                        <input type="checkbox" id="scales" name="scales[]" value="<?php echo $i ?>">
                                                                        <label for="scales"><?php echo $i ?></label>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>
                                                                <div>
                                                                    <input type="checkbox" id="scales" name="scales[]" value="S">
                                                                    <label for="scales">S</label>
                                                                </div>
                                                                <div>
                                                                    <input type="checkbox" id="scales" name="scales[]" value="M">
                                                                    <label for="scales">M</label>
                                                                </div>
                                                                <div>
                                                                    <input type="checkbox" id="scales" name="scales[]" value="L">
                                                                    <label for="scales">L</label>
                                                                </div>
                                                                <div>
                                                                    <input type="checkbox" id="scales" name="scales[]" value="XL">
                                                                    <label for="scales">XL</label>
                                                                </div>
                                                                <div>
                                                                    <input type="checkbox" id="scales" name="scales[]" value="2XL">
                                                                    <label for="scales">2XL</label>
                                                                </div>
                                                                <div>
                                                                    <input type="checkbox" id="scales" name="scales[]" value="3XL">
                                                                    <label for="scales">3XL</label>
                                                                </div>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="dropdown">
                                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Түсі
                                                            </button>
                                                            <ul class="dropdown-menu ps-4 overflow-auto color">
                                                                <div>
                                                                    <input type="checkbox" id="Colors" name="Colors[]" value="black">
                                                                    <label for="Colors" style="background: black"></label>
                                                                </div>
                                                                <div>
                                                                    <input type="checkbox" id="Colors" name="Colors[]" value="white">
                                                                    <label for="Colors" style="background: white"></label>
                                                                </div>
                                                                <div>
                                                                    <input type="checkbox" id="Colors" name="Colors[]" value="blue">
                                                                    <label for="Colors" style="background: blue"></label>
                                                                </div>
                                                                <div>
                                                                    <input type="checkbox" id="Colors" name="Colors[]" value="yellow">
                                                                    <label for="Colors" style="background: yellow"></label>
                                                                </div>
                                                                <div>
                                                                    <input type="checkbox" id="Colors" name="Colors[]" value="red">
                                                                    <label for="Colors" style="background: red"></label>
                                                                </div>
                                                                <div>
                                                                    <input type="checkbox" id="Colors" name="Colors[]" value="skyblue">
                                                                    <label for="Colors" style="background: skyblue"></label>
                                                                </div>
                                                                <div>
                                                                    <input type="checkbox" id="Colors" name="Colors[]" value="green">
                                                                    <label for="Colors" style="background: green"></label>
                                                                </div>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <textarea class="form-control" placeholder="Өнім Сипаттамасы" name="description"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image1">Сурет 1</label>
                                                    <input type="file" class="form-control" id="image1" name="image1">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image2">Сурет 2</label>
                                                    <input type="file" class="form-control" id="image2" name="image2">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image3">Сурет 3</label>
                                                    <input type="file" class="form-control" id="image3" name="image3">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image4">Сурет 4</label>
                                                    <input type="file" class="form-control" id="image4" name="image4">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="video">видео</label>
                                                    <input type="file" class="form-control" id="video" name="video">
                                                </div>
                                                <button type="submit" name="add_product" class="btn btn-primary">Өнімді қосу</button>
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