<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

require_once("../db.php");

$banner_sql = "SELECT * FROM banner";
$banner_result = $conn->query($banner_sql);

// add file
if (isset($_POST['add_banner'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'mp4', 'mov');

    try {
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 100000000) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = '../assets/banners/' . $fileNameNew;
                    try {
                        $sql = "INSERT INTO banner (image_location) VALUES ('$fileNameNew')";
                        mysqli_query($conn, $sql);
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $message = "Сәтті жүктелді";
                        header("Location: add_banner.php");
                    } catch (mysqli_sql_exception) {
                        echo "server error";
                    }
                } else {
                    echo 'Файлыңыз тым үлкен!';
                }
            } else {
                echo 'Файлды жүктеп салу кезінде қате бар!';
            }
        } else {
            echo 'Мұндай файлды жүктеп салу мүмкін емес!';
        }
    } catch (Exception) {
        echo 'Error here';
    }
}

// delete file
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM banner WHERE id = $delete_id";
    try {
        $stmt = $conn->query("SELECT * FROM banner WHERE id = $delete_id");
        $banner = $stmt->fetch_assoc();
        unlink("../assets/banners/" . $banner['image_location']);
        $conn->query($sql);
        $message = "Сәтті өшірілді";
        header("Location: add_banner.php");
    } catch (mysqli_sql_exception) {
        $message = "Өшірілмей қалды";
    }
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
                    <?php
                    if (isset($message)) { ?>
                        <h5 sytle="color:blue;"><?php echo $message ?></h5>
                    <?php }
                    ?>
                    <table class="table table-bordered">
                        <?php while ($result = $banner_result->fetch_assoc()) { ?>
                            <tr>
                                <td><img src="../assets/banners/<?php echo $result['image_location'] ?>" height=100px alt=""></td>
                                <td><a href="add_banner.php?delete_id=<?php echo $result['id'] ?>" style="padding-left:20px"><i class='fa fa-trash' aria-hidden='true'></i></a></td>
                            </tr>

                        <?php } ?>
                    </table>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="file" class="mb-1">Баннер таңдаңыз</label>
                            <input type="file" class="form-control" placeholder="Баннер таңдаңыз" name="file">
                        </div>
                        <button class="btn btn-primary" name="add_banner">Жүктеп салу</button>
                    </form>
                </div>
            </main>
            <?PHP require_once("../footer.html") ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

</body>

</html>