<?php
session_start();
require("../admin_cp/init.php");
include('../includes/templates/navbar.php');
$sql = "SELECT * FROM `cart` WHERE order_id=$_SESSION[order_id] order by product_id";
$statment = $db->prepare($sql);
$statment->execute();
$cart = $statment->fetchAll();

?>
<!doctype html>
<html lang="en">

<head>
    <title>Cart</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <ink rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            #x{
    font-size:36px;
    color: #537EC5;
}
#check{
    background-color: #537EC5;
    color: white;
    margin-left: 2%;
}
#apply{
    background-color: #537EC5;
    color: white;
}
#btn_update {
    background-color: #537EC5;
    color: white;
    
}
#carttotal{
    margin-top: 5%;
}
        </style>
</head>

<body>
    <?php
    if ($_SESSION['order_id']) {
    
    ?>
        <div class="container">
            <div class="table-responsive-sm">
                <table class="table">
                    <thead style="background-color:#293A80;color:white">
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Sub Total</th>
                            <th scope="col">
                                <!--Action-->
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        //$totalCounter = 0;
                        //$itemCounter = 0;
                        foreach ($cart as $value) :
                            //$total = $value['price'] * $value['quantity'];
                            // $totalCounter += $total;
                            //$itemCounter+=$value['quantity'];

                        ?>
                            <tr>
                                <td><?php echo $value['product_name']; ?></td>
                                <td><img src="<?php echo "../admin_cp/{$value['image']}" ?>" width="90"></td>
                                <td><?php echo $value['price'] . ' JD'; ?></td>
                                <td>
                                    <form class="form-inline my-2 my-lg-0" method="POST" action="update.php">
                                        <input class="form-control mr-sm-2" type="hidden" name="update" value="<?php echo $value['product_id']; ?>">
                                        <input class="form-control mr-sm-2" type="hidden" name="price" value="<?php echo $value['price']; ?>">

                                        <input type="number" name="qty" class="cart-qty-single" value="<?php echo $value['quantity']; ?>" min="1" max="20">
                                        <button type="submit" class="btn btn-sm float-right" name="update_qty" id="btn_update" style="margin-left:3% ;">Update</button>

                                    </form>
                                </td>
                                <td><?php echo $value['price'] * $value['quantity'] . " JD";
                                    ?>
                                </td>
                                <td>
                                    <form class="form-inline my-2 my-lg-0" action="delete.php" method="post">
                                        <input class="form-control mr-sm-2" type="hidden" name="id" value="<?php echo $value['product_id']; ?>">
                                        <button class=" btn btn-md float-right" id="delete" type="submit"> <i class="material-icons" id="x">close</i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php

                        endforeach
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <a href="product.php">
                    <button class="btn btn-md float-right" id="shop" style=" background-color: #537EC5;color: white;margin-left: 2%;"> Continue Shopping</button>
                </a>
                <form method="POST" action="checklogin.php">

                    <button class="btn btn-md float-right" type="submit" name="checkout" id="check">Proceed to Checkout</button>
                </form>


                <!-- coupon-->

                <form class="form-inline my-2 my-lg-0" method="POST">
                    <input class="form-control mr-sm-2" type="text" name="copon" placeholder="coupon code">
                    <input class="form-control mr-sm-2" type="hidden" name="coponApply" value="<?php echo $value['product_id']; ?>">

                    <button class=" btn btn-md float-right" id="apply" name="apply" type="submit">Apply coupon</button>
                </form>
                <?php
                if (isset($_POST['apply'])) {
                    $coupon = $_POST['copon'];
                    if ($coupon != 'code20') {
                        echo "The coupon does not exist";
                    }
                }
                ?>
            </div>
        </div>
        <div class="container">
            <div class="row mt-3">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        Cart total
                        <span class="badge badge-secondary badge-pill"></span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (JOD)</span>
                            <strong> <?php
                                        $total = 0;
                                        foreach ($cart as $value) {
                                            $total += $value['sub_total'];
                                        }
                                        $_SESSION['total'] = $total;

                                        echo $total . " JD";

                                        ?></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span> Total after Discount:</span>
                            <strong> <?php
                                        if (isset($_POST['apply'])) {
                                            $product_id = $_POST['coponApply'];
                                            $coupon = $_POST['copon'];
                                            if ($coupon == 'code20') {
                                                echo $total - ($total * 20 / 100) . " JD";
                                                $_SESSION['discount_total'] = $total - ($total * 20 / 100);
                                            } else {
                                                echo "---";
                                            }
                                        }
                                        ?></strong>
                        </li>
                    </ul>
                </div>
            <?php
        }
        else{
            echo "<h1> CART IS EMPTY!</h1>";
        }
            ?>
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="<?php echo $js . 'main.js'?>"></script>
<script src="https://kit.fontawesome.com/3509c2808e.js" crossorigin="anonymous"></script>
</body>

</html>