<?php
session_start();
require_once('db.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = $id";
    $products = $conn->query($sql);
    $product = $products->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c4832607e6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <style>
    img {
        object-fit: cover;
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

    <!-- Details -->

    <div class="container mt-5">
        <section id="prodetails" class="section-p1">
            <div class="single-pro-image">
                <img class="mb-2" src="/assets/uploads/<?php echo $product['image0'] ?>" width="100%" id="MainImg"
                    alt="">
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="/assets/uploads/<?php echo $product['image1'] ?>" width="100%" class="small-img"
                            alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="/assets/uploads/<?php echo $product['image2'] ?>" width="100%" class="small-img"
                            alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="/assets/uploads/<?php echo $product['image3'] ?>" width="100%" class="small-img"
                            alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="/assets/uploads/<?php echo $product['image4'] ?>" width="100%" class="small-img"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="single-pro-details">
                <h6>Home / T-Shirt</h6>
                <h4>
                    <?php echo $product['product_name'] ?>
                </h4>
                <h2>
                    <?php echo $product['product_price'] ?>тг
                </h2>
                <div class="mt-3">
                    <select>
                        <option>Select Size</option>
                        <option>S</option>
                        <option>M</option>
                        <option>L</option>
                        <option>XL</option>
                        <option>XXL</option>
                    </select>
                </div>
                <div class="mt-3">
                    <span class="fs-6">Quantity</span>
                    <input type="number" value="1">
                </div>

                <h4>Product Details</h4>
                <span>
                    <?php echo $product['description'] ?>
                </span>
                <div class="mt-4">
                    <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-cart-plus me-2"
                            aria-hidden="true"></i>Сақтау</button>
                </div>
            </div>
        </section>
    </div>

    <script>
    var MainImg = document.getElementById("MainImg");
    var smallimg = document.getElementsByClassName("small-img");

    smallimg[0].onclick = function() {
        MainImg.src = smallimg[0].src;
    }
    smallimg[1].onclick = function() {
        MainImg.src = smallimg[1].src;
    }
    smallimg[2].onclick = function() {
        MainImg.src = smallimg[2].src;
    }
    smallimg[3].onclick = function() {
        MainImg.src = smallimg[3].src;
    }
    </script>

    <!-- <div class="container mt-4">
        <div class="row">
            <div class="col-7">
                <div class="row">
                    <div class="col-5">
                        <video src="assets/uploads/<?php echo $product['video'] ?>" controls height="380px"></video>
                        <br>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-5">
                                <img src="assets/uploads/<?php echo $product['image1'] ?>" alt="" height="180px"
                                    width="150px" style="margin-bottom: 20px;"> <br>
                                <img src="assets/uploads/<?php echo $product['image2'] ?>" alt="" height="180px"> <br>
                            </div>
                            <div class="col-5" style="margin-left: 20px;">
                                <img src="assets/uploads/<?php echo $product['image3'] ?>" alt="" height="180px"
                                    style="margin-bottom: 20px;"> <br>
                                <img src="assets/uploads/<?php echo $product['image4'] ?>" alt="" height="180px"
                                    width="150px"> <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 ms-2">
                <h5>
                    <?php echo $product['product_name'] ?>
                </h5>
                <p>
                    <?php echo $product['description'] ?>
                </p>
                <h4>
                    <?php echo $product['product_price'] ?>тг
                </h4>
                <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-cart-plus me-2"
                        aria-hidden="true"></i>Сақтау</button>
            </div>
        </div>
    </div> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>