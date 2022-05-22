

<?php include '../includes/templates/navbaradmin.php';
      require_once('init.php');
?>
<?php   include '../layout/table.php';?>


<?php



$search=$_GET['search']??'';
if ($search){
  $statement =$db->prepare('SELECT * FROM products WHERE product_name LIKE :name ORDER BY product_id ASC');
  $statement->bindValue(':name',"%$search%");
}else{
  $statement =$db->prepare('SELECT * FROM products ORDER BY product_id ASC');
}


$statement->execute();
$products= $statement->fetchAll(PDO::FETCH_ASSOC);




#search
echo '<div class="searchbox">
<div class="addbtn"><p><a href="addproducts.php" class="btn btn-success">Add new </button> </a></p></div>
<form method="get">
<div class="input-group mb-3">
<input type="text" class="form-control" placeholder="Search Product" aria-label="Recipient" name="search" value="'.$search.'">
<div class="input-group-append">
  <button class="btn btn-outline-secondary" type="submit">Search</button>
</div>
</div>
</form></div>';





#table
echo'<div class="tablecatbox"><div class="tablecat">  <table class="table table-striped">
<div class="table-responsive">
<thead>
  <tr>
    <th scope="col" >Id</th>
    <th scope="col" >Name</th>
    <th scope="col">Image</th>
    <th scope="col">Description</th>
    <th scope="col">Price</th>
    <th scope="col"></th>
    <th scope="col"></th>
  </tr>
</thead><tbody>';

foreach($products as $i){
 echo '       <tr>
           <th scope="row">'.$i['product_id'].'</th>
            
            <td>'.$i['product_name'].'</td>
            <td><img class="catadd" src="'.$i['product_main_image'].'"></td>   
            <td>'.$i['product_description'].'</td>
            <td>'.$i['product_price'].'JD</td>       
            <td><a href="updateproduct.php?id='.$i['product_id'].'" type="button" class="btn btn-primary">edit</a></td>
            <td>
           <form method="post" action="deleteproduct.php">
           <input type="hidden" name="id" value="'.$i['product_id'].'">
            <button type="submit" class="btn btn-danger">delete</button>
            </form>
            </td>
          </tr>
          ';
}
       echo   '</tbody>    </table></div></div></div>';





?>


<?php include '../includes/templates/footeradmin.php';?>


