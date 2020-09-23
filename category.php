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
               $rowperpage = 1;
               $row = 0;
               $i = 0;
               if(isset($_GET['page'])){
                $row = $_GET['page']-1;
                if($row < 0){
                 $row = 0;
                  $i = 0;
                }
                  $i = $row*$rowperpage;
               }
               //
               $limitrow = $row*$rowperpage;
               //
              $ids = $_GET['id'];
              $stats = $connect->prepare("SELECT * FROM posts WHERE cats_id = ? ORDER BY id DESC LIMIT  $limitrow,".$rowperpage);
              $stats->execute(array($ids));
              $i = 1;
              $allposts = $stats->fetchAll();
              //
              foreach ($allposts as $posts){
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
                        <a href="single.php?id=<?php echo $posts['id']; ?>">kingdoem3d</a>
                        <span><?php echo $posts['datts']; ?></span>
                        <a href="single.php?id=<?php echo $posts['id']; ?>">Comments: <?php echo commentscounters("posts_id",$posts['id']); ?></a>
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
                <?php
                  }
                ?>
                <div class="post_navigation">
                  <ul class="pagination text-center">
 <?php
 // counts
 $stats = $connect->prepare("SELECT COUNT(id) FROM posts");
 $stats->execute();
 $allcount = $stats->fetchColumn();
 // calculate total pages
 $total_pages = ceil($allcount / $rowperpage);

 $i = 1;$prev = 0;

 // Total number list show
 $numpages = 3;

 // Set previous page number and start page
 if(isset($_GET['next'])){
    $i = $_GET['next']+1;
    $prev = $_GET['next'] - ($numpages);
 }

 if($prev <= 0) $prev = 1;
 if($i == 0) $i=1;

 // Previous button next page number

 $prevnext = 0;
 if(isset($_GET['next'])){
  $prevnext = ($_GET['next'])-($numpages+1);
  if($prevnext < 0){
   $prevnext = 0;
  }
 }

 // Previous Button

 if(isset($_GET['next']) AND $_GET['next'] != 0){
   // Previous Button
   echo '<li ><a href="category.php?id='.$ids.'&page='.$prev.'&next='.$prevnext.'"><i class="fa fa-chevron-left"></i> Back </a></li>';
 }
 if($i != 1){
  echo '<li ><a href="category.php?id='.$ids.'&page='.($i-1).'&next='.$_GET['next'].'" ';
  if( ($i-1) == $_GET['page'] ){
   echo ' class="active" ';
  }
  echo ' >'.($i-1).'</a></li>';
 }

 // Number List
 for ($shownum = 0; $i<=$total_pages; $i++,$shownum++) {
  if($i%($numpages+1) == 0){
   break;
  }

  if(isset($_GET['next'])){
   echo "<li><a href='category.php?id=".$ids."&page=".$i."&next=".$_GET['next']."'";
  }else{
   echo "<li><a href='category.php?id=".$ids."&page=".$i."'";
  }

  // Active
  if(isset($_GET['page'])){
   if ($i==$_GET['page'])
    echo " class='active'";
   }
   echo ">".$i."</a></li> ";
  }

  // Set next button
  $next = $i+$rowperpage;
  if(($next*$rowperpage) > $allcount){
   $next = ($next-$rowperpage)*$rowperpage;
  }

  // Next Button
  if( ($next-$rowperpage) < $allcount ){
   if($shownum == ($numpages)){
    echo '<li ><a href="category.php?id='.$ids.'&page='.$i.'&next='.$i.'">Forward <i class="fa fa-chevron-right"></i></a></li>';
   }
  }

  ?>
 </ul>
                </div>
            </div>
          </div>
          <?php include_once APP_PATH."/include/sidebar2.php"; ?>
      </div>
</section>

  <?php
  include APP_PATH."/include/footer.php";
