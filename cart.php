<?php
session_start();

if (isset($_SESSION['cart'])) {
    $max = sizeof($_SESSION['cart']);
}

include_once('./db.php');
if (isset($_POST['submit'])) {
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    for ($i = 0; $i < $max; $i++) {
        foreach ($_SESSION['cart'][$i] as $key => $val) {
            if ($key == 'id') {
                $product_id = $val;
            }
            if ($key == 'size') {
                $size = $val;
            }
            if ($key == 'color') {
                $color = $val;
            }
            if ($key == 'qty') {
                $qty = $val;
            }
        }
        $order_sql = "INSERT INTO orders (product_id, color, size, qty, phone, address)
                            VALUES ('$product_id', '$color', '$size', '$qty', '$phone', '$address')";
        $conn->query($order_sql);
    }
}

// TODO: remove selected item
if (isset($_POST['remove'])) {

    unset($_SESSION['cart']);
    session_destroy();
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
    <title>Card</title>
    <style>
        .fa-circle-info {
            color: red;
            font-size: 12px;
            position: relative;
            top: -10px;
            left: 26px;
        }

        .card .col {
            display: inline-block;
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
                        <a class="nav-link text-white" href="#">Contact us</a>
                    </li>
                    <li class="nav-item">

                        <a class="nav-link" href="cart.php">
                            <?php
                            if (isset($_SESSION['product_id'])) {
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


    <div class="container mt-3">
        <?php if (!isset($_SESSION['cart'])) { ?>
            <p>Себетке ешбір зат қосылмаған</p>
        <?php } else { ?>
            <form id="cart_form" action="cart.php" method="post">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th colspan="2">Өнім</th>
                            <th>Өлшем</th>
                            <th>Түс</th>
                            <th>Бағасы</th>
                            <th>Саны</th>
                            <th>Жалпы баға</th>
                            <!-- <th>Әрекет</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $max; $i++) { ?>
                            <tr>
                                <?php foreach ($_SESSION['cart'][$i] as $key => $val) {
                                    if ($key == 'id') {
                                        $product_id = $val;
                                    }
                                    if ($key == 'name') {
                                        $name = $val;
                                    }
                                    if ($key == 'price') {
                                        $price = $val;
                                    }
                                    if ($key == 'size') {
                                        $size = $val;
                                    }
                                    if ($key == 'color') {
                                        $color = $val;
                                    }
                                    if ($key == 'qty') {
                                        $qty = $val;
                                    }
                                }

                                $sql = "SELECT * FROM products WHERE id = $product_id";
                                $products = $conn->query($sql);
                                $product = $products->fetch_assoc();
                                ?>
                                <td><?php echo ($i + 1) ?></td>
                                <td> <img height="60px" src="./assets/uploads/<?php echo $product['image1'] ?>" alt="image"></td>
                                <td><?php echo $name ?></td>
                                <td><?php echo $size ?></td>
                                <td><?php echo $color ?></td>
                                <td><?php echo $price . 'тг' ?></td>
                                <td><?php echo $qty ?></td>
                                <td><?php echo $price * $qty . 'тг' ?></td>
                                <!-- <td><i class="fa-solid fa-trash-can delete"></i></td> -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="row">
                    <button class="btn btn-primary col me-3" onclick="openForm()">Жіберу</button>
                    <button class="btn btn-danger col ms-3" name="remove">Жою</button>
                </div>
                <div id="popup">
                    <div class="card">
                        <label for="phone">Телефон</label>
                        <input type="text" name="phone">
                        <br>
                        <label for="address">Мекенжай</label>
                        <textarea name="address" id="address" cols="30" rows="10"></textarea>
                        <br>
                        <button class="btn btn-primary" name="submit">Растау</button>
                        <div class="close" onclick="closeFrom()"><i class="fa-solid fa-xmark"></i></div>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
    </div>

    <?php require_once("footer.html") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        function openForm() {
            document.getElementById("popup").style.display = "block";
        }

        function closeFrom() {
            document.getElementById("popup").style.display = "none";
        }

        // let deletes = document.getElementsByClassName("delete")
        // for (let del of deletes) {
        //     del.addEventListener("click", (e) => {
        //         let i = e.target.parentNode.parentNode.firstElementChild.innerHTML
        //         fetch("./delete_cart.php", {
        //             method: 'POST',
        //             headers: {
        //                 "Content-Type": "application/json",
        //             },
        //             body: JSON.stringify({
        //                 id: 'hello'
        //             })
        //         })
        //     })

        // }
    </script>

</body>

</html>