<?php 
include_once './database.php';
$query = "SELECT * FROM post;";
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
                <?php
                    $dateString = $row['created_at']; // Fetching the date from the database
                    $date = new DateTime($dateString);
                    $formattedDate = $date->format('F j, Y');
                ?>
                <h5 class="card-title"><?php echo $row['title'] ?></h5>
                <p class="card-text text-truncate" style="max-width: 100%; overflow: hidden; white-space: nowrap;"><?php echo $row['post_description'] ?></p>
                <p class="card-text"><small class="text-muted"><?php echo 'Posted On '. $formattedDate ?></small></p>
                </div>
            </div>
        </div>
    </a>
</div>

<?php 
    }
}
?>
