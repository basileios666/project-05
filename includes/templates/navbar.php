<?php 
//fetching categories and sub categories
$catStatment = $db->prepare('SELECT c.category_id,c.category_name,s.sub_category_id,s.sub_category_name FROM categories c LEFT JOIN sub_categories s ON c.category_id = s.category_id ORDER BY c.category_name;');
$catStatment->execute();
$categories = $catStatment->fetchAll(PDO::FETCH_ASSOC);
$subCatStatment = $db->prepare('SELECT * FROM sub_categories ORDER BY sub_category_name');
$subCatStatment->execute();
$subCategories = $subCatStatment->fetchAll(PDO::FETCH_ASSOC);
$filt = uniqueCategory($categories);

?>

<nav class="navbar navbar-expand-lg bg-transparent navbar-light navbar-airy bg-fixed-white">
        <div class="container-fluid">  
          <!-- Navbar Header  --><a class="navbar-brand" href="index.html"><svg class="navbar-brand-svg" viewBox="0 0 65 16" width="85" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path class="navbar-brand-svg-text" d="M5.72266 18.1562C4.88281 18.1562 4.08529 18.0033 3.33008 17.6973C2.58138 17.3913 1.94661 16.9355 1.42578 16.3301C0.911458 15.7181 0.582682 14.9759 0.439453 14.1035L2.90039 13.4785C2.98503 14.2988 3.28776 14.9173 3.80859 15.334C4.33594 15.7507 4.98698 15.959 5.76172 15.959C6.23698 15.959 6.64714 15.8841 6.99219 15.7344C7.33724 15.5781 7.59766 15.3665 7.77344 15.0996C7.94922 14.8327 8.03711 14.5332 8.03711 14.2012C8.03711 13.804 7.91341 13.4655 7.66602 13.1855C7.42513 12.9056 7.1224 12.6745 6.75781 12.4922C6.39323 12.3099 5.89193 12.0918 5.25391 11.8379C4.42057 11.5059 3.74674 11.1999 3.23242 10.9199C2.7181 10.6335 2.27539 10.2363 1.9043 9.72852C1.53971 9.2207 1.35742 8.57943 1.35742 7.80469C1.35742 7.01693 1.54948 6.33659 1.93359 5.76367C2.32422 5.18424 2.84505 4.74479 3.49609 4.44531C4.15365 4.14583 4.8763 3.99609 5.66406 3.99609C6.54948 3.99609 7.35677 4.19792 8.08594 4.60156C8.8151 4.9987 9.40755 5.60417 9.86328 6.41797L7.80273 7.67773C7.56185 7.20898 7.24609 6.84766 6.85547 6.59375C6.46484 6.33333 6.03841 6.20312 5.57617 6.20312C5.25065 6.20312 4.95443 6.26497 4.6875 6.38867C4.42708 6.51237 4.21875 6.68815 4.0625 6.91602C3.91276 7.13737 3.83789 7.39128 3.83789 7.67773C3.83789 8.0293 3.95182 8.32878 4.17969 8.57617C4.40755 8.82357 4.69401 9.0319 5.03906 9.20117C5.39062 9.37044 5.86914 9.57227 6.47461 9.80664C7.33398 10.1387 8.0306 10.4512 8.56445 10.7441C9.09831 11.0371 9.55729 11.4473 9.94141 11.9746C10.3255 12.502 10.5176 13.1693 10.5176 13.9766C10.5176 14.8229 10.3027 15.5618 9.87305 16.1934C9.44987 16.8249 8.8737 17.3099 8.14453 17.6484C7.41536 17.987 6.60807 18.1562 5.72266 18.1562ZM16.8906 4.20117H26.0703V6.47656H19.3711V9.96289H25.6113V12.2383H19.3711V15.6562H26.0703V18H16.8906V4.20117ZM33.0586 4.20117H35.5391V15.6562H41.4375V18H33.0586V4.20117ZM47.4492 4.20117H49.9297V15.6562H55.8281V18H47.4492V4.20117Z" transform="translate(0 -3)" fill="#212529"/>
<path class="text-primary" d="M62.0254 15.4219H64.418V18H62.0254V15.4219Z" transform="translate(0 -3)" fill="#9A6EE2"/>
</svg></a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
          <!-- Navbar Collapse -->
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item dropdown"><a class="nav-link dropdown-toggle active" id="homeDropdownMenuLink" href="index.html" data-bs-target="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Home   </a>
                <div class="dropdown-menu dropdown-menu-animated" aria-labelledby="homeDropdownMenuLink"><a class="dropdown-item" href="index5.html">Slider + broken grid <span class="badge badge-info-light ms-1">New</span>    </a><a class="dropdown-item" href="index.html">Fullscreen home + Lookbook</a><a class="dropdown-item" href="index2.html">Split-screen home</a><a class="dropdown-item" href="index3.html">Classic home</a><a class="dropdown-item" href="index4.html">Parallax sections <span class="badge badge-info-light ms-1">New</span></a></div>
              </li>
              <li class="nav-item dropdown"><a class="nav-link dropdown-toggle " id="categoryDropdownMenuLink" href="category.html" data-bs-target="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
                <div class="dropdown-menu dropdown-menu-animated" aria-labelledby="categoryDropdownMenuLink"><a class="dropdown-item" href="category.html">Category - left sidebar   </a><a class="dropdown-item" href="category-right.html">Category - right sidebar   </a><a class="dropdown-item" href="category-no-sidebar.html">Category - no sidebar   </a><a class="dropdown-item" href="category-full.html">Category - full width   </a><a class="dropdown-item" href="category-masonry.html">Category - masonry items   </a><a class="dropdown-item" href="category-banner.html">Category - w/ banner   </a><a class="dropdown-item" href="detail.html">Product detail   </a><a class="dropdown-item" href="detail-2.html">Product detail - v.2   </a><a class="dropdown-item" href="detail-3.html">Product detail - v.3 <span class="badge badge-warning ms-1">New</span>   </a>
                </div>
              </li>
              <!-- Megamenu-->
              <li class="nav-item dropdown position-static"><a class="nav-link dropdown-toggle " href="#" data-bs-toggle="dropdown">Categories</a>
                <div class="dropdown-menu dropdown-menu-animated megamenu py-lg-0">
                  <div class="row">
                    <div class="col-lg-9">
                      <div class="row p-3 pe-lg-0 ps-lg-5 pt-lg-5">
                      
                          <!-- Megamenu list-->
                          <?php
                          foreach ($filt as $category) {
                          if ($category['sub_category_id']) {?>
                          <div class="col-lg-3">
                          <h6 class="text-uppercase"><a href="http://localhost/project-test/pages/sub-categories.php?category=<?php echo $category['category_name']?>&id=<?php echo $category['category_id']?>"><?php echo $category['category_name'] ?></a></h6>
                          <ul class="megamenu-list list-unstyled">
                          <?php foreach ($subCategories as $subCategory) {?>
                                        <?php if ($category['category_id'] === $subCategory['category_id']) {?>
                            <li class="megamenu-list-item"><a class="megamenu-list-link" href="http://localhost/project-test/pages/sub-categories.php?category=<?php echo $category['category_name']?>&id=<?php echo $category['category_id']?>"> <?php echo $subCategory['sub_category_name']?>  </a></li>
                            <?php
                                    }
                                    } 
                                    ?>
                          </ul>
                          </div>
                          <?php 
                        }else{?>
                                                  <div class="col-lg-3">
                        <h6 class="text-uppercase"><a href="http://localhost/project-test/pages/sub-categories.php?category=<?php echo $category['category_name']?>&id=<?php echo $category['category_id']?>"><?php echo $category['category_name'] ?></a></h6>
                        </div>
                        <?php
                            }
                                }
                    ?>
                      <div class="row megamenu-services d-none d-lg-flex">
                        <div class="col-xl-3 col-lg-6 d-flex">
                          <div class="megamenu-services-item">
                            <svg class="svg-icon megamenu-services-icon">
                              <use xlink:href="#delivery-time-1"> </use>
                            </svg>
                            <div>
                              <h6 class="text-uppercase">Free shipping &amp; return</h6>
                              <p class="mb-0 text-muted text-sm">Free Shipping over $300</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 d-flex">
                          <div class="megamenu-services-item">
                            <svg class="svg-icon megamenu-services-icon">
                              <use xlink:href="#money-1"> </use>
                            </svg>
                            <div>
                              <h6 class="text-uppercase">Money back guarantee</h6>
                              <p class="mb-0 text-muted text-sm">30 Days Money Back</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 d-flex">
                          <div class="megamenu-services-item">
                            <svg class="svg-icon megamenu-services-icon">
                              <use xlink:href="#customer-support-1"> </use>
                            </svg>
                            <div>
                              <h6 class="text-uppercase">020-800-456-747</h6>
                              <p class="mb-0 text-muted text-sm">24/7 Available Support</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 d-flex">
                          <div class="megamenu-services-item">
                            <svg class="svg-icon megamenu-services-icon">
                              <use xlink:href="#secure-payment-1"> </use>
                            </svg>
                            <div>
                              <h6 class="text-uppercase">Secure Payment</h6>
                              <p class="mb-0 text-muted text-sm">Secure Payment</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 d-none d-lg-block position-relative"><img class="bg-image" src="https://d19m59y37dris4.cloudfront.net/sell/2-0/img/megamenu.jpg" alt=""></div>
                  </div>
                </div>
              </li>
              <!-- /Megamenu end-->
              <!-- Multi level dropdown    -->
              <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <ul class="dropdown-menu dropdown-menu-animated" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" id="navbarDropdownMenuLink2" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown link</a>
                    <ul class="dropdown-menu dropdown-menu-animated" aria-labelledby="navbarDropdownMenuLink2">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" id="navbarDropdownMenuLink3" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Another action</a>
                        <ul class="dropdown-menu dropdown-menu-animated" aria-labelledby="navbarDropdownMenuLink3">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Action</a></li>
                        </ul>
                      </li>
                      <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" id="navbarDropdownMenuLink4" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Another action</a>
                        <ul class="dropdown-menu dropdown-menu-animated" aria-labelledby="navbarDropdownMenuLink4">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Action</a></li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" id="navbarDropdownMenuLink5" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown link</a>
                    <ul class="dropdown-menu dropdown-menu-animated" aria-labelledby="navbarDropdownMenuLink5">
                      <li><a class="dropdown-item" href="#">Action                    </a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <!-- Multi level dropdown end-->
              <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a>
              </li>
              <li class="nav-item dropdown"><a class="dropdown-toggle nav-link " id="docsDropdownMenuLink" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Docs</a>
                <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end" aria-labelledby="docsDropdownMenuLink">
                  <h6 class="dropdown-header fw-normal">Documentation</h6><a class="dropdown-item" href="docs/docs-introduction.html">Introduction </a><a class="dropdown-item" href="docs/docs-directory-structure.html">Directory structure </a><a class="dropdown-item" href="docs/docs-gulp.html">Gulp </a><a class="dropdown-item" href="docs/docs-customizing-css.html">Customizing CSS </a><a class="dropdown-item" href="docs/docs-credits.html">Credits </a><a class="dropdown-item" href="docs/docs-changelog.html">Changelog </a>
                  <div class="dropdown-divider"></div>
                  <h6 class="dropdown-header fw-normal">Components</h6><a class="dropdown-item" href="docs/components-bootstrap.html">Bootstrap </a><a class="dropdown-item" href="docs/components-sell.html">Theme </a><a class="dropdown-item" href="component-variants/header.html">Header variants <span class="badge bg-warning ms-1">New</span> </a>
                </div>
              </li>
            </ul>
            <div class="d-flex align-items-center justify-content-between justify-content-lg-end mt-1 mb-2 my-lg-0">
              <!-- Search Button-->
              <div class="nav-item navbar-icon-link" data-bs-toggle="search">
                <svg class="svg-icon">
                  <use xlink:href="#search-1"> </use>
                </svg>
              </div>
              <!-- User Not Logged - link to login page-->
              <div class="nav-item"><a class="navbar-icon-link" href="customer-login.html">
                  <svg class="svg-icon">
                    <use xlink:href="#male-user-1"> </use>
                  </svg><span class="text-sm ms-2 ms-lg-0 text-uppercase text-sm fw-bold d-none d-sm-inline d-lg-none">Log in    </span></a></div>
              <!-- Cart Dropdown-->
              <div class="nav-item dropdown"><a class="navbar-icon-link d-lg-none" href="http://localhost/project-test/final_page/cart.php"> 
                  <svg class="svg-icon">
                    <use xlink:href="#cart-1"> </use>
                  </svg><span class="text-sm ms-2 ms-lg-0 text-uppercase text-sm fw-bold d-none d-sm-inline d-lg-none">View cart</span></a>
                <div class="d-none d-lg-block"><a class="navbar-icon-link" id="cartdetails" href="http://localhost/project-test/cart.php" data-bs-target="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg class="svg-icon">
                      <use xlink:href="http://localhost/project-test/final_page/cart.php"> </use>
                    </svg>
                    <a href="http://localhost/project-test/final_page/cart.php">
                    <div class="navbar-icon-link-badge"><?php echo $_SESSION['products_count'];?></div></a>
                  <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end p-4" aria-labelledby="cartdetails">
                    <div class="navbar-cart-product-wrapper">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
      <!-- /Navbar -->
<!-- Navbar ends -->