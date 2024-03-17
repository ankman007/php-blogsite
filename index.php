<?php 
  include_once 'database.php';
  include 'templates/header.php';
  include 'templates/navigation.php';
  
?>

<div>
    <div class="container m-auto mt-3 row">
        <div class="col-8">
        <?php
            include 'templates/post-card.php';
        ?>
    </div>
    <div class="col-4">
        <?php
          $featured_post_count = 3;
          while ($featured_post_count >= 1){
            include 'templates/featured-card.php';
            $featured_post_count --;
          }
        ?>
          
    </div>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
      </nav>
      
<?php 
  include 'templates/footer.php';
?>