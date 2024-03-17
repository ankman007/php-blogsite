<?php 

include_once 'database.php';
include 'templates/header.php';
include 'templates/navigation.php';
$post_id = $_GET['id'];
$query = "SELECT * FROM post WHERE id=$post_id;";
$results = mysqli_query($conn, $query);

foreach ($results as $row) {
?>

<div>
    <div class="container m-auto mt-3 row">
        <div class="col-8">
            <div class="card mb-3">
                
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['title']?></h5>
                    <span class="badge bg-primary "><?php echo $row['created_at']?></span>
                    <span class="badge bg-danger">Web Development</span>
                    <div class="border-bottom mt-3"></div>
                    <img src="https://images.moneycontrol.com/static-mcnews/2020/04/stock-in-the-news-770x433.jpg" class="img-fluid mb-2 mt-2" alt="Responsive image">
                    <p class="card-text"><?php echo $row['post_description']?></p>
                    <a href="#" class="btn btn-primary">Share this post</a>
                    <a href="#" class="btn btn-primary">Comment on this</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
}
?>

<div>
    <h4>Related Posts</h4>
    <div class="card mb-3" style="max-width: 700px;">
    </div>  
</div>

<?php 

include 'templates/footer.php';

?>
