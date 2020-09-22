<?php
  include "init.php";
?>
<section class="contents col-xs-12">
    <div class="row">
          <?php include_once APP_PATH."/include/sidebar.php"; ?>
          <div class="main_posts">
            <div class="ads">
                <img src="layout/img/ads.jpg" alt="">
            </div>
            <div class="posts">
              <?php
              $stats = $connect->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT 10");
              $stats->execute();
              $i = 1;
              $allposts = $stats->fetch();
              //
              ?>
                <div class="npost">
                    <div class="npost_categ">
                      <a href="category.php?id=<?php echo $posts['cats_id']; ?>"><?php echo singCheck('category','id',$posts['cats_id'],'name') ?></a>
                    </div>
                    <div class="npost_head">
                      <h4>
                        <a href="single.php?id=<?php echo $posts['id']; ?>"><?php echo $posts['title']; ?></a>
                      </h4>
                    </div>
                    <div class="npost_body">
                      <div class="npost_metadata">
                        &nbsp;&nbsp;Author:
                        <a href="">ZeuS</a>
                        <span><?php echo $posts['datts']; ?></span>
                        <a href="">Comments: 23</a>
                      </div>
                      <div class="thumbnails">
                        <a href="single.php?id=<?php echo $posts['id']; ?>" class="highslide" target="_blank">
                          <img src="layout/img/posts/<?php echo $posts['images']; ?>" alt="<?php echo $posts['title']; ?>">
                        </a><!--TEnd-->
                      </div>
                      <div class="details">
                        <?php echo $posts['descrip']; ?>
                      </div>
                      <div class="nblock_foot">
                          <a href="single.php?id=<?php echo $posts['id']; ?>">
                            <div class="txt13" style="float:right;"><strong>Details...</strong></div>
                          </a>
                      </div>
                    </div>
                </div>
                <!-- end of npost -->
            </div>
          </div>
        <?php include_once APP_PATH."/include/sidebar2.php"; ?>
    </div>
</section>

<?php
include APP_PATH."/include/footer.php";
