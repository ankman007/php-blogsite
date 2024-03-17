<?php 
include_once 'database.php';
include 'templates/header.php';
include 'templates/navigation.php';
include 'templates/functions.php';

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
                    <a href="#" class="btn btn-primary">Share this post</a>
                    <a href="#" class="btn btn-primary">Comment on this</a>
                    <?php 
}

?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <?php
            $featured_post_count = 3;
            while ($featured_post_count >= 1){
                include 'templates/featured-card.php';
                $featured_post_count --;
            }
            ?>
        </div>
    </div>
    <div>
    <h4>Related Posts</h4>

<?php 

$pquery = "SELECT * FROM post WHERE category_id={$row['category_id']} ORDER BY id DESC;";
$prun = mysqli_query($conn, $pquery);

while($rpost = mysqli_fetch_assoc($prun)){

if ($rpost['id'] == $post_id){
    continue;
}

?>
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
    </div>  

<?php 
}
?>
</div>
</div>





<?php 
include 'templates/footer.php';
?>
