<?php
session_start();
require_once('db.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = $id";
    $products = $conn->query($sql);
    $product = $products->fetch_assoc();
    $size_list = $product['size'];
    if ($size_list[0] === ',') {
        $size_list = substr($size_list, 1);
    }
    $size_arr = explode(',', $size_list);
    $color_list = $product['color'];
    if ($color_list[0] === ',') {
        $color_list = substr($color_list, 1);
    }
    $color_arr = explode(',', $color_list);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
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


    <!-- Details -->
    <div class="container mb-5">
        <section id="prodetails" class="section-p1">
            <div class="single-pro-image">
                <div class="big_area mb-2">
                    <video controls autoplay muted src="./assets/uploads/<?php echo $product['video'] ?>"></video>
                </div>
                <div class="small-img-group">
                    <div class="small-img-col">
                        <video src="./assets/uploads/<?php echo $product['video'] ?>" class="small_video"></video>
                    </div>
                    <div class="small-img-col">
                        <img src="./assets/uploads/<?php echo $product['image1'] ?>" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="./assets/uploads/<?php echo $product['image2'] ?>" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="./assets/uploads/<?php echo $product['image3'] ?>" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="./assets/uploads/<?php echo $product['image4'] ?>" width="100%" class="small-img" alt="">
                    </div>
                </div>
            </div>
            <div class="single-pro-details">
                <form action="addToCart.php" method="post" id="addToCard_form">
                    <input name="product_id" class="product_id" type="number" hidden value="<?php echo $product['id'] ?>">
                    <input type="text" name="img" value="<?php echo $product['image1'] ?>" hidden>
                    <h4 class="mb-4">
                        <?php echo $product['product_name'] ?>
                        <input type="text" hidden value="<?php echo $product['product_name'] ?>" name="product_name">
                    </h4>
                    <div class="bg-light px-3 py-2">
                        <h2 class="detail_page_price">
                            <?php echo $product['product_price'] ?>тг
                        </h2>
                        <input type="text" hidden value="<?php echo $product['product_price'] ?>" name="product_price">
                    </div>
                    <div class="mt-3 detail_size row">
                        <p class="title col-2">Резмер</p>
                        <section class="col-9">
                            <?php foreach ($size_arr as $size) { ?>
                                <div class="size px-4 py-1 prevent-select unselect_size"><?php echo $size ?></div>
                            <?php } ?>
                        </section>
                    </div>
                    <input type="text" hidden class="product_size" name="product_size" value="">
                    <div class="color-content row">
                        <p class="title col-2">Түсті</p>
                        <div class="col-9">
                            <div class="color-groups prevent-select">
                                <?php foreach ($color_arr as $color) { ?>
                                    <div class="color mx-1 color-<?php echo $color ?>"></div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <input type="text" hidden class="product_color" name="product_color">
                    <div class="qty mt-3 mb-3 row prevent-select">
                        <p class="col-2">Саны</p>
                        <div class="col-9">
                            <div class=" btns minus"><i class="fa-solid fa-minus"></i></div>
                            <input class="product_qty" type="number" name="product_qty" value="1">
                            <div class="btns plus"><i class="fa-solid fa-plus"></i></div>
                        </div>
                    </div>
                    <div class="error my-3">

                    </div>
                    <div class="mt-4">
                        <button name="add_card" type="submit" class="addToCardBtn btn btn-sm px-4 py-2"><i class="fa fa-cart-plus me-2" aria-hidden="true"></i>Сақтау</button>
                    </div>
                </form>
            </div>

        </section>
    </div>
    <div class="container description">
        <div class="fw-semibold mb-1 fs-4">Өнім деректері</div>
        <pre class="product_description text-secondary">
                    <?php echo $product['description'] ?>
                </pre>

    </div>

    <?php require_once("footer.html") ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="./script.js"></script>
</body>

</html>