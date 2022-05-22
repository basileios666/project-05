<?php
require('../admin_cp/init.php');
include_once('../includes/templates/navbar.php');
session_start();

?>

<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../contact_us/style.css">




<div class="container user_container" style="margin-bottom: 5%;">
    <div class="row align-items-stretch no-gutters contact-wrap">
        <div class="col-md-3 sidebar_div">
            <img src="images/pic.jpg" class="rounded-circle" alt="Profile" width="100" height="100">
            <h6 style="color: white;"><i class="fas fa-user-alt user_icons" style="color: #293A80;"></i><?php echo $_SESSION['user_name']?></h6>            <br><br>
            <a href="info.php" class="user_acc_links"><i class="fas fa-user-alt user_icons"></i> Info</a><br><br>
            <a href="orders.php" class="user_acc_links"><i class="fas fa-shopping-basket user_icons"></i> Orders</a><br><br>
            <a href="delete_session.php" class="user_acc_links"><i class="fa fa-sign-out user_icons"></i> Logout</a>
        </div>
        <div class="col-md-9 table-responsive-sm" id="user_orders_table">
            <?php
            try {
                $id = $_GET['order-id'];
                $date = $_GET['order_date'];

                $query1 = "SELECT * FROM cart WHERE order_date = :O_Date and order_id = :id";
                $result = $db->prepare($query1);
                $result->bindParam(':O_Date', $date);
                $result->bindParam(':id', $id);
                $result->execute();
                $data = $result->fetchAll();

                if ($data) {
                    echo ('<table class="table">
                    <thead class="orders_table_head">
                        <tr>
                            <th scope="col">Product_id</th>
                            <th scope="col">Product_name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>');

                    // output data of each row
                    foreach ($data as $value) {
                        echo "<tr><td>" . $value["product_id"] . "</td>
                    <td>" . $value["product_name"] . "</td>
                    <td>" . $value["price"] . "</td>
                    <td>" . $value["quantity"] . "</td>
                    </tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo ('NO Orders');
                }
            } catch (PDOException $e) {
                echo $query1 . "<br>" . $e->getMessage();
            } finally {
                $db = NULL;
            }

            ?>
        </div>
    </div>
</div>

<?php
include_once('../includes/templates/footer.php');

?>