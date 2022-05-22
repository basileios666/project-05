
<?php include '../includes/templates/navbaradmin.php';
require_once('init.php');
?>
<?php   include '../layout/table.php';?>

<?php



$search=$_GET['search']??'';
if ($search){
  $statement =$db->prepare('SELECT * FROM users WHERE user_name LIKE :name ORDER BY user_id ASC');
  $statement->bindValue(':name',"%$search%");
}else{
  $statement =$db->prepare('SELECT * FROM users ORDER BY user_id ASC');
}


$statement->execute();
$products= $statement->fetchAll(PDO::FETCH_ASSOC);




#search
echo '<div class="searchbox">
<div class="addbtn"><p> <a href="adduser.php" class="btn btn-success">Add new </button> </a></p></div>
<form method="get">
<div class="input-group mb-3">
<input type="text" class="form-control" placeholder="Search Category" aria-label="Recipient" name="search" value="'.$search.'">
<div class="input-group-append">
  <button class="btn btn-outline-secondary" type="submit">Search</button>
</div>
</div>
</form></div>';





#table
echo' <div class="tablecatbox"><div class="tablecat"> <table class="table table-striped">
<div class="table-responsive">
<thead>
  <tr>
    <th scope="col" >Id</th>
    <th scope="col" >Name name</th>
    <th scope="col">Image</th>
    <th scope="col">Orders</th>
    <th scope="col">User information</th>
    <th scope="col"></th>
    <th scope="col"></th>
  </tr>
</thead><tbody>';

foreach($products as $i){
 echo '       <tr>
            <th scope="row">'.$i['user_id'].'</th>
            
            <td>'.$i['user_name'].'</td>
            <td><img class="catadd" src="'.$i['user_image'].'"></td>          
           
            <td>'.$i['user_email'].'</td>
            <td>'.$i['user_mobile'].'</td>       
            <td><a href="updateuser.php?id='.$i['user_id'].'" type="button" class="btn btn-primary">edit</a></td>
            <td>
           <form method="post" action="deleteuser.php">
           <input type="hidden" name="id" value="'.$i['user_id'].'">
            <button type="submit" class="btn btn-danger">delete</button>
            </form>
            </td>
          </tr>
          ';}
        echo  '</tbody>    </table></div></div></div>';





?>


<?php include '../includes/templates/footeradmin.php';?>


