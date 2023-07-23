<?php
session_start();
if (isset($_SESSION['product_id'])) {
    $product_ids = $_SESSION['product_id'];
    $product_index = array_values($product_ids);
    $qtys = array_values($_SESSION['qty']);
} else {
    header("Location: index.php");
    exit();
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    print_r($_SESSION['product_id']);
    echo $_SESSION['product_id'][$delete_id];
    unset($_SESSION['product_id'][$delete_id]);
    unset($_SESSION['qty'][$delete_id]);
    header("Location:cart.php");
}

require_once('db.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");


if (isset($_POST['remove'])) {
    unset($_SESSION['product_id']);
    unset($_SESSION['qty']);
    header("Location: cart.php");
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
    <title>Home</title>
    <style>
        .fa-circle-info {
            color: red;
            font-size: 12px;
            position: relative;
            top: -10px;
            left: 26px;
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
    <div class="container">
        <div class="mt-3 card p-4">
            <form action="" method="post">
                <?php
                $i = 1;
                foreach ($product_ids as $id) {
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    echo '
                        <div class="card mb-3">
                                <div class="row align-items-center ps-3 pe-3">
                                    <div class="col-sm-1">
                                        <p>#' . $i . '</p>
                                    </div>
                                    <div class="col">
                                        <img src="./assets/uploads/' . $row['image_location'] . '" width="60px" alt="...">
                                    </div>
                                    <div class="col">
                                    <h5 class="card-title ">' . $row['product_name'] . '</h5>
                                    </div>
                                    <div class="col">
                                    <p class="card-text">' . $row['description'] . '</p>
                                    </div>
                                    <div class="col">
                                        <input type="number" name="qty" value="' . $qtys[$i - 1] . '"></input>
                                    </div>
                                    <div class="col">
                                    <h4 class="card-text col" style="color: #ee4d2d;">' . $row['product_price'] . ' тг</h4>
                                    </div>
                                   
                                </div>
                        </div>';
                    $i++;
                }
                ?>
                <div class="row">
                    <button class="btn btn-primary col me-3" name="submit">Жіберу</button>
                    <button class="btn btn-danger col ms-3" name="remove">Жою</button>
                </div>
            </form>
        </div>
    </div>
    <?php require_once("footer.html") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


</body>

</html>