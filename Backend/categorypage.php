<?php

    require_once('config/db.php');
    require_once('config/config.php');
    $search = "";
    $title = "All Products";
    $file = 'images/';

    if(isset($_REQUEST['s'])){
        $search = mysqli_real_escape_string($conn,$_REQUEST['s']);
        $title = $search;

        $query = "SELECT id,shortDis,rating,review,manufacturer,thumbnail,price FROM product_details WHERE category LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR shortDis LIKE '%" . $search . "%' LIMIT 0,2";
        $result = mysqli_query($conn, $query);
        $products = mysqli_fetch_all($result, MYSQL_ASSOC);
        
        $query = "SELECT DISTINCT manufacturer FROM product_details WHERE category LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR shortDis LIKE '%" . $search . "%'";
        $result = mysqli_query($conn, $query);
        $manufacturers = mysqli_fetch_all($result, MYSQL_ASSOC);
    
        $query = "SELECT DISTINCT price FROM product_details WHERE category LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR shortDis LIKE '%" . $search . "%'";
        $result = mysqli_query($conn, $query);
        $prices = mysqli_fetch_all($result, MYSQL_ASSOC);
        $price_array = [];
        $starsTotal = 5;
    
        foreach($prices as $p){
            array_push($price_array, intval($p['price']));
        } 

        if(count($products)>0){
            $max = max($price_array);
            $min = min($price_array);
            $max = 10**(strlen((string)$max));
            $min = 10**(strlen((string)$min)-1);
            $price_range = (int)$max/5;
        }
        
    
        mysqli_free_result($result);
        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/categorypage.css">
    <link rel="stylesheet" href="css/Font-Awesome/all.min.css">
    <title>Category Page</title>
</head>
<body>

    <!-- Navbar -->
    <?php include('include/navbar.php'); ?>


    <?php if(isset($_REQUEST['s'])): ?>

        <?php if(count($products)>0): ?>
            <!-- Filter -->
            <div class="filter">Filter</div>

            <div class="filter-menu">
                <i class="fas fa-arrow-left close-filter"></i>
                <div class="filter-option filter-brand">
                    <h3>brand</h3>
                    <?php for($i=0; $i<count($manufacturers); $i++): ?>
                        <input type="checkbox" class="manufac" name="option<?php echo intval($i) ?>" value="<?php echo $manufacturers[$i]['manufacturer'] ?>">
                        <label for="option<?php echo intval($i) ?>"> <?php echo $manufacturers[$i]['manufacturer'] ?> </label><br>
                    <?php endfor; ?>
                </div>
                
                <div class="filter-option filter-rating">
                    <h3>rating</h3>

                    <?php for($i=1; $i<=5; $i++): ?>
                        <input type="radio" class="rating" name="rating" value="<?php echo intval($i) ?>">
                        <label for="option<?php echo intval($i) ?>"> Above <?php echo intval($i) ?> </label><br>
                    <?php endfor; ?>
                </div>
                
                <div class="filter-option filter-price">
                    <h3>price range</h3>

                    <?php for($i=0, $p=0; $i<5; $i++,$p+=$price_range): ?>
                        <input type="checkbox" class="price" name="option<?php echo intval($i) ?>" value="<?php echo (string)$p . '-' . (string)($p+$price_range) ?>">
                        <label for="option<?php echo intval($i) ?>"> <?php echo '$'.(string)$p . ' - $' . (string)($p+$price_range) ?> </label><br>
                    <?php endfor; ?>
                </div>

                <a class="btn" onclick="getProducts('<?php echo $search ?>','<?php echo ROOT_URL ?>', 1)">Apply</a>
            </div>


            <!-- Content -->
            <div class="container">
                <h1 id="category-header"><?php echo $title ?></h1>

                <div class="product-grid">

                <?php foreach($products as $product): 
                        $starPercentage = ($product['rating'] / $starsTotal) * 100;
                        $starPercentageRounded = round($starPercentage / 10) * 10;
                        $url = $product['thumbnail']; 
                        $headers = @get_headers($url); 
                        if($headers && strpos( $headers[0], '200')) { 
                            $thumbnail = $product['thumbnail'];
                        } 
                        elseif(file_exists($file . $product['thumbnail'])) { 
                            $thumbnail = $file . $product['thumbnail'];
                        } else {
                            $thumbnail = $file . "Packed-Products-Icon.png";
                        }
                    ?>
                    <div class="card">
                        <a href=<?php echo ROOT_URL . "productpage.php?id=" . $product['id'] ?>>
                            <img src=<?php echo $thumbnail ?> width="196px" height="196px">
                            <p class="description"><?php echo $product['shortDis'] ?></p>
                        </a>
                        <p>by <span class="product-company"><?php echo $product['manufacturer'] ?></span></p>
                        <div>
                            <div class="review">
                                <div class="stars-outer">
                                    <div class="stars-inner" style="width: <?php echo $starPercentageRounded ?>%;"></div>
                                </div>
                                <span class="number-rating"><?php echo $product['rating'] ?></span>
                                <span class="count">(<?php echo $product['review'] ?>)</span>
                            </div>
                            <br>
                            <div class="price">$<?php echo $product['price'] ?></div>
                        </div>
                    </div>  
                <?php endforeach; ?>

                </div>
                <br>
                <h3 id="ajax-msg" style="text-align:center;"></h3>
            </div>
            
            <a id="load-more-btn" class="btn" onclick="getProducts('<?php echo $search ?>','<?php echo ROOT_URL ?>', 0)">Show more</a>
        
            <?php else: 
                echo '<h3 id="ajax-msg" style="text-align:center; margin-top: 300px; margin-bottom: 300px">Sorry No Products Available :( </h3>';
            ?>

        <?php endif; ?>                 


    <?php else: 
        $categories = ['Electronics', 'Stationaries', 'Cloths and Garments', 'Utensiles'];
    ?>
        <?php foreach($categories as $category): 
             $query = "SELECT id,shortDis,rating,review,manufacturer,thumbnail,price FROM product_details WHERE category LIKE '%" . $category . "%'  LIMIT 4";
             $result = mysqli_query($conn, $query);
             $products = mysqli_fetch_all($result, MYSQL_ASSOC);
        ?>

            <!-- Content -->
        <div class="container">
            <h1 id="category-header" style="display: inline"><?php echo $category ?>  </h1>
            <a href="<?php echo ROOT_URL . "categorypage.php?s=" . $category ?>" > Find More ></a>
            <br><br>
            <div class="product-grid">

            <?php 
                $starsTotal = 5;
                foreach($products as $product):
                $starPercentage = ($product['rating'] / $starsTotal) * 100;
                $starPercentageRounded = round($starPercentage / 10) * 10;
                    ?>
                    <div class="card">
                        <a href=<?php echo ROOT_URL . "productpage.php?id=" . $product['id'] ?>>
                            <img src=<?php echo $file . $product['thumbnail'] ?> width="196px" height="196px">
                            <p class="description"><?php echo $product['shortDis'] ?></p>
                        </a>
                        <p>by <span class="product-company"><?php echo $product['manufacturer'] ?></span></p>
                        <div>
                            <div class="review">
                                <div class="stars-outer">
                                    <div class="stars-inner" style="width: <?php echo $starPercentageRounded ?>%;"></div>
                                </div>
                                <span class="number-rating"><?php echo $product['rating'] ?></span>
                                <span class="count">(<?php echo $product['review'] ?>)</span>
                            </div>
                            <br>
                            <div class="price">$<?php echo $product['price'] ?></div>
                        </div>
                    </div>  
            <?php endforeach; ?>

            </div>
        </div>
       
    
        <?php endforeach; ?>
    
    <?php endif; ?>

    
    <!-- Footer -->
    <?php include('include/footer.php'); ?>

    <script src="js/categorypage.js"></script>
</body>
</html>