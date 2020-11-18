<?php
    // id,images,shortDis,rating,review,manufacturer,thumbnail,price
    require_once('config/db.php');
    require_once('config/config.php');
    session_start();
    $_SESSION['userId'] = 2;
    $file = 'images/';
    if(isset($_REQUEST['id'])){
        $id = mysqli_real_escape_string($conn,$_REQUEST['id']);
    } else {
        header('Location: ' . ROOT_URL . 'homepage.php');
    }
 
    $query = "SELECT * FROM product_details WHERE id=" . $id;
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
    $images = explode(',', $product['images']);
    $tags = explode(',', $product['tags']);
    $features = explode('.', $product['longDis']);
    $avail = $product['quantity']>5 ? 'In Stock': 'Out of Stock';
    // print_r($product);

    $query = "SELECT id,shortDis,rating,review,manufacturer,thumbnail,price FROM product_details WHERE category LIKE '%" . $tags[0] . "%' AND id!=" . $product['id'] . " LIMIT 4";
    $result = mysqli_query($conn, $query);
    $similar_products = mysqli_fetch_all($result, MYSQL_ASSOC);    

    mysqli_free_result($result);
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/productpage.css">
    <link rel="stylesheet" href="css/Font-Awesome/all.min.css">
    <title>Document</title>
</head>
<body>
    <!-- Navbar -->
    <?php include('include/navbar.php'); ?>

    <div class="container">
        <div class="wardrob">
            <section class="prod-img">
                <img src=<?php echo $file . $images[0] ?> alt="" class="main-img">
                <div class="all-img">
                    <img src=<?php echo $file . $images[0] ?> class="sm-img">
                    <img src=<?php echo $file . $images[1] ?> class="sm-img">
                    <img src=<?php echo $file . $images[2] ?> class="sm-img">
                    <img src=<?php echo $file . $images[3] ?> class="sm-img">
                </div>
            </section>
    
            <section class="prod-detail">
                <h1 class="title"><?php echo $product['name'] ?></h1>
    
                <div class="review">
                    <p>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span class="count">(<?php echo $product['review'] ?>)</span> Reviews
                    </p>
                </div>
                <h2 class="price">$<?php echo $product['price'] ?></h2>
                <div class="status">
                    <div class="avalibility">
                        <strong>Avalibility : </strong>
                        <span><?php echo $avail ?></span>
                    </div>
                    <div class="tags">
                        <strong>Tags : </strong>
                        <span>
                            <?php foreach($tags as $tag): ?>
                                <a href=<?php echo ROOT_URL . "categorypage.php?s=" . $tag  ?>><?php echo $tag ?></a>,
                            <?php endforeach; ?>
                        </span>
                    </div>
                </div>
    
                <div class="description">
                    <p><?php echo $product['shortDis'] ?></p>
                    <ul class="features">
                            <?php foreach($features as $feature): ?>
                                <li><?php echo $feature ?></li>
                            <?php endforeach; ?>
                    </ul>
                </div>
                
                <form>
                    <?php if($avail == 'In Stock'): ?>
                        <div class="customize">
                            <?php if($product['color'] != NULL): ?>
                                <div class="option">
                                    <label for="color-select"><h4>Color</h4></label>
                                    <select name="color" id="color-select">
                                        <?php 
                                            $colors = explode(',', $product['color']);
                                            foreach($colors as $color): ?>
                                                <option value="<?php echo $color ?>"><?php echo $color ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?>
                            <?php if($product['size'] != NULL): ?>
                                <div class="option">
                                    <label for="size-select"><h4>Size</h4></label>
                                    <select name="size" id="size-select">
                                        <?php 
                                            $colors = explode(',', $product['size']);
                                            foreach($sizes as $size): ?>
                                                <option value="<?php echo $size ?>"><?php echo $size ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?>
                            
                            <div class="option">
                                <label for="qty-select"><h4>Qty</h4></label>
                                <input type="number" id="qty-select" value="1" max="<?php echo $product['quantity']>50 ? '50' : $product['quantity'] ?>">
                            </div>     
                        </div>
                    <?php endif; ?>
        
                    <div class="buying-option">
                        <?php if($avail == 'In Stock'): ?>
                            <a id="add-to-cart" class="btn" onclick="addToCart(<?php echo $product['id'] ?>)">Add to Cart</a>
                        <?php endif; ?>
                        <a id="add-to-wish" class="btn" onclick="addToWishlist(<?php echo $product['id'] ?>)"><i class="far fa-heart"></i> Add to Wishlist</a>
                    </div>
                </form>
            </section>
        </div>


    <!-- Similar Products -->
        
        <?php if(count($similar_products)>0):?>
            <br><br><br>
            <h2>Similar Products</h2>
            <br><br>
            <div class="product-grid">

                <?php foreach($similar_products as $product): ?>
                    <div class="card">
                        <a href=<?php echo ROOT_URL . "productpage.php?id=" . $product['id'] ?>>
                            <img src=<?php echo $file . $product['thumbnail'] ?> width="196px" height="196px">
                            <p class="description"><?php echo $product['shortDis'] ?></p>
                        </a>
                        <p>by <span class="product-company"><?php echo $product['manufacturer'] ?></span></p>
                        <div>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span class="count">(<?php echo $product['review'] ?>)</span>
                            </div>
                            <br>
                            <div class="price">$<?php echo $product['price'] ?></div>
                        </div>
                    </div>  
                <?php endforeach; ?>

            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php include('include/footer.php'); ?>


    
    <script src="css/productpage.js"></script>
</body>
</html>