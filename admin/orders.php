<?php
require_once('../db.php');
$sql = "SELECT * FROM orders INNER JOIN products ON orders.product_id = products.id";
$result = $conn->query($sql);
?>
<div id="product_list" class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Тапсырыстар
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
                        <td>" . $row['order_color'] . "</td>
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
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>