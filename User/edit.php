<?php
include('../admin_cp/init.php');
session_start();

try {
    // $user_id = $_POST['id'];
    


    // if ($_SESSION['id']) {
        // $i = $_SESSION['id'];
        $i=35;
        $user_name = $_POST['name'];
        $user_email = $_POST['email'];
        $user_phone = $_POST['phone'];
        $user_address = $_POST['address'];

        $query = "UPDATE users SET user_name=:names, user_email=:email, user_mobile=:mobile, user_location=:locations WHERE user_id=:ID";


        $result = $db->prepare($query);

        $result->bindValue(':names', $user_name);
        $result->bindValue(':email', $user_email);
        $result->bindValue(':mobile', $user_phone);
        $result->bindValue(':locations', $user_address);
        $result->bindValue(':ID', $i);

        $result->execute();
        echo ('successfully');
        header('location:info.php');
    // }
    // else{
    //     echo('Please login to show your information...');
    // }
} catch (PDOException $e) {
    echo $query . "<br>" . $e->getMessage();
} finally {
    $db = NULL;
}
