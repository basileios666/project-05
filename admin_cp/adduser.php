

<?php include '../includes/templates/navbaradmin.php';
require_once('init.php');
?>
<?php   include '../layout/table.php';?>

<?php






#add errors in arrey
$errors =[];


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

$imagePath='';

    if ($image && $image['tmp_name']){
$imagePath = 'imagescat/'.randomString(8).'/'.$image['name'];
mkdir(dirname($imagePath));

        move_uploaded_file($image['tmp_name'], $imagePath);
    }

    
    
    
 #for not add empty value;
$statement=$db->prepare("INSERT INTO users (user_name,user_image,user_email,user_mobile)
VALUES (:name,:image,:orders,:info)
");
 $statement->bindValue(':name',$name);
 $statement->bindValue(':image',$imagePath);
 $statement->bindValue(':orders',$orders);
 $statement->bindValue(':info',$info);
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













echo '<div class="addprodformcont"><div class="addprodformbox"><div class="addcatform"><form  method="post" enctype="multipart/form-data">';
#cheack errors
if (empty(!$errors)){
    echo '<div class="alert alert-danger">';
    foreach($errors as$error){
        echo '<div>'.$error.'</div>
        </div>';}}



echo '<form  method="post" enctype="multipart/form-data">
<div class="form-group">
  <label>Product name</label>
  <input type="text" class="form-control" name="name">
</div>
<div class="form-group">
  <label>Product Image</label> <br>
  <input type="file" name="image" >
</div>
<div class="form-group">
  <label>User orders</label>
  <input type="text" class="form-control" name="orders">
</div>
<div class="form-group">
  <label>User information</label>
  <input type="text" class="form-control" name="info">
</div>

<button type="submit" class="btn btn-primary">Submit</button>
</form></div></div></div>';



  





?>
<?php include '../includes/templates/footeradmin.php';?>


