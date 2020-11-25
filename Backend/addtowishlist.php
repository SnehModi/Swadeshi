<?php
    require_once('config/db.php');
    require_once('config/config.php');
    session_start();
    if(isset($_SESSION['uid'])){
            
            $userId = $_SESSION['uid'];
            $prodId = mysqli_real_escape_string($conn, $_POST['prodId']);
            $query = "SELECT wish_list FROM user WHERE id=" . $userId;
            $result = mysqli_query($conn, $query);
            $wishlist = mysqli_fetch_assoc($result);
            if($wishlist['wishlist']!=NULL){
                $wishlist = explode(',', $wishlist['wishlist']);
                array_push($wishlist, $prodId);
                $wishlist = implode(',', $wishlist);
            } else {
                $wishlist = $prodId;
            }
            
            
            $query = "INSERT INTO user_details(wish_list) VALUES (?) WHERE id=" . $userId;
            if($stmt = mysqli_prepare($conn, $query)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, 's', $wishlist);
                mysqli_stmt_execute($stmt);

                if(mysqli_stmt_error($stmt)){
                    echo "ERROR: Could not execute query: " . mysqli_stmt_error($stmt);
                } else {
                    // http_response_code(404);
                    echo "Records inserted successfully.";
                }

                mysqli_stmt_close($stmt);

            } else {
                // http_response_code(404);
                echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
            }

    } else {
        echo "Login Required";
    }
    
    mysqli_close($conn);

?>