<?php
require("../admin_cp/init.php");
try{
    $product_id=$_POST['id'];
    $sql="DELETE FROM `cart` where product_id=$product_id";
    $statment_delete=$db->prepare($sql);
    $statment_delete->execute();
    header('location:cart.php');
  }
    catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
  }
   finally {
      $db = NULL;
  }
  ?>