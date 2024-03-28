<?php 
  include_once 'database.php';
  include 'templates/header.php';
  include 'templates/navigation.php';
  include_once 'templates/functions.php';
  
?>

<div>
    <div class="container m-auto mt-3 row">
        <div class="col-8">
        <?php
            include 'templates/post-card.php';
        ?>
    </div>
        <?php
          
            include 'templates/featured-card.php';
        ?>
          
    </div>

<?php 

if (isset($_GET['search'])){
  $keyword = $_GET['search'];
  $query = "SELECT COUNT(*) AS total_posts FROM post WHERE title LIKE '%$keyword%'";
}
else {
  $query = "SELECT COUNT(*) AS total_posts FROM post";
}
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$total_posts = $row['total_posts'];
$total_pages = ceil($total_posts / $post_per_page);
?>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?php echo ($page <= 1) ? 1 : ($page - 1); ?>" tabindex="-1" aria-disabled="true">Previous</a>
        </li>

        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php } ?> 

        <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?php echo ($page >= $total_pages) ? $total_pages : ($page + 1); ?>">Next</a>
        </li>
    </ul>
</nav>

<?php 
include 'templates/footer.php';
?>