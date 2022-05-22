<?php
if (isset($_POST['submit-btn'])) {
    $mailto = "ruba.h.almasri@gmail.com";  //My email address
    $name = $_POST['fname'] . ' ' . $_POST['lname'];
    $fromEmail = $_POST['email'];
    $msg = $_POST['message'];

    //Email I will receive
    $message1 = "Cleint Name: " . $name . "<br>"
        . "Client Message: " . "<br>" . $msg;

    //Message for client confirmation
    $message2 = "Dear" . $name . "<br>"
        . "Thank you for contacting us. We will get back to you shortly!" . "<br><br>"
        . "You submitted the following message: " . "<br>" . $msg . "<br><br>"
        . "Regards," . "<br>" . "My Day shop";

    //Email headers
    $headers = "From: " . $fromEmail; // Client email, I will receive
    $headers2 = "From: " . $mailto; // This will receive client

    //PHP mailer function
    $result1 = mail($mailto, 'Client Message', $message1); // This email sent to My address
    $result2 = mail($fromEmail, 'Confirmation Email', $message2); //This confirmation email to client


    header('location:contact.php');

    //Checking if Mails sent successfully

    // if ($result1 && $result2) {
    //     $success = "Your Message was sent Successfully!";
    // } else {
    //     $failed = "Sorry! Message was not sent, Try again Later.";
    // }
}

?>