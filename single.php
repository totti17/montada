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
              //
              if(isset($_GET['id'])){
              $ids = intval($_GET['id']);
              $stats = $connect->prepare("SELECT * FROM posts WHERE id = ?");
              $stats->execute(array($ids));
              $i = 1;
              $posts = $stats->fetch();
              if($posts['vip_status'] == 0 or $usersinf['status'] == 1){//not vip post and not vip user
              ?>
                <div class="npost">
                    <div class="npost_categ">
                      <a href="category.php?id=<?php echo $posts['cats_id']; ?>"><?php echo singCheck('category','id',$posts['cats_id'],'name'); ?></a>
                    </div>
                    <div class="npost_head">
                      <h4>
                        <a href="single.php?id=<?php echo $posts['id']; ?>"><?php echo $posts['title']; ?></a>
                      </h4>
                    </div>
                    <div class="npost_body">
                      <div class="npost_metadata">
                        <div class="cols"><i class="fa fa-user"></i>Author:
                        <a href="single.php?id=<?php echo $posts['id']; ?>">kingdoem3d</a></div>
                        <div class="cols"><span><i class="fa fa-clock-o"></i><?php echo $posts['datts']; ?></span></div>
                        <div class="cols"><a href=""><i class="fa fa-comment"></i> Comments: <?php echo commentscounters("posts_id",$posts['id']); ?></a></div>
                      </div>
                      <div class="thumbnails text-center">
                          <img src="layout/img/posts/<?php echo $posts['images']; ?>" alt="<?php echo $posts['title']; ?>">
                      </div>
                      <div class="details">
                        <?php echo $posts['descrip']; ?>
                      </div>
                      <div class="nblock_links text-center">
                          <?php
                          if(isset($_SESSION['userlogin'])){
                            $numbers = $posts['numbers'];
                            global $connect;
                            $stat = $connect->prepare("SELECT * FROM post_links WHERE numbers = ?");
                            $stat->execute(array($numbers));
                            $alllink =  $stat->fetchAll();
                            foreach($alllink as $links){
                          ?>
                            <a class="btn btn-default" href="<?php echo $links['url']; ?>" target="_blank">
                                <img src="layout/img/download.png" alt="<?php echo $links['names']; ?>">
                            </a>
                          <?php
                            }
                          }else{
                            echo "<div class='alert alert-danger'>WARNING! ONLY REGISTERED USERS ALLOWED TO VIEW THIS BLOCK!</div>";
                          }
                          ?>
                      </div>
                    </div>
                    <div class="relatedposts">
                        <div class="heads">Related news</div>
                        <div class="posts_relat">
                            <ul class="nav">
                              <?php
                                  $catsid = $posts['cats_id'];
                                  $ids = $posts['id'];
                                  $stati = $connect->prepare("SELECT * FROM posts WHERE cats_id = ? AND id != ?");
                                  $stati->execute(array($catsid,$ids));
                                  $i = 1;
                                  $relatedsposts = $stati->fetchAll();
                                  foreach($relatedsposts as $relateds){
                              ?>
                                <li><a href="single.php?id=<?php echo $relateds['id']; ?>"><?php echo $relateds['title']; ?></a></li>
                                <?php
                                  }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end of npost -->
                <?php
                  $id = $posts['id'];
                  $statcomm = $connect->prepare("SELECT * FROM comments WHERE posts_id = ?");
                  $statcomm->execute(array($id));
                  $i = 1;
                  $allcomments = $statcomm->fetchAll();
                  foreach($allcomments as $comment){
                    $imgs = singCheck('users','id',$comment['user_id'],'images');
                ?>
                <div class="comments_block">
                  <div id="comments">
                        <div class="chead">
                          <div class="clogin">
                            <a href="">
                              <span class="fa fa-user" rel="114"></span>
                              <?php echo singCheck('users','id',$comment['user_id'],'name'); ?></a>
                          </div>
                          <div class="cinfo">
                            <span class="fa fa-clock-o" rel="114"></span>
                            <?php echo $comment['dattes']; ?>
                          </div>
                        </div>
                        <div class="chead2">
                        	<div class="cuser">
                        	   <img src="<?php if(!empty($usersinf['images'] or $usersinf['images'] != '')){echo "layout/img/avatars/".$imgs;}else{ echo 'layout/img/user.png'; } ?>" border="0" alt="akbundi">
                        	</div>
                        	<div class="ctext">
                        		<div id="comm">
                              <?php echo $comment['conetents']; ?>
                            </div>
                        	</div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="comments_froms">
                  <?php
                    if(isset($_SESSION['userlogin'])){
                  ?>
                    <div class="heads">Add Comment</div>
                    <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $ids; ?>" method="post">
                        <input type="hidden" name="usernam" value="<?php echo $usersinf['name']; ?>">
                        <input type="hidden" name="userid" value="<?php echo $usersinf['id']; ?>">
                        <input type="hidden" name="post_id" value="<?php echo $ids; ?>">
                        <div class="form-group">
                            <textarea id="trumbowyg-comments" name="comment_contents" class="form-control" rows="8" cols="80"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-secondary btn-padd" name="addcomments" value="send" />
                        </div>
                        <div>
                            <?php
                            if(isset($_POST['addcomments'])){
                              $id = $posts['id'];
                              $uid = $usersinf['id'];
                              $post_id = get_input('post_id');
                              $comment_contents = post('comment_contents');
                              $founds = checkfounded("posts","id",$id);
                              if(!empty($comment_contents)){
                                  if($founds > 0){
                                      $addcomments = addcomments($uid,$id,$comment_contents);
                                      if($addcomments === true){
                                          echo "<script>alert('successfully,comments added');</script>";
                                          refreshPage(1,'single.php?id='.$id);
                                      }else{
                                          echo "<script>alert('warning,error comments not added');</script>";
                                          refreshPage(1,'single.php?id='.$id);
                                      }
                                  }else{
                                    echo "<script>alert('warning,error this post not founds');</script>";
                                    refreshPage(1,'single.php?id='.$id);
                                  }
                              }else{
                                  echo "<script>alert('warning,Please fill in all the required fields');</script>";
                                  refreshPage(1,'single.php?id='.$id);
                              }
                            }
                            ?>
                        </div>
                    </form>
                    <?php
                    }else{
                      echo "<div class='alert alert-danger'>Guest are not allowed to comment this publication.</div>";
                    }
                    ?>
                </div>
                <?php
              }elseif($posts['vip_status'] == 1 AND $usersinf['status'] == 2){
                  echo "your are vip user";
              }else{
                ?>
                  <div class="uservipnotallowd">
                      <div class="heads">Warning! An error was detected</div>
                      <div class="contents">
                        <div class="alert alert-danger">
                          User do not have the required permissions to view the articles in this section.
                        </div>
                      </div>
                  </div>
                <?php
                }
              }else{
                header("Location: index.php");
              }
                ?>
            </div>
          </div>
        <?php include_once APP_PATH."/include/sidebar2.php"; ?>
    </div>
</section>

<?php
include APP_PATH."/include/footer.php";
