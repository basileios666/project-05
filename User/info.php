<?php
session_start();
include('../admin_cp/init.php');
include_once('../includes/templates/navbar.php');


// $_SESSION['user_name']='ruba';

?>

<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../contact_us/style.css">





<div class="container user_container" style="margin-bottom: 5%;">
    <div class="row align-items-stretch no-gutters contact-wrap">
        <div class="col-md-3 sidebar_div">
            <img src="<?php echo $_SESSION['user_image']?>" class="rounded-circle" alt="Profile" width="100" height="100">
            <h6 style="color: white;"><i class="fas fa-user-alt user_icons" style="color: #293A80;"></i><?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name']: 'unknown'?></h6>
            <br><br>
            <a href="info.php" class="user_acc_links"><i class="fas fa-user-alt user_icons"></i> Info</a><br><br>
            <a href="orders.php" class="user_acc_links"><i class="fas fa-shopping-basket user_icons"></i> Orders</a><br><br>
            <a href="delete_session.php" class="user_acc_links"><i class="fa fa-sign-out user_icons"></i> Logout</a>
        </div>
        <div class="col-md-9" id="user_info_form">
            <?php
            // if (isset($_SESSION['id'])) {

            try {
                $id = $_SESSION['id'] ?? 35;
                $query1 = "SELECT user_name, user_email, user_mobile, user_location, user_image FROM users WHERE user_id = :ID";
                $result = $db->prepare($query1);
                $result->bindParam(':ID', $id);
                $result->execute();
                $data = $result->fetchAll();
                $_SESSION['user_image'] = $data[0]['user_image'];
                if ($data) {
                    foreach ($data as $value) { ?>
                        <form class="mb-5" method="post" action="edit.php" id="contactForm" name="contactForm">
                            <div class="row">
                                <div class="col-md-6 form-group mb-5">
                                    <label for="" class="col-form-label"><b>User ID</b></label>
                                    <input type="text" class="form-control" name="id" id="user_id" disabled value="<?php echo $id ?>">
                                </div>
                                <div class="col-md-6 form-group mb-5">
                                    <label for="" class="col-form-label"><b>Name</b></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $value["user_name"] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group mb-5">
                                    <label for="" class="col-form-label"><b>Email</b></label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $value["user_email"] ?>">
                                </div>
                                <div class="col-md-6 form-group mb-5">
                                    <label for="" class="col-form-label"><b>Phone Number</b></label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="<?php echo $value["user_mobile"] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group mb-5">
                                    <label for="" class="col-form-label"><b>Addreess</b></label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="<?php echo $value["user_location"] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="submit" value="Edit" name="edit-btn" class="btn rounded-3 py-2 px-4">
                                </div>
                            </div>
                        </form>
            <?php }
                }
            } catch (PDOException $e) {
                echo $query1 . "<br>" . $e->getMessage();
            } finally {
                $db = NULL;
            }
            // } else {
            //     echo ('<h1>Please login to show your information...</h1>');
            // }
            ?>

        </div>
    </div>
</div>
<?php
include_once('../includes/templates/footer.php');

?>