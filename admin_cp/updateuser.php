
<?php include '../includes/templates/navbaradmin.php';
require_once('init.php');
?>
<?php   include '../layout/table.php';?>



<?php

#read id from link number
$id=$_GET['id']??null;

if(!$id){
    headear('Location: user.php');

exit;}


$statement=$db->prepare('SELECT * FROM users WHERE user_id=:id');
$statement->bindValue(':id',$id);
$statement->execute();
$products=$statement->fetch(PDO::FETCH_ASSOC);



#add errors in arrey
$errors =[];


$name=$products['user_name'];









#for sure use post
if($_SERVER['REQUEST_METHOD']==='POST'){
$name=$_POST['name'];
$orders=$_POST['orders'];
$info=$_POST['info'];

if(!$name){
   $errors[]='Name is required!'; 
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
$statement=$db->prepare("UPDATE users SET user_name=:name , user_image=:image, user_email=:orders, user_mobile=:info WHERE user_id=:id");
 $statement->bindValue(':name',$name);
 $statement->bindValue(':image',$imagePath);
 $statement->bindValue(':orders',$orders);
 $statement->bindValue(':info',$info);
 $statement->bindValue(':id',$id);
 $statement->execute();

// header('Location: user.php');
echo '<script>
window.location.href="./user.php"

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






echo '<div class="updateprodformbox"><div class="updateform">';
#cheack errors
if (empty(!$errors)){
  echo '<div class="alert alert-danger">';
  foreach($errors as$error){
      echo '<div>'.$error.'</div>
      </div>';}}

      echo '<span><div class="headerupdate"><h1>Update User</h1></div></span>
      ';



 

if ($products['user_image']){
echo '<img src="'.$products['user_image'].'"class="update">';}



?>

<form  method="post" enctype="multipart/form-data">
 <div class="form-group">
      <label>User Name</label>
      <input type="text" class="form-control" name="name">
    </div>
    <div class="form-group">
      <label>User Image</label> <br>
      <input type="file" name="image" >
    </div>
    <div class="form-group">
      <label>Orders</label>
      <input type="text" class="form-control" name="orders">
    </div>
    <div class="form-group">
      <label>User information</label>
      <input type="text" class="form-control" name="info">
    </div>
  
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="user.php"class="btn btn-secondary">Go back to products</a>
    </form></div></div>
  










<?php include 'C:\xampp\htdocs\php_project\includes\templates\footeradmin.php'?>
