<?php
require("../admin_cp/init.php");
//if(isset($_POST['update'])){
   //$product_id=$_POST['id'];
    //$cart_id=$_POST['cart_id'];
    //$quantity = $_POST['qty'];
   // $sql="UPDATE `cart` SET quantity ='$quantity'  WHERE product_id ='$product_id'";
    //$update_statment=$db->query($sql);
    //$message[] = 'cart quantity updated';
//}
try{
$product_id=$_POST['update'];
$quantity=$_POST['qty'];
$price=$_POST['price'];
$sql = "UPDATE cart SET quantity=:quantity WHERE product_id=:product_id";
    $update_statement= $db->prepare($sql);
    $update_statement->bindValue(':quantity', $quantity);
    $update_statement->bindValue(':product_id', $product_id);
    $update_statement->execute();
    //subtotal
    $subtotal = $quantity * $price;
    $s = "UPDATE cart SET sub_total=:sub_total WHERE product_id=:product_id";
    $update_statement = $db->prepare($s);
    $update_statement->bindValue(':sub_total', $subtotal);
    $update_statement->bindValue(':product_id', $product_id);
    $update_statement->execute();
    header('location:cart.php');
    


}
catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
 finally {
    $db = NULL;
}
