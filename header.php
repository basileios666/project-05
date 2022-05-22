<?php
 session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>MyDay</title>
	<link rel="stylesheet" href="css/homestyle.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body class="goto-here">
		<div class="py-1" style="background-color: #010038;">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
	    		<div class="col-lg-12 d-block">
		    		<div class="row d-flex">
		    			<div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <span class="text">+962-77-809-1935</span>
					    </div>
					    <div class="col-md pr-5 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						    <span class="text">basil.ab@icloud.com</span>
					    </div>
						<?php
						if(!isset($_SESSION['id'])){
                        echo "<div class=col-md-2 pr-1 d-flex topper align-items-center text-lg-right>
						      <a href=loginpage.php class=white ;><botton>Login|</botton></a>
					          <a href=reg.php class=gold ><botton>|Register</botton></a></div>";}
					    else {
	                    echo "<div class=col-md-2 pr-1 d-flex topper align-items-center text-lg-right>
						    <h6 class=welcome> Welcome $_SESSION[username]</div>
				   <div class=col-md-1 pr-5 d-flex topper align-items-center text-lg-right>
					   <a class=gold href=account.php>Account</a>
				   </div>
				   <div class=col-md-1 pr-5 d-flex topper align-items-center text-lg-right>
					   <a class=gold href=logout.php>Logout</a>
				   </div>";
                        }?>
				    </div>
			    </div>
		    </div>
		  </div>
    </div>