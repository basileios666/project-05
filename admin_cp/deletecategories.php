
<?php
require_once('init.php');
?>


<?php


$id=$_POST['id']??null;

if(!$id){
    headear('Location: categories.php');

exit;}

$statement=$db->prepare('DELETE FROM categories WHERE category_id=:id');
$statement->bindValue(':id',$id);
$statement->execute();

header('Location: categories.php');
?>