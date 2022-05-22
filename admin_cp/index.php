<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location:dashboard.php');
    exit;
}
$noNav='';
$pageTitle='LOGIN';
require_once('init.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $statement = $db->prepare('SELECT user_name, user_password, user_id FROM users WHERE user_name = :username AND user_password = :password AND groupID = 1 LIMIT 1');
    $statement->bindValue(':username',$username);
    $statement->bindValue(':password',$password);
    $statement->execute();
    $count = $statement->rowCount();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    if ($count > 0) {
        $id = $rows[0]['userID'];
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $id;
        header('Location:dashboard.php');
        exit;
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form class="box" action="<?php $_SERVER['PHP_SELF'];?>" method = 'POST'>
                    <h1>Login</h1>
                    <p class="text-muted"> Please enter your username and password</p>
                    <input type="text" name="username" placeholder="Username"> 
                    <input type="password" name="password" placeholder="Password"> 
                    <input type="submit" name="" value="Login" href="#">
                    <div class="col-md-12">
                        <ul class="social-network social-circle">
                            <li><a href="#" class="icoFacebook" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" class="icoGoogle" title="Google +"><i class="fab fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once($tmp . 'footer.php');
?>