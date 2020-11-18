<?php

    require_once('config/db.php');
    require_once('config/config.php');
    $search = "";

    $file = 'images/';

    $data = json_decode(file_get_contents("php://input"), true);
    
    $query = "SELECT id,shortDis,rating,review,manufacturer,thumbnail,price FROM product_details WHERE ";

    // echo $query;
    if($data['search']!=null){
        $query = $query . '(';
        for($i=0; $i<count($data['search']); $i++){
            if($i==0){
                $query = $query . "category LIKE '%" . $data['search'][$i] . "%' ";
            } else {
                $query = $query . "OR category LIKE '%" . $data['search'][$i] . "%' ";
            }
        }
        $query = $query . ')';
    }
    

    // echo $query;
    if ($data['brand']!=null){
        $query = $query . ' AND (';
        $query = $query . 'manufacturer IN (';
        for($i=0; $i<count($data['brand']); $i++){
            $query = $query . "'" . $data['brand'][$i] . "'";
            if($i==count($data['brand'])-1){
                $query = $query . ')';
                break;
            }
            $query = $query . ',';
        }
        $query = $query . ')';
    }
    

    // echo $query;
    if($data['rating']!=null){
        $query = $query . ' AND (';
        $query = $query . 'rating >=' . $data['rating'];
        $query = $query . ')';
    }
    

    // echo $query;
    if($data['price']!=null){
        $query = $query . ' AND (';
        for($i=0; $i<count($data['price']); $i++){
            $range = explode('-', $data['price'][$i]);
            $low = $range[0];
            $high = $range[1];
            if($i==0){
                $query = $query . "price BETWEEN ". $low ." AND " . $high;
            } else {
                $query = $query . " OR price BETWEEN ". $low ." AND " . $high;
            }
        }
        $query = $query . ')';
    }

    $query = $query . ' LIMIT ' . $data['offset'] . ",2";

    $result = mysqli_query($conn, $query);
    $products = mysqli_fetch_all($result, MYSQL_ASSOC);

    for($i=0; $i<count($products); $i++){
        $products[$i]['thumbnail'] = ROOT_URL . $file . $products[$i]['thumbnail'];
    }

    $json = json_encode($products,true);
    
    mysqli_free_result($result);
    mysqli_close($conn);
    
    echo $json;
    
 













//     SELECT *
// FROM product_details
// WHERE 
//     (category LIKE '%Security%'
//     OR category LIKE '%Security%'
//     OR category LIKE '%Security%')
//     AND (
//         manufacturer LIKE '%Full-Time%'
//         OR manufacturer LIKE '%Part-Time%'
//         OR manufacturer LIKE '%Casual%'
//         OR manufacturer LIKE '%Contract%'); 
//     AND (
//         rating = 5
//         OR rating = 3   
//     )
//     AND (
//         price BETWEEN 200 AND 300
//         OR price BETWEEN 200 AND 300
//         OR price BETWEEN 200 AND 300
//     ) 
        
       
?>




