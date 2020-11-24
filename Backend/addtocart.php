
<?php
    // Add Item
    if(isset($_POST['qty']) and isset($_POST['color']) and isset($_POST['size'])){

        $qty = htmlentities($_POST['qty']);
        $color = htmlentities($_POST['color']);
        $size = htmlentities($_POST['size']);
        $prodId = htmlentities($_POST['prodId']);
        $item = array(
            'prodId'=>$prodId,
            'qty'=>$qty,
            'color'=>$color,
            'size'=>$size
        );

        if (isset($_COOKIE['cart'])) {
            $cart = unserialize($_COOKIE['cart']);
            if(in_array($prodId, array_column($cart, 'prodId'))){
                echo "Already added to cart";
            } else {
                $len = count($cart);
                $cart[$len] = $item;
            }
            print_r($cart);
        } else {
            $cart[0] = $item;
        }
        $cart = serialize($cart);
        setcookie('cart', $cart, time() + 60*60*24);
    }

    // Remove Item
    if(isset($_POST['delete'])){
        $prodId = $_POST['delete'];
        if (isset($_COOKIE['cart'])) {
            $cart = unserialize($_COOKIE['cart']);
            if(in_array($prodId, array_column($cart, 'prodId'))){
                $i = array_search($prodId, array_column($cart, 'prodId'));
                unset($cart[$i]);
                $cart = array_values($cart);
            }
            if(count($cart)==0){
                setcookie('cart','', time() - 10);
            } else {
                $cart = serialize($cart);
                setcookie('cart', $cart, time() + 60*60*24);
            }
        }
    }
?>
















<?php
    // require_once('config/db.php');
    // require_once('config/config.php');
    // session_start();
    // if(isset($_SESSION['userId'])){

    //     if(isset($_POST['qty']) and isset($_POST['color']) and isset($_POST['size'])){
            
    //         $userId = $_SESSION['userId'];
    //         $qty = mysqli_real_escape_string($conn, $_POST['qty']);
    //         $color = mysqli_real_escape_string($conn, $_POST['color']);
    //         $size = mysqli_real_escape_string($conn, $_POST['size']);
    //         $prodId = mysqli_real_escape_string($conn, $_POST['prodId']);

    //         $query = "INSERT INTO cart_details(userId, productId, selectedQty, selectedSize, selectedColor) VALUES (?,?,?,?,?)";
            

    //         if($stmt = mysqli_prepare($conn, $query)){
    //             // Bind variables to the prepared statement as parameters
    //             mysqli_stmt_bind_param($stmt, 'iiiis', $userId, $prodId, $qty, $size, $color);
    //             mysqli_stmt_execute($stmt);

    //             if(mysqli_stmt_error($stmt)){
    //                 echo "ERROR: Could not execute query: " . mysqli_stmt_error($stmt);
    //             } else {
    //                 // http_response_code(404);
    //                 echo "Records inserted successfully.";
    //             }

    //             mysqli_stmt_close($stmt);

    //         } else{
    //             // http_response_code(404);
    //             echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
    //         }

    //     } else {
    //         // http_response_code(404);
    //         echo "Data Required";
    //         print_r($_REQUEST);
    //     }
    // } else {
    //     // http_response_code(404);
    //     echo "Login Required";
    // }
    
    
    // mysqli_close($conn);

?>
