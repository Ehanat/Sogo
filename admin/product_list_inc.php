<?php
require_once('../db.php');
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>
<div id="product_list" class="card my   -4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Тауарлар
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Фото</th>
                    <th>Аты</th>
                    <th>Бағасы</th>
                    <th>Саны/Қорап</th>
                    <th>Каталог</th>
                    <th>Әрекет</th>
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
                        <td>" . $row['product_price'] . " тг</td>
                        <td>" . $row['product_qty'] . "</td>
                        <td>" . $row['category'] . "</td>
                        <td>
                            <a class='edit' href='edit_product.php?edit_id=" . $row['id'] . "' style='padding-left:20px'><i class='fa fa-pencil' aria-hidden='true'></i></a>
                            <a class='delete ' href='delete_product.php?delete_id=" . $row['id'] . "' style='padding-left:20px'><i class='fa fa-trash' aria-hidden='true' ></i> </a>
                        </td>
                    </tr>";
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>