<?php
session_start();
require_once '../admin_cp/init.php';
$productId = $_GET['id'];

$select = "SELECT product_id,product_name, product_price, product_description, product_main_image, product_desc_image_1, product_desc_image_2, product_desc_image_3, on_sale, product_category_id, product_tag, product_price * sale_factor / 100 as sale_price FROM `products`";

$statement = $db->prepare($select . 'WHERE product_id = :id');
$statement->bindValue(':id', $productId);
$statement->execute();
$fetched = $statement->fetchAll(PDO::FETCH_ASSOC);
$product = $fetched[0];
$cat = $product['product_category_id'];


//fetch related products
$statement2 = $db->prepare($select . 'WHERE product_category_id = :cat AND product_id != :id');
$statement2->bindValue(':cat' , $cat);
$statement2->bindValue(':id' , $productId);
$statement2->execute();
$relatedProducts = $statement2->fetchAll(PDO::FETCH_ASSOC);

//fetch comments
$statement3 = $db->prepare('SELECT comment,users.user_image,comment_date,comment_rate, comment_date, products.product_name , users.user_name FROM comments JOIN users ON comments.comment_user_id = users.user_id JOIN products ON comments.comment_product_id = products.product_id WHERE product_id = :id ORDER BY comment_rate LIMIT 5');
$statement3->bindvalue(':id', $productId);
$statement3->execute();
$comments = $statement3->fetchAll(PDO::FETCH_ASSOC);

//add comment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $added_comment = $_POST['added'];
    $statement4 = $db->prepare('INSERT INTO `comments` (`comment`, `comment_product_id`, `comment_user_id`) VALUES (:comment, :product_id, :user_id)');
    $statement4->bindValue(':comment', $added_comment);
    $statement4->bindValue(':product_id', $productId);
    $statement4->bindValue(':user_id', '35');
    $statement4->execute();
    header("Refresh:0");
}

$catStatment = $db->prepare('SELECT c.category_id,c.category_name,s.sub_category_id,s.sub_category_name FROM categories c LEFT JOIN sub_categories s ON c.category_id = s.category_id ORDER BY c.category_name;');
$catStatment->execute();
$categories = $catStatment->fetchAll(PDO::FETCH_ASSOC);
$subCatStatment = $db->prepare('SELECT * FROM sub_categories ORDER BY sub_category_name');
$subCatStatment->execute();
$subCategories = $subCatStatment->fetchAll(PDO::FETCH_ASSOC);
$filt = uniqueCategory($categories);

include($tmp . 'navbar.php');
?>
        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="../admin_cp/<?php echo $product['product_main_image'];?>" alt="..." /></div>
                    <div class="col-md-6">
                        <h1 class="display-5 fw-bolder"><?php echo $product['product_name']?></h1>
                        <div class="fs-5 mb-5">
							<?php if($product['on_sale']){?>
                            <span class="text-decoration-line-through">JOD <?php echo round($product['product_price'],2)?></span>
                            <span>JOD <?php echo round($product['sale_price'],2)?></span>
							<?php
									}
								else {
									echo '<span>' . 'JOD ' . round($product['product_price'],2) . '</span>';
								}
							?>
                        </div>
                        <p class="lead"><?php echo $product['product_description']?></p>
                        <div class="d-flex">
                            <form action="add.php?id=<?php echo $productId?>" class='d-inline' >
                            <input type="hidden" name="id" value='<?php echo $productId?>'>
                            <input class="form-control text-center me-3 d-inline" id="inputQuantity" type="num" value="1" name='qty' style="max-width: 3rem"/>
                            <a href="add.php?id=<?php echo $productId?>">
                            <button class="btn btn-outline-dark flex-shrink-0"  type="submit">
                                <i class="fa-solid fa-cart-plus" title='Add to cart'></i>
                                Add to cart
                            </button>
                                </form>
                                </a>
                        </div>
                    </div>
                </div>
            </div>


                   <!-- comments section -->
                   <div class="container mt-5 mb-5">
    <div class="row height d-flex align-items-center">
        <div class="col-md-7">
            <div class=" c-card">
                <div class="p-3">
                    <h6>Top Comments</h6>
                </div>
                <div class="mt-3 d-flex flex-row align-items-center p-3 form-color"> <img src="https://i.imgur.com/zQZSWrt.jpg" width="50" class="rounded-circle mr-2"> 
                <form action="" method='POST' class='add-comment'>
                <input type="text" name='added' class="form-control form-comment " placeholder="Enter your comment...">
                <input type="submit" value="Go" class='btn btn-primary go'>
                </form>
                </div>
                <div class="mt-2">
                    <!-- looping over the comments -->
                    <?php foreach ($comments as $comment): ?>
                    <div class="d-flex flex-row p-3"> <img src="<?php echo $comment['user_image']?>" width="40" height="40" class="rounded-circle mr-3">
                        <div class="w-100 c-desc">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-row align-items-center"> <span class="mx-2"><?php echo $comment['user_name'] ?></span> <small class="c-badge mx-2" >Top Comment</small> </div> <small><?php echo $comment['comment_date'] ?></small>
                            </div>
                            <p class="text-justify comment-text my-3 mx-2"> <?php echo $comment['comment'] ?></p>
                        </div>
                    </div>
                    <?php endforeach;?>
                    <!-- looping over the comments -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- comments section end -->


        </section>
		<!-- Product section-->
        
		<!-- Related items section-->
    <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder d-flex justify-content-center mb-4">Related products</h2>
                <div class="row  gx-4 gx-lg-6 row-cols-1 row-cols-md-3 row-cols-xl-4 justify-content-center">
					<?php foreach ($relatedProducts as $relatedProduct):?>
						<div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="<?php echo $relatedProduct['product_main_image'] ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $relatedProduct['product_name'] ?></h5>
                                    <!-- Product price-->
                                    <?php if($relatedProduct['on_sale']){?>
										<div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
										<span class="text-decoration-line-through">JOD <?php echo round($relatedProduct['product_price'],2)?></span>
										<span>JOD <?php echo round($relatedProduct['sale_price'],2)?></span>
									<?php
									}
								else {
									echo '<span>' . 'JOD ' . round($relatedProduct['product_price'],2) . '</span>';
								}
							?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="view.php?id=<?php echo $relatedProduct['product_id'] ?>">View</a></div>
                            </div>
                        </div>
                    </div>
					<?php endforeach; ?>
                    
                </div>
            </div>
        </section>
		<!-- Related items section-->
 
<?php
include_once '../includes/templates/footer.php';
?>