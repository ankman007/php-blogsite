<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">StreamlineMinds</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <?php
                include './database.php';
                include 'templates/functions.php';

                $navQuery = "SELECT * FROM menu;";
                $runNav = mysqli_query($conn, $navQuery);

                while ($menu = mysqli_fetch_assoc($runNav)) {
                    $submenu_no = getSubMenuNumber($conn, $menu['menu_id']);
                    if (!$submenu_no){
                ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?=$menu['action']?>"><?=$menu['name'] ?></a>
                </li>
                <?php
                    } else {
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="<?= isset($menu['action']) ? $menu['action'] : '#' ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= isset($menu['name']) ? $menu['name'] : 'Unnamed' ?>
                    </a>
                    <ul class="dropdown-menu">
                        <?php 
                        $submenus = getSubMenu($conn, $menu['menu_id']);
                        foreach ($submenus as $sm){
                        ?>
                        <li><a class="dropdown-item" href="<?=isset($sm['action']) ? $sm['action'] : '#'?>"><?=isset($sm['name']) ? $sm['name'] : 'Unnamed'?></a></li>
                        <?php 
                        }
                        ?>
                    </ul>
                </li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>
        <form class="d-flex">
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
</nav>
