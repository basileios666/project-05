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
            $_SESSION['id']=35;
            // if (isset($_SESSION['id'])) {
                try {

                    $id = $_SESSION['id'];
                    $query1 = "SELECT * FROM orders WHERE order_user_id = :ID";
                    $result = $db->prepare($query1);
                    $result->bindParam(':ID', $id);
                    $result->execute();
                    $data = $result->fetchAll();
                    if ($data) {
                        echo ('<table class="table">
                    <thead class="orders_table_head">
                        <tr>
                            <th scope="col">Order_ID</th>
                            <th scope="col">Order_Date</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>');

                        // output data of each row
                        foreach ($data as $value) {
                            echo "<tr><td>" . $value["order_id"] . "</td>
                    <td>" . $value["order_date"] . "</td>
                    <td>" . $value["order_total"] . "</td>
                    <td>" . $value["order_status"] . "</td>
                    <td>" . '<form action="show_order.php" method="get" style="margin-left:-9%; ">
                    <input type="hidden" name="order-id" value="' . $value["order_id"] . '">
                    <input type="hidden" name="order_date" value="' . $value["order_date"] . '">
                    <button type="submit" class="btn rounded-3 py-2 px-4" name="view" id="view"><i class="fa fa-eye"></i> View</button>
                    </form>' . "</td></tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo ('<h2>NO Orders</h2>');
                    }
                } catch (PDOException $e) {
                    echo $query1 . "<br>" . $e->getMessage();
                } finally {
                    $db = NULL;
                }
            // } else {
            //     echo ('<h1>Please login to show your orders...</h1>');
            // }

            ?>
        </div>
    </div>
</div>
<?php
include_once('../includes/templates/footer.php');

?>