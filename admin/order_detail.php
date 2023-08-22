<?php
require_once('../db.php');
if (isset($_GET['phone'])) {
    $phone = $_GET['phone'];
    $sql = "SELECT * FROM orders INNER JOIN products ON orders.product_id = products.id WHERE phone = $phone";
    $result = $conn->query($sql);
}
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
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
    <title>Тапсырыс</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
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
                    <h6 class="mt-4"><a href="./">Артқа</a></h6>

                    <div id="product_list" class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Тапсырыс
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Фото</th>
                                        <th>Аты</th>
                                        <th>Түс</th>
                                        <th>Саны</th>
                                        <th>Өлшем</th>
                                        <th>Телефон</th>
                                        <th>Мекенжай</th>
                                        <th>Жалпы</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $i = 1;

                                    while ($row = $result->fetch_assoc()) {


                                        echo
                                        "<tr>
                                            <td> #" . $i . "</td>
                                            <td><img src='../assets/uploads/" . $row['image1'] . "' width='50px'></td>
                                            <td>" . $row['product_name'] . "</td>
                                            <td><div class='color-detail mx-1 color-" . $row['order_color'] . "'</div></td>
                                            <td>" . $row['qty'] . "</td>
                                            <td> " . $row['order_size'] . "</td>
                                            <td>" . $row['phone'] . "</td>
                                            <td>" . $row['address'] . "</td>
                                            <td>" . $row['product_price'] * $row['qty']  . " тг</td>
                                        </tr>";
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </main>
            <?PHP require_once("../footer.html") ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>

</body>

</html>