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


    <!-- Details -->
    <div class="container mt-5">
        <section id="prodetails" class="section-p1">
            <div class="single-pro-image">
                <img class="mb-2" src="./assets/uploads/<?php echo $product['image1'] ?>" width="100%" id="MainImg" alt="">
                <div class="small-img-group">
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
                <h4 class="mb-4">
                    <?php echo $product['product_name'] ?>
                </h4>
                <div class="bg-light px-3 py-2">
                    <h2 class="detail_page_price">
                        <?php echo $product['product_price'] ?>тг
                    </h2>
                </div>
                <div class="mt-3 detail_size">
                    <span class="title me-3">Резмер</span>
                    <?php foreach ($size_arr as $size) { ?>
                        <div class="size px-4 py-1 prevent-select unselect_size"><?php echo $size ?></div>
                    <?php } ?>
                </div>
                <div class="color-content">
                    <div class="title me-5">Түсті</div>
                    <div class="color-groups prevent-select">
                        <?php foreach ($color_arr as $color) { ?>
                            <div class="color color-<?php echo $color ?>"></div>
                        <?php } ?>
                    </div>
                </div>

                <div class="mt-3 mb-3">
                    <span>Саны</span>
                    <input type="number" value="1">
                </div>
                <div>
                    <div class="fw-semibold mb-1">Өнім мәліметтері</div>
                    <pre class="text-secondary">
                        <?php echo $product['description'] ?>
                    </pre>

                </div>
                <div class="mt-4">
                    <button type="button" class="btn btn-sm px-4 py-2"><i class="fa fa-cart-plus me-2" aria-hidden="true"></i>Сақтау</button>
                </div>
            </div>
        </section>
    </div>

    <script>
        // Details
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

        // Color
        const COLOR_BTNS = document.querySelectorAll('.color');
        const size_btn = document.querySelectorAll('.size');
        COLOR_BTNS.forEach(color => {
            color.addEventListener('click', () => {
                let colorNameClass = color.className;
                if (!color.classList.contains('active-color')) {
                    let colorName = colorNameClass.slice(colorNameClass.indexOf('-') + 1, colorNameClass.length);
                    resetActiveBtns();
                    color.classList.add('active-color');

                }
            });
        })
        size_btn.forEach(size => {
            size.addEventListener('click', () => {
                let sizeNameClass = size.className;
                if (!size.classList.contains('select_size')) {
                    resetSizebtns();
                    size.classList.add('select_size');
                    size.classList.remove('unselect_size');
                }
            })
        })

        //resetting all color btns
        function resetActiveBtns() {
            COLOR_BTNS.forEach(color => {
                color.classList.remove('active-color');
            });
        }

        function resetSizebtns() {
            size_btn.forEach(size => {
                size.classList.remove('select_size');
                size.classList.add('unselect_size');
            })
        }
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>