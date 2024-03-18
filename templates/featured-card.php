<div class="col-4">
    <div class="card mb-3">
        <h5 class="card-header">Featured</h5>
        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
    <div class="card mb-3">
        <h5 class="card-header">Featured</h5>
        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
   

    <div class="card mb-3">
        <h5 class="card-header">Comments</h5>
        <div class="card-body">
            <?php
            if (isset($_GET['id'])) {
                // Check if $comments is set and not null
                // var_dump($_GET['id']);
                $comments = getComments($conn, $_GET['id']);
                // var_dump($comments);
                if (isset($comments) && !empty($comments)) {
                  // var_dump($comments);
                    foreach ($comments as $comment) {
                        $name = isset($comment['name']) ? $comment['name'] : '';
                        $commentText = isset($comment['comment']) ? $comment['comment'] : '';
            ?>
                        <h5 class="card-title"><?= $name ?></h5>
                        <span class="text-secondary"><small><?= "Posted On ". formatDateTime($comment['created_at']) ?></small></span>
                        <p class="card-text"><?= $commentText ?></p>

            <?php
                    }
                } else {
                    echo "<p>No comments available.</p>";
                }
            }
            ?>
        </div>
    </div>
</div>
