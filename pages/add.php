<?php
session_start();
require_once '../admin_cp/init.php';
$productId = $_GET['id'];
$qty = $_GET['qty'];

//get order id
$statement2 = $db->prepare('SELECT order_id FROM orders WHERE order_user_id = "35" ORDER BY order_date DESC');
$statement2->execute();
$order = $statement2->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['order_id'] = $order[0]['order_id'] ?? NULL;
if (!$_SESSION['order_id']) {
    $statement = $db->prepare('INSERT INTO `orders`( `order_location`, `order_mobile`, `order_user_name`, `order_total`,`order_user_id`) VALUES ("Jordan","077","abdallah","380","35")');
    $statement->execute();
}

if ($_SESSION['order_id']) {
$statement3 = $db->prepare('INSERT INTO `order_items` (`order_id`, `product_id`) VALUES (:order_id, :product_id)');
$statement3->bindValue(':order_id',$_SESSION['order_id']);
$statement3->bindValue(':product_id',$productId);
for ($i=0 ; $i < $qty ; $i++ ) { 
    $statement3->execute();
}
}

//get product details
$statement6 = $db->prepare('SELECT * FROM products WHERE product_id = :id');
$statement6->bindValue(':id', $productId);
$statement6->execute();
$fetched = $statement6->fetchAll(PDO::FETCH_ASSOC);
$product = $fetched[0];


//add to cart
$statement5 = $db->prepare('INSERT INTO `cart` ( `product_id`, `order_id`, `product_name`, `price`,  `image`, `sub_total`) VALUES (:product_id , :order_id, :product_name, :price , :image ,:sub_total)');
$statement5->bindvalue(':product_id' , $productId);
$statement5->bindvalue(':order_id' , $_SESSION['order_id']);
$statement5->bindvalue(':product_name' , $product['product_name']);
$statement5->bindvalue(':price' , $product['product_price']);
$statement5->bindvalue(':image' , $product['product_main_image']);
$statement5->bindvalue(':sub_total' , $product['product_price']);
$statement5->execute();


//cart item count
$statement4 = $db->prepare('SELECT COUNT(product_id) AS products_count FROM order_items WHERE order_id = :id');
$statement4->bindValue(':id' , $_SESSION['order_id']);
$statement4->execute();
$products_count = $statement4->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['products_count'] = $products_count[0]['products_count'];

//rediriction to the page the user just came from 
$redirect = str_replace('"','',$_SERVER['HTTP_REFERER']);
if (isset($redirect)) {
    header("location:$redirect");
    
}
?>