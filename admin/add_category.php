<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

require_once("../db.php");

$category_sql = "SELECT * FROM category";
$category_result = $conn->query($category_sql);

// add category
if (isset($_POST['add'])) {
    $category = $_POST['category'];
    $add_category = mysqli_query($conn, "INSERT INTO category (category) VALUES ('$category');");
    header("Location: add_category.php");
    exit();
}


// delete category
if (isset($_GET['delete_id'])) {
    $category_id = $_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM category WHERE id = ?");
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: add_category.php");
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
    <title>category</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
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
                    <h2 class="mt-4">Каталогдар</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Каталог</th>
                                <th scope="col">Әрекет</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($category = $category_result->fetch_assoc()) { ?>
                                <tr>
                                    <td scope="row" class="col-sm-2"><?php echo $i ?></td>
                                    <td><?php echo $category['category'] ?></td>
                                    <td>
                                        <a class='edit' href='?edit_id=<?php echo $category['id'] ?>' style='padding-left:20px'><i class='fa fa-pencil' aria-hidden='true'></i></a>
                                        <a class='delete ' href='?delete_id=<?php echo $category['id'] ?>' style='padding-left:20px'><i class='fa fa-trash' aria-hidden='true'></i> </a>
                                    </td>
                                </tr>
                            <?php
                                $i++;
                            }
                            ?>
                            <tr>
                                <form action="" method="post">
                                    <td> <button name="add_category" class="btn" style="color:green"> + Каталог қосу + </button></td>
                                    <?php
                                    if (isset($_POST['add_category'])) {
                                        echo '<td><input type="text" name="category"></td>
                                            <td><button name="add" class="btn btn-primary btn-sm">қосу</button></td>';
                                    }
                                    ?>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
            <?PHP require_once("../footer.html") ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

</body>

</html>