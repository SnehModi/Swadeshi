<?php
    require_once('config/db.php');
    require_once('config/config.php');

    $search = "";
    
    if(isset($_REQUEST['s'])){
        $search = mysqli_real_escape_string($conn,$_REQUEST['s']);
    }

    $pattern = '/' . $search .'/i';
    // echo $pattern;

    $query = "SELECT category FROM product_details WHERE category LIKE '%" . $search . "%'  LIMIT 8";
    $result = mysqli_query($conn, $query);
    $suggestions = mysqli_fetch_all($result, MYSQL_ASSOC);
    $suggest = [];
    foreach($suggestions as $suggestion){
        $list = explode(',', $suggestion['category']);
        // print_r($list);
        $list = preg_grep($pattern, $list);
        // print_r($list);
        $suggest = array_merge($suggest, $list);
    }

    // Make unique suggestions
    $suggest = array_unique($suggest);

    // Top 8 suggestions
    $suggest = array_slice($suggest, 0, 8);
    $json = json_encode($suggest,true);

    // print_r($suggestions);
    echo $json;

?>