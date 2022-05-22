
<?php include '../includes/templates/navbaradmin.php';
require_once('init.php');
?>
<?php   include '../layout/table.php';?>




<?php
#add errors in arrey
// $errors =[];



#for sure use post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo 'hello';


    #create folder
    if (!is_dir('imagescat')) {
        mkdir('imagescat');
    }

    #verification from error

    // if (empty($errors)){  


    $image = $_FILES['image']  ?? null;

    $imagePath = '';

    if ($image && $image['tmp_name']) {
        $imagePath = 'imagescat/' . randomString(8) . '/' . $image['name'];
        mkdir(dirname($imagePath));

        move_uploaded_file($image['tmp_name'], $imagePath);
        // }




        #for not add empty value;
        $statement = $db->prepare("INSERT INTO admins (admin_name,admin_image,admin_email,admin_password)
VALUES (:name,:image,:email,:password)
");
        $statement->bindValue(':name', $name);
        $statement->bindValue(':image', $imagePath);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->execute();

        // header('Location: categories.php');

        // echo '<script>
        // window.location.href="./admin_profile.php"

        // </script>';
    }
}


#function for give random name to image
function randomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }
    return $str;
}
?>




<form method="post">
    <div class="formcont">
        <div class="formbox">
            <div class="updateform">
                <div class="container rounded bg-white mt-5 mb-5 ">
                    <div class="row">
                        <div class="col-md-3 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" src="<?php $image ?>"><span class="font-weight-bold"><?php $name ?></span><span class="text-black-50"><?php $email ?></span><span>
                                </span></div>
                        </div>
                        <div class="col-md-5 border-right">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Profile Settings</h4>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6"><label class="labels">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="first name">
                                    </div>
                                    <div class="col-md-6"><label class="labels">Lastname</label>
                                        <input type="text" class="form-control" placeholder="lastname">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12"><label class="labels">PhoneNumber</label><input type="text" class="form-control" placeholder="enter phone number"></div>
                                    <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control" placeholder="enter address"></div>
                                    <div class="form-group">
                                        <div class="col-md-12"><label class="labels">Add Image</label> <input type="file"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 py-5">
                                <div class="col-md-12"><label class="labels">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="enter email ">
                                </div>
                                <div class="col-md-12"><label class="labels">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="password">
                                </div>
                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</form>



















<?php include '../includes/templates/footeradmin.php';?>
