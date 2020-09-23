<?php
  include "init.php";
  $do = isset($_GET['do']) ? $_GET['do'] : "default";
?>
<section class="contents col-xs-12">
    <div class="row">
          <?php include_once APP_PATH."/include/sidebar.php"; ?>
          <div class="main_posts">
            <div class="ads">
                <img src="layout/img/ads.jpg" alt="">
            </div>
            <?php if($do == "default"){ ?>
            <div class="posts">
              <?php
              $stats = $connect->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT 10");
              $stats->execute();
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
                        <?php echo substr($posts['descrip'],150); ?>
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
          <?php }elseif($do == "profile"){
            $userlogin = checkuserlogindone();
            if($userlogin != true){
              refreshPage(0,'index.php?do=default');
            }
            $emails  = $_SESSION['userlogin'];
            $usersinf = fethuser1vals('email',$emails);
          ?>
          <div class="myprofiles">
            <h3>Profile</h3>
            <div class="usreinfo">
              <div class='img col-md-6'>
                  <img src="<?php if(!empty($usersinf['images'] or $usersinf['images'] != '')){echo "layout/img/avatars/".$usersinf['images'];}else{ echo 'layout/img/user.png'; } ?>" alt="">
                  <a href="index.php?do=editprofile">Edit Profile</a>
              </div>
              <div class="links col-md-5">
                  <ul class="nav">
                      <li>user: <b><?php echo $usersinf['name']; ?></b></li>
                      <li>Full name: <b><?php echo $usersinf['fullname']; ?></b></li>
                      <li>Phone: <?php echo $usersinf['phone']; ?></li>
                      <li>Location: <?php echo $usersinf['location']; ?></li>
                      <li>About: <?php echo $usersinf['aboutme']; ?></li>
                      <li>Registered: <?php echo $usersinf['dattes']; ?></li>
                  </ul>
              </div>
            </div>
          </div>
          <?php
        }elseif($do == "editprofile"){
          $userlogin = checkuserlogindone();
          if($userlogin != true){
            refreshPage(0,'index.php?do=default');
          }
          $emails  = $_SESSION['userlogin'];
          $usersinf = fethuser1vals('email',$emails);
          ?>
          <div class="editprofil_contents">
              <h3>Edit profile: <?php  echo $usersinf['name']; ?></h3>
              <form class="form editprofilform" action="<?php echo $_SERVER['PHP_SELF']; ?>?do=editprofile" method="post" enctype="multipart/form-data">
                <div class="col-12">
                  <?php
                  // update profile
                  if(isset($_POST['editprofil'])){
                    $fullname                 = filterString(get_input('fullname'));
                    $phones                   = filterString(get_input('phones'));
                    $newpassword              = filterString(get_input('newpassword'));
                    $retypnewpassword         = filterString(get_input('retypnewpassword'));
                    $location                 = filterString(get_input('location'));
                    $about                    = filterString(get_input('about'));

                    $imglocated       = "layout/img/avatars";
                    $avatar         = $_FILES['avatar']['name'];
                    $avatar_tmpl    = $_FILES['avatar']['tmp_name'];

                    if(!empty($fullname) AND !empty($phones) AND !empty($location) AND !empty($about)){
                        if(!empty($newpassword) AND !empty($retypnewpassword) AND !empty($avatar)){
                          if($newpassword === $retypnewpassword){
                            $newpassword = sha1($newpassword);
                            $updateprofiles = updateprofiles1($fullname,$phones,$location,$about,$avatar,$newpassword,$emails);
                            if($updateprofiles === true){
                                move_uploaded_file($avatar_tmpl,"$imglocated/$avatar");
                                echo "<div class='alert alert-success'>Edit profile saved</div>";
                                refreshPage(2,'index.php?do=logout');
                            }else{
                              echo "<div class='alert alert-danger'>Edit profile failed,please try again</div>";
                              refreshPage(2,'index.php?do=editprofile');
                            }
                          }else{
                            echo "<div>Error in saving your profile,the password did n't match in two fiedds </div>";
                            refreshPage(2,'index.php?do=editprofile');
                          }
                        }elseif(!empty($newpassword) AND !empty($retypnewpassword)){
                            if($newpassword === $retypnewpassword){
                              $newpassword = sha1($newpassword);
                              $updateprofiles = updateprofiles2($fullname,$phones,$location,$about,$newpassword,$emails);
                              if($updateprofiles === true){
                                  echo "<div class='alert alert-success'>Edit profile saved</div>";
                                  refreshPage(2,'index.php?do=logout');
                              }else{
                                echo "<div class='alert alert-danger'>Edit profile failed,please try again</div>";
                                refreshPage(2,'index.php?do=editprofile');
                              }
                            }else{
                              echo "<div>Error in saving your profile,the password did n't match in two fiedds </div>";
                              refreshPage(2,'index.php?do=editprofile');
                            }
                        }elseif (!empty($avatar)) {
                          $updateprofiles = updateprofiles3($fullname,$phones,$location,$about,$avatar,$emails);
                          if($updateprofiles === true){
                              move_uploaded_file($avatar_tmpl,"$imglocated/$avatar");
                              echo "<div class='alert alert-success'>Edit profile saved</div>";
                              refreshPage(1,'index.php?do=editprofile');
                          }else{
                            echo "<div class='alert alert-danger'>Edit profile failed,please try again</div>";
                            refreshPage(1,'index.php?do=editprofile');
                          }
                        }else{
                            $updateprofiles = updateprofiles4($fullname,$phones,$location,$about,$emails);
                            if($updateprofiles === true){
                                echo "<div class='alert alert-success'>Edit profile saved</div>";
                                refreshPage(1,'index.php?do=editprofile');
                            }else{
                              echo "<div class='alert alert-danger'>Edit profile failed,please try again</div>";
                              refreshPage(1,'index.php?do=editprofile');
                            }
                        }
                    }else{
                        echo "<div class='alert alert-danger'>Error in saving your profile,there are fileds empty and no changes happend</div>";
                        refreshPage(1,'index.php?do=editprofile');
                    }

                  }
                  ?>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                      <label>Full name:	</label>
                    </div>
                    <div class="col-md-8 text-left">
                      <input type="text" name="fullname" placeholder="" value="<?php  echo $usersinf['fullname']; ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label>phones: </label>
                    </div>
                    <div class="col-md-8 text-left">
                        <input type="text" name="phones" value="<?php  echo $usersinf['phone']; ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                      <label>New password:	</label>
                    </div>
                    <div class="col-md-8 text-left">
                      <input type="password" name="newpassword" placeholder="new password" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label>Repeat password:	</label>
                    </div>
                    <div class="col-md-8 text-left">
                      <input type="password" name="retypnewpassword" placeholder="retype new password" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                    <label>Location</label>
                  </div>
                  <div class="col-md-8 text-left">
                    <input type="text" name="location" placeholder="location" value="<?php  echo $usersinf['location']; ?>" />
                  </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                    <label>About</label>
                  </div>
                  <div class="col-md-8 text-left">
                    <textarea type="text" name="about" placeholder="" rows="5"><?php  echo $usersinf['aboutme']; ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                      <label>Avatar</label>
                    </div>
                    <div class="col-md-8 text-left">
                      <input type="file" name="avatar" id="avatar" />
                      <?php if(!empty($usersinf['images']) or $usersinf['images'] != ''){ ?>
                      <img width="64" height="64" src="layout/img/avatars/<?php echo $usersinf['images']; ?>" alt="<?php echo $usersinf['fullname']; ?>" />
                    <?php } ?>
                    </div>
                </div>
                <div class="form-group row">
                    <input type="submit" name="editprofil" value="save">
                </div>
            </form>
          </div>
          <?php
        }elseif($do == "logout"){
                session_start();

                session_unset();

                session_destroy();
                header("Location: index.php");
                exit(0);
          }else{
            header("Location: index.php");
          }
          ?>
        </div>
        <?php include_once APP_PATH."/include/sidebar2.php"; ?>
    </div>
</section>


















<?php
include APP_PATH."/include/footer.php";
