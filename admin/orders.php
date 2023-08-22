<?php
require_once('../db.php');
$sql = "SELECT * FROM orders ";
$result = $conn->query($sql);
$phones = array();
while ($row = $result->fetch_assoc()) {
    $phone = $row['phone'];
    array_push($phones, $phone);
}
?>
<style>
    table tr {
        cursor: pointer;
    }
</style>
<div id="product_list" class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Тапсырыстар
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Телефон</th>
                    <th>Тапсырыстар саны</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <form action="order_detail.php" method="get">
                    <?php
                    $i = 1;
                    $countes = array_count_values($phones);
                    foreach ($countes as $key => $val) {
                        echo
                        "
                        <tr>
                            <td> #" . $i . "</td>
                            <td>" . $key . "</td>
                            <td>" . $val . "</td>
                            <td><a style='color: blue' href='order_detail.php?phone=" . $key . "'>Detail</a></td>
                        </tr>";
                        $i++;
                    }
                    ?>
                </form>
            </tbody>
        </table>
    </div>
</div>