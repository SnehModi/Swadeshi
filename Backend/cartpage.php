<?php

    require_once('config/db.php');
    require_once('config/config.php');
    $search = "";
    $title = "All Products";
    $file = 'images/';
    $products = [];
    
    if(isset($_COOKIE['cart'])){
        $cart = unserialize($_COOKIE['cart']);
        $ids = array_column($cart, 'prodId');
        $data = "(";
        for($i=0; $i<count($ids) ;$i++){
            $data .= $ids[$i];
            if($i != count($ids)-1){
                $data .= ',';
            }
        }
        $data .= ')';

        $query = "SELECT id,name,shortDis,rating,review,manufacturer,thumbnail,price FROM product_details WHERE id IN " . $data;
        $result = mysqli_query($conn, $query);
        $products = mysqli_fetch_all($result, MYSQL_ASSOC);
        
        $starsTotal = 5;
    
        mysqli_free_result($result);
        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cartpage.css">
    <link rel="stylesheet" href="css/Font-Awesome/all.min.css">
    <title>Category Page</title>
</head>
<body>

    <!-- Navbar -->
    <?php include('include/navbar.php'); ?>

    <!-- Content -->
    <?php if(isset($_GET['order'])): ?>
        <div class="container">
            <h1 id="category-header">Order Summary</h1>

            <div class="">
                <table style="border-collapse: collapse; width: 100%;">
                    <thead>
                        <th>Product</th>
                        <th>Price</th>
                    </thead>
                    <?php 
                        $total_price = 0;
                        foreach($products as $product): 
                            $total_price+=floatval($product['price']);
                        ?>
                        <tr>
                            <td><?php echo $product['name'] ?></td>
                            <td>Rs.<?php echo $product['price'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th>Total</th>
                        <th>$<?php echo $total_price ?></th>
                    </tr>
                </table>
            </div>

            <a id="load-more-btn" class="btn" onclick="clearCart()"><i class="fas fa-wallet"></i> Proceed to Payment</a>
        </div>

    <?php elseif(count($products)>0): ?>
        <div class="container">
            <h1 id="category-header">Your Cart</h1>

            <div class="product-grid">

                <?php foreach($products as $product): 
                    $starPercentage = ($product['rating'] / $starsTotal) * 100;
                    $starPercentageRounded = round($starPercentage / 10) * 10;
                    ?>
                        <div class="card">
                            <a href=<?php echo ROOT_URL . "productpage.php?id=" . $product['id'] ?>>
                                <img src=<?php echo $file . $product['thumbnail'] ?> width="196px" height="196px">
                            </a>
                            
                            <div class="card-detail">
                                <a href=<?php echo ROOT_URL . "productpage.php?id=" . $product['id'] ?>>
                                    <p class="description"><?php echo $product['shortDis'] ?></p>
                                </a>
                                <p>by <span class="product-company"><?php echo $product['manufacturer'] ?></span></p>
                                <div class="review">
                                    <div class="stars-outer">
                                        <div class="stars-inner" style="width: <?php echo $starPercentageRounded ?>%;"></div>
                                    </div>
                                    <span class="number-rating"><?php echo $product['rating'] ?></span>
                                    <span class="count">(<?php echo $product['review'] ?>)</span>
                                </div>
                                <br>
                                <div class="price">Rs.<?php echo $product['price'] ?></div>
                            </div>
                            <a id="remove-btn" class="btn" onclick="removeItem(<?php echo $product['id'] ?>)">Remove</a>
                        </div>  
                <?php endforeach; ?>
            
            </div>

            <a id="load-more-btn" class="btn" onclick="placeOrder()">Place Order</a> 
            <a id="load-more-btn" class="btn" onclick="clearCart()">Clear Cart</a>
        </div>
        
    <?php else: 
        echo '<h3 id="ajax-msg" style="text-align:center; margin-top: 300px; margin-bottom: 300px">Your Cart is Empty :( </h3>';
    ?>

    <?php endif; ?>                 

    
    <!-- Footer -->
    <?php include('include/footer.php'); ?>

    <script src="js/cartpage.js"></script>
</body>
</html>