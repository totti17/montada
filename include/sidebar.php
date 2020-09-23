
    <div class="left_sidebar hidden-xs">
        <div class="widgets">
            <h2>Top News</h2>
            <div class="contents">
                <ul>
                  <?php
                    $stats = $connect->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT 10");
                    $stats->execute();
                    $i = 1;
                    $allposts = $stats->fetchAll();
                    //
                    foreach ($allposts as $posts){
                    ?>
                    <li>
                        <a href="single.php?id=<?php echo $posts['id']; ?>"><?php echo $posts['title']; ?></a>
                    </li>
                  <?php
                    }
                  ?>
                </ul>
            </div>
        </div>
        <!-- end of widgets -->
        <div class="widgets">
            <h2 class="titles">Ads</h2>
            <div class="contents">
                <a href="">
                  <img src="layout/img/ads1.jpg" alt="">
                </a>
            </div>
        </div>
        <!-- end of widgets -->
    </div>
