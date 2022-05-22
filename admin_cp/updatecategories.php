

<?php include '../includes/templates/navbaradmin.php';
require_once('init.php');
?>
<?php   include '../layout/table.php';?>





<?php

#read id from link number
$id=$_GET['id']??null;

if(!$id){
    headear('Location: categories.php');

exit;}


$statement=$db->prepare('SELECT * FROM categories WHERE category_id=:id');
$statement->bindValue(':id',$id);
$statement->execute();
$products=$statement->fetch(PDO::FETCH_ASSOC);



#add errors in arrey
$errors =[];


$name=$products['category_name'];

#for sure use post
if($_SERVER['REQUEST_METHOD']=='POST'){
    $name=$_POST['name'];
    
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
$statement=$db->prepare("UPDATE categories SET category_name=:name , category_image=:image WHERE category_id=:id");
 $statement->bindValue(':name',$name);
 $statement->bindValue(':image',$imagePath);
 $statement->bindValue(':id',$id);
 $statement->execute();

//   header('Location: categories.php');
  
echo '<script>
window.location.href="./categories.php"

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














echo '<div class="updatecatformbox"><div class="updateform">';

#cheack errors

if (empty(!$errors)){
    echo '<div class="alert alert-danger">';
    foreach($errors as$error){
        echo '<div>'.$error.'</div>
        </div>';}}

echo '<span><div class="headerupdate"><h1>Update Category</h1></div></span>
';

if ($products['category_image']){
echo '<img src="'.$products['category_image'].'"class="update">';}
 






?>


 <form  method="post" enctype="multipart/form-data">
 <div class="form-group">
      <label>Category Name</label>
      <input  type="text" class="form-control" name="name">
    </div>
    <div class="form-group">
      <label>Category Image</label> <br>
      <input type="file" name="image" >
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  
<a href="categories.php"class="btn btn-secondary">Go back to categories</a>

  </form></div></div>
  


  <?php include '../includes/templates/footeradmin.php';?>


