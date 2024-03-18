<?php 
include_once './database.php';

$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$post_per_page = 5;
$offset = ($page-1) * $post_per_page;

if (isset($_GET['search'])){
    $keyword = $_GET['search'];
    $query = "SELECT * FROM post WHERE title LIKE '%$keyword%' ORDER BY id DESC LIMIT $offset, $post_per_page;";
}
else {
    $query = "SELECT * FROM post ORDER BY id DESC LIMIT $offset, $post_per_page;";
}
$results = mysqli_query($conn, $query); 


if (!empty($results)){
  foreach ($results as $row){
?>

<div class="card mb-3" style="max-width: 800px;">
    <a href="post.php?id=<?php echo $row['id']; ?>" style="text-decoration:none; color:black;">    
        <div class="row g-0">
            <div class="col-md-5" style="background-image: url('https://images.moneycontrol.com/static-mcnews/2020/04/stock-in-the-news-770x433.jpg');background-size: cover">
                <!-- <img src="https://images.moneycontrol.com/static-mcnews/2020/04/stock-in-the-news-770x433.jpg" alt="..."> -->
            </div>
            <div class="col-md-7">
                <div class="card-body">
                <h5 class="card-title"><?php echo $row['title'] ?></h5>
                <p class="card-text text-truncate" style="max-width: 100%; overflow: hidden; white-space: nowrap;"><?php echo $row['post_description'] ?></p>
                <p class="card-text"><small class="text-muted"><?php echo 'Posted On '. formatDateTime($row['created_at']) ?></small></p>
                </div>
            </div>
        </div>
    </a>
</div>
<?php 
    }
}
?>
