

<?php include '../includes/templates/navbaradmin.php';
require_once('init.php');
?>
<?php   include '../layout/table.php';?>

<?php

#read id from link number
$id=$_GET['id']??null;

if(!$id){
    headear('Location: products.php');

exit;}


$statement=$db->prepare('SELECT * FROM products WHERE product_id=:id');
$statement->bindValue(':id',$id);
$statement->execute();
$products=$statement->fetch(PDO::FETCH_ASSOC);



#add errors in arrey
$errors =[];


$name=$products['product_name'];









#for sure use post
if($_SERVER['REQUEST_METHOD']==='POST'){
$name=$_POST['name'];
$description=$_POST['description'];
$price=$_POST['price'];
$dropdown=$_POST['dropdown'];


if(!$name){
   $errors[]='Name is required!'; 
}
if(!$price){
    $errors[]='Price is required!'; 
 }



#create folder
if (!is_dir('imagescat')){
mkdir('imagescat');
}

#verification from error

if (empty($errors)){  
    

$image = $_FILES['image']  ?? null;

$imagePath= $products['image'];



        if ($products['image']){
            unlink($products['image']);
        }

    if ($image && $image['tmp_name']){

$imagePath = 'imagescat/'.randomString(8).'/'.$image['name'];
mkdir(dirname($imagePath));

        move_uploaded_file($image['tmp_name'], $imagePath);
    }

    
    
    
 #for not add empty value;
$statement=$db->prepare("UPDATE products SET product_name=:name , product_main_image=:image, product_description=:description, product_price=:price, product_category_id=:dropdown WHERE product_id=:id");
 $statement->bindValue(':name',$name);
 $statement->bindValue(':image',$imagePath);
 $statement->bindValue(':description',$description);
 $statement->bindValue(':price',$price);
 $statement->bindValue(':id',$id);
 $statement->bindValue(':dropdown',$dropdown);
 $statement->execute();

// header('Location: products.php');

echo '<script>
window.location.href="./products.php"

</script>';
}}


#function for give random name to image
function randomString($n){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }
    return $str;
}





echo '<div class="updateprodformcont"><div class="updateprodformbox"><div class="updateform">';

#cheack errors
if (empty(!$errors)){
  foreach($errors as $error){
      echo '<div class= alertproadd>'.$error.'</div>
      ';}}

      
    echo '<span><div class="headerupdate"><h1>Update Product</h1></div></span>
      ';

if ($products['product_main_image']){
echo '<img src="'.$products['product_main_image'].'"class="update">';}









$statement =$db->prepare('SELECT * FROM categories  ORDER BY category_id  ASC');


$statement->execute();
$products= $statement->fetchAll(PDO::FETCH_ASSOC);

?>



 <form  method="post" enctype="multipart/form-data">
 <div class="form-group">
      <label>Product Name</label>
      <input type="text" class="form-control" name="name">
    </div>
    <div class="form-group">
      <label>Product Image</label> <br>
      <input type="file" name="image" >
    </div>
    <div class="form-group">
  <label>Choose category</label> <br>
  <select name="dropdown" >
  <?php foreach ($products as $value) : ?>
                        <option value="<?php echo $value['category_id']; ?>"><?php echo $value['category_name']; ?></option>
                    <?php endforeach ?>
  </select>
</div>
    <div class="form-group">
      <label>Description</label>
      <input type="text" class="form-control" name="description">
    </div>
    <div class="form-group">
      <label>Product price</label>
      <input type="text" class="form-control" name="price">
    </div>
  
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="products.php"class="btn btn-secondary">Go back to products</a>
  </form></div></div></div>
  









  <?php include '../includes/templates/footeradmin.php';?>


