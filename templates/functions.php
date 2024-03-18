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

function getSubMenuNumber($conn, $menu_id){
    if ($menu_id === null) {
        return 0; 
    }

    $query = "SELECT * FROM submenu WHERE parent_menu_id=$menu_id;";
    $run = mysqli_query($conn, $query);
    return mysqli_num_rows($run);
}

function getSubMenu($conn, $menu_id){
    $query = "SELECT * FROM submenu WHERE parent_menu_id=$menu_id;";
    $run = mysqli_query($conn, $query);
    $data[] = array();
    while($i = mysqli_fetch_assoc($run)){
        $data[] = $i;
    }
    return $data;
}

function getComments($conn, $post_id){
    $query = "SELECT * FROM comments WHERE post_id=$post_id;";
    $run = mysqli_query($conn, $query);
    $data = array(); 
    while ($row = mysqli_fetch_assoc($run)){
        $data[] = $row; 
    }
    return $data;
}

function getAdminInfo($conn, $email){
    $query = "SELECT * FROM admin WHERE email='$email';";
    $run = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($run);
    return $data;
}
?>
