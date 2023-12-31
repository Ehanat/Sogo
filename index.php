<?php
session_start();
if (!isset($_SESSION['product_id'])) {
    $_SESSION['product_id'] = array();
}
if (!isset($_SESSION['qty'])) {
    $_SESSION['qty'] = array();
}


include_once("db.php");
$banner_result = $conn->query("SELECT * FROM banner");

if (isset($_GET['category'])) {
    // base on category 
    $stmt = $conn->prepare("SELECT * FROM products WHERE category = ?");
    $stmt->bind_param("s", $category);

    $category = $_GET['category'];
    $stmt->execute();

    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c4832607e6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>SOGO</title>
    <style>
        /* If the screen size is 601px wide or more, set the font-size of <div> to 80px */
        @media screen and (min-width: 601px) {
            .add-cart {
                font-size: 16px;
            }
        }

        /* If the screen size is 600px wide or less, set the font-size of <div> to 30px */
        @media screen and (max-width: 600px) {
            .add-cart {
                font-size: 12px;
            }
        }

        .fa-circle-info {
            color: red;
            font-size: 12px;
            position: relative;
            top: -10px;
            left: 26px;
        }

        /* If the screen size is 601px wide or more, set the font-size of <div> to 80px */
        @media screen and (min-width: 601px) {
            .card-img-top {
                height: 200px;
            }
        }

        /* If the screen size is 600px wide or less, set the font-size of <div> to 30px */
        @media screen and (max-width: 600px) {
            .card-img-top {
                height: 150px;
            }
        }

        a {
            text-decoration: none;
        }
    </style>

</head>

<body>
    <!-- navbar  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-lg mx-auto">
            <a class="navbar-brand" href="index.php">
                <span class="navbar-brand-text text-white">SOGO</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">

                    <li class="nav-item">

                        <a class="nav-link" href="cart.php">
                            <?php
                            if (count($_SESSION['product_id']) !== 0) {
                                echo '<i class="fa-solid fa-circle-info"></i>';
                            }

                            ?>
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="container">

        <!-- banner  -->
        <div id="demo" class="my-3 carousel slide" data-bs-ride="carousel">

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <?php
                while ($banner = $banner_result->fetch_array()) { ?>
                    <div class="carousel-item active">
                        <img src="assets/banners/<?php echo $banner['image_location'] ?>" class="d-block w-100" height="300px" style="object-fit: cover;" loading="lazy">
                    </div>
                <?php
                }
                ?>

            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <!-- category  -->
        <nav class="category">
            <ul>
                <?php
                // Query database to get category
                $category_result = mysqli_query($conn, "SELECT * FROM category");

                // Loop through products and display them in cards
                while ($category = mysqli_fetch_assoc($category_result)) {
                ?>
                    <li><a class="nav-link mx-3" href="?category=<?php echo $category['category'] ?>" style="font-family: 'tahoma';"><?php echo strtoupper($category['category']) ?></a> </li>
                <?php } ?>
            </ul>
        </nav>

        <!-- product list  -->
        <div class="product_list row row-cols-2 row-cols-md-4 row-cols-lg-5 g-3 mb-3">
            <?php
            // Loop through products and display them in cards
            while ($product = $result->fetch_assoc()) {
            ?>
                <a href="detail.php?id=<?php echo $product['id'] ?>">
                    <form id="From" action="addToCart.php" method="post">
                        <div class="col">
                            <div class="card">
                                <div>
                                    <img src="assets/uploads/<?php echo $product['image1']; ?>" class="card-img-top img-fluid" alt="<?php echo $product['product_name']; ?>">
                                </div>

                                <div class="card-body px-3 py-2">
                                    <div class="product_name">
                                        <span class="card-title"><?php echo $product['product_name']; ?></span>
                                    </div>
                                    <h6 class="card-subtitle pt-2"><?php echo $product['product_price']; ?>тг</h6>
                                    <input type="hidden" value="<?= $product['id'] ?>" name="product_id">
                                    <input type="hidden" value="<?= $product['product_price'] ?>" name="product_price">
                                    <input type="hidden" value="<?= $product['product_name'] ?>" name="product_name">
                                    <!-- <button class="add-cart mt-2">
                                        <div>
                                            <i class="fa fa-cart-plus" aria-hidden="true"></i><span>Сақтау</span>
                                        </div>
                                        <div class="buttonload">
                                            <i class="fa fa-spinner fa-spin text-center"></i>
                                        </div>
                                        <div class="btnCheck">
                                            <i class="fa-solid fa-check"></i>
                                        </div>
                                    </button> -->
                                </div>
                            </div>
                        </div>
                    </form>
                </a>
            <?php
            }
            ?>
        </div>
    </div>

    <?php require_once("footer.html") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./script.js"></script>
</body>



</html>