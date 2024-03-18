<?php 
include_once 'database.php';
include 'templates/header.php';
include 'templates/navigation.php';
include_once 'templates/functions.php';

$post_id = $_GET['id'];
$query = "SELECT * FROM post WHERE id=$post_id;";
// $query = "SELECT * FROM post WHERE id=$post_id;";
// $query = "SELECT * FROM post ORDER BY id DESC LIMIT $offset, $post_per_page;";
$results = mysqli_query($conn, $query); 

foreach ($results as $row) {
?>

<div class="container m-auto mt-3">
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['title']?></h5>
                    <span class="badge bg-primary"><?php echo 'Posted On '. formatDateTime($row['created_at'])?></span>
                    <span class="badge bg-danger"><?php echo getCategoryName($conn, $row['category_id'])?></span>
                    <div class="border-bottom mt-3"></div>

<?php 

$post_images = getImagesByPost($conn, $row['id']); 
foreach ($post_images as $image){
?>
     
     <img src="images/<?=$image['image_name']?>" style="max-width: 100%;">
<?php } ?>                    
                    <p class="card-text"><?php echo $row['post_description']?></p>
                    <!-- AddToAny BEGIN -->
                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                        <a class="a2a_button_facebook"></a>
                        <a class="a2a_button_email"></a>
                        <a class="a2a_button_linkedin"></a>
                        <a class="a2a_button_reddit"></a>
                        <a class="a2a_button_facebook_messenger"></a>
                        <a class="a2a_button_whatsapp"></a>
                        <a class="a2a_button_x"></a>
                    </div><br>
                    <a href="#" class="btn btn-primary">Comment on this</a>   
                    <?php 
}

?>
                </div>
            </div>
        </div>
            <?php
            
                include 'templates/featured-card.php';
            
            ?>
    </div>
    <div>
    <h4>Related Posts</h4>

<?php 
$category_id = isset($row['category_id']) ? $row['category_id'] : 0; 

$pquery = "SELECT * FROM post WHERE category_id = $category_id ORDER BY id DESC;";

// $pquery = "SELECT * FROM post WHERE category_id={$row['category_id']} ORDER BY id DESC;";
$prun = mysqli_query($conn, $pquery);

while($rpost = mysqli_fetch_assoc($prun)){

if ($rpost['id'] == $post_id){
    continue;
}

?>

<a style="text-decoration: none; color:black" href="post.php?id=<?=$rpost['id']?>">

    <div class="card mb-3" style="max-width: 700px;">
        <div class="row g-0">
            <div class="col-md-5" style="background-image: url('https://images.moneycontrol.com/static-mcnews/2020/04/stock-in-the-news-770x433.jpg');background-size: cover">
            <!-- <img src="https://images.moneycontrol.com/static-mcnews/2020/04/stock-in-the-news-770x433.jpg" alt="..."> -->
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h5 class="card-title"><?=$rpost['title']?></h5>
                    <p class="card-text text-truncate" style="max-width: 100%; overflow: hidden; white-space: nowrap;"><?=$rpost['post_description'] ?></p>

                    <p class="card-text"><small class="text-muted"><?='Posted On ' . formatDateTime($rpost['created_at'])?></small></p>
                </div>
            </div>
        </div>
    </div>  </a>

<?php 
}
?>
</div>
</div>




<script async src="https://static.addtoany.com/menu/page.js"></script>
<?php 
include 'templates/footer.php';
?>
