<?php 
// templates/functions.php

function getCategoryName($conn, $id) {
    $query = "SELECT * FROM categories WHERE category_id=$id"; 
    $result = mysqli_query($conn, $query);
    
    if($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        return $data['category_name'];
    } else {
        return "Category not found";
    }
}

function getImagesByPost($conn, $post_id){
    $query = "SELECT * FROM image WHERE post_id=$post_id;";
    $result = mysqli_query($conn, $query);
    $data = array();
    while ($i=mysqli_fetch_assoc($result)){
        $data[] = $i;
    }
    return $data;
}

function formatDateTime($dateString){
    // $dateString = $row['created_at'];
    $date = new DateTime($dateString);
    $formattedDate = $date->format('F j, Y');
    return $formattedDate;
}
?>
