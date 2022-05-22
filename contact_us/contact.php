<?php
include('../admin_cp/init.php');
include_once('../includes/templates/navbar.php');

?>

<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">


<div class="container" id="contact_container" style="margin-bottom: 5%;">
    <div class="row align-items-stretch no-gutters contact-wrap">
        <div class="col-md-8" id="contact_form_container">
            <div class="form h-100">
                <h3>Send us a message</h3>
                <form class="mb-5" method="post" action="" id="contactForm" name="contactForm">
                    <div class="row">
                        <div class="col-md-6 form-group mb-5">
                            <label for="" class="col-form-label"><b>First Name *</b></label>
                            <input type="text" class="form-control" name="fname" id="fname" placeholder="First name" required>
                        </div>
                        <div class="col-md-6 form-group mb-5">
                            <label for="" class="col-form-label"><b>Last Name *</b></label>
                            <input type="text" class="form-control" name="lname" id="lname" placeholder="Last name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-5">
                            <label for="" class="col-form-label"><b>Email *</b></label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-5">
                            <label for="message" class="col-form-label"><b>Message *</b></label>
                            <textarea class="form-control" name="message" id="message" cols="30" rows="4" placeholder="Write your message" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input type="submit" value="Send Message" name="submit-btn" class="btn rounded-3 py-2 px-4">
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_POST['submit-btn'])) {
                    echo ('<h6 style="color: #9fec51;">Message sent successfully</h6>');
                }
                ?>
            </div>
        </div>
        <div class="col-md-4" id="contact_info">
            <div class="contact-info h-100">
                <h3>Contact Information</h3>
                <p class="mb-5">If you have any questions or queries, our staff will always be happy to help. Feel free to contact us by telephone or email and we will be sure to get back to you as soon as possible.</p>
                <img src="../User/images/contact us.png" class="responsive" alt="contact" id="contact_img">
                <ul class="list-unstyled">
                    <li class="d-flex contact_li">
                        <i class='fas fa-map-marker-alt contact_icon'></i><span class="text">Irbid, Jordan</span>
                    </li>
                    <li class="d-flex contact_li">
                        <i class="fa fa-phone contact_icon"></i><span class="text">+962 77 7777 777</span>
                    </li>
                    <li class="d-flex contact_li">
                        <i class="fa fa-envelope contact_icon"></i><span class="text">myday@gmail.com</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
include_once('../includes/templates/footer.php');

?>