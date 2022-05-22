<?php
session_start();
require("../admin_cp/init.php");
include('../includes/templates/navbar.php');
$_SESSION['order_id'] = 59;
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php
    $select = "SELECT * FROM orders WHERE order_id=:order_id ";
    $select_statment = $db->prepare($select);
    $select_statment->bindParam(":order_id", $_SESSION['order_id']);

    $select_statment->execute();
    $data = $select_statment->fetchAll();
    if (isset($_POST['checkbtn'])) {
        check($_POST['name'], $_POST['phone']);
        $sql = "INSERT INTO orders (order_user_id, order_total, order_mobile ,order_location) VALUES (:name ,:total,:phone , :address)";
        try {

            $checkstatment = $db->prepare($sql);
            $checkstatment->execute([':id' => $id, ':total' => $_SESSION['total'], ':phone' => $_POST['phone'], ':address' => $_POST['Address']]);
            header("Location:login.php");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    ?>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    Your cart
                    <span class="badge badge-secondary badge-pill"></span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (JOD)</span>
                        <strong><?php if($_SESSION['discount_total']){

                        echo $_SESSION['discount_total'];}
                        else{
                            echo $_SESSION['total'];
                        } ?></strong>
                    </li>
                    
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" method="POST" action='http://localhost/project-test/final_page/thank-you.php'>
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">User name</label>
                        <input type="text" class="form-control" id="firstName" name="name" placeholder="haneen" value="<?php echo  $data[0]['order_user_name'] ?>">
                        <?php echo $errors[0] ?? "" ?>
                    </div>
                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="<?php echo  $data[0]['order_location'] ?>">
                        <?php echo $errors[2] ?? "" ?>
                    </div>
                    <div class="mb-3">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" id="phonenum" name="phone" placeholder="07777777" value="<?php echo  $data[0]['order_mobile'] ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <select class="custom-select d-block w-100" name="state" id="state">
                            <option value="">Choose...</option>
                            <option value="1">Amman</option>
                            <option value="2">Irbid</option>
                        </select>
                    </div>
            </div>
            <hr class="mb-4">

            <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input id="cashOnDelivery" name="cashOnDelivery" type="radio" class="custom-control-input" checked="">
                    <label class="custom-control-label" for="cashOnDelivery">Cash on Delivery</label>
                </div>
            </div>

            <hr class="mb-4">
            <button class="btn  btn-lg btn-block" type="submit" name="submit" value="submit" style="background-color:#537EC5 ;color:white;">Continue to checkout</button>
            </form>
        </div>
    </div>
    </div>
    <?php
    function check($user_name, $user_mobile)
    {
        global $errors;
        $regexName      = "/^[A-z ]{3,}$/";
        $regexPhone      = "/^((\+)((0[ -])|((91 )))((\d{12})+|(\d{10})+))|\d{5}([- ]*)\d{6}$/";
        //$regexEmail     = "/^[A-z0-9._-]+@(hotmail|gmail|yahoo).com$/";
        $select = true;
        // Validation
        if (empty($user_name) || trim($user_name) == "") {
            $errors[0] = "This field is required";
            $select = false;
        } else if (!preg_match($regexName, $user_name)) {
            $errors[0] = "This field is not correct, only letters are allowed";
            $state     = false;
        }

        if (empty($user_mobile) || trim($user_mobile) == "") {
            $errors[2] = "This field is required";
            $select= false;
        } else if (!preg_match($regexPhone, $user_mobile)) {
            $errors[2] = "This field is not correct, enter a valid phone number";
            $select     = false;
        }
        return $select;
    }


    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include('../includes/templates/footer.php') ?>