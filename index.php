<?php
  include "init.php";
  $do = isset($_GET['do']) ? $_GET['do'] : "default";
?>
<section class="contents col-xs-12">
    <div class="row">
          <?php include_once APP_PATH."/include/sidebar.php"; ?>
          <?php if($do == "default"){ ?>
        <div class="main_posts">
            <div class="ads">
                <img src="layout/img/ads.jpg" alt="">
            </div>
            <div class="posts">
                <div class="npost">
                    <div class="npost_categ">
                      <a href="">iCLONE PACKS</a>
                    </div>
                    <div class="npost_head">
                      <h4>
                        <a href="">Fantasy Mushrooms Collection</a>
                      </h4>
                    </div>
                    <div class="npost_body">
                      <div class="npost_metadata">
                        &nbsp;&nbsp;Author:
                        <a href="">ZeuS</a>
                        <span> 2-08-2020, 11:11</span>
                        <a href="">Comments: 23</a>
                      </div>
                      <div class="thumbnails">
                        <a href="" class="highslide" target="_blank">
                          <img src="layout/img/post1.jpg" alt="">
                        </a><!--TEnd-->
                      </div>
                      <div class="details">
                          <u>Description:</u> Large Mushrooms Collection for your Fantasy or Sci-Fi projects.<br>Total Meshes Quantity: 124<br>Small Mushrooms: 10 types (40 variations)<br>Middle Mushrooms: 10 types (40 variations)<br>Giant Mushrooms: 11 types (44 variations)<br>
                          <u>Pack includes:</u> 124 Props
                      </div>
                      <div class="nblock_foot">
                          <a href="">
                            <div class="txt13" style="float:right;"><strong>Details...</strong></div>
                          </a>
                      </div>
                    </div>
                </div
                >
                <!-- end of npost -->

                <div class="post_navigation">
                  <span>Back</span>&nbsp;
                  <span>1</span>
                  <a href="/page/2/">2</a>
                  <a href="/page/3/">3</a>
                  <a href="/page/4/">4</a>
                  <a href="/page/5/">5</a>
                  <a href="/page/6/">6</a>
                  <a href="/page/7/">7</a>
                  <a href="/page/8/">8</a>
                  <a href="/page/9/">9</a>
                  <a href="/page/10/">10</a>
                  <span class="nav_ext">...</span>
                  <a href="/page/30/">30</a>&nbsp;
                  <a href="/page/2/">Forward</a>
                </div>
            </div>
        </div>
      <?php }elseif($do == "logout"){

      } ?>
        <?php include_once APP_PATH."/include/sidebar2.php"; ?>
    </div>
</section>


















<?php
include APP_PATH."/include/footer.php";
