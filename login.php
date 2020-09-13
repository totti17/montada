<?php
  include "init.php";
  checkuserlogin();
?>
<section class="contents col-xs-12">
    <div class="row">
        <?php include_once APP_PATH."/include/sidebar.php"; ?>
        <div class="main_posts">
            <div class="ads">
                <img src="layout/img/ads.jpg" alt="">
            </div>
            <div class="login_page col-xs-12">
                <?php
                  if(isset($_POST['loginsenter'])){
                    $login_user     = filterString(get_input('login_user'));
                    $login_password   = filterString(get_input('login_password'));
                    //
                    $password = sha1($login_password);
                    //
                    $user = fethuser2vals("name","passwords",$login_user,$password);
                    //
                    if(!empty($login_user) AND !empty($login_password)){
                      if($user['name'] == $login_user AND $user['passwords'] == $password){
                					//session
                					$_SESSION['userlogin'] = $user['email'];
                					echo "<div class='alert alert-success'>you logged in successfully.</div>";
                						refreshPage(1,'index.php');
                				}else{
                					echo "<div class='alert alert-danger'>you enter wrong data</div>";
                				}
                    }else{
                      echo "<div class='alert alert-danger'>something worng, there are empty fields</div>";
                    }
                  }
                ?>
            </div>
        </div>
        <?php include_once APP_PATH."/include/sidebar2.php"; ?>
    </div>
</section>
<?php
include APP_PATH."/include/footer.php";
