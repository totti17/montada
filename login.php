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
            <div class="login_page col-xs-12">
                <?php
                  if(isset($_POST['loginsenter'])){
                    $login_email      = filterEmail(get_input('login_email'));
                    $login_password   = filterString(get_input('login_password'));
                    if(!empty($login_email) AND !empty($login_password)){

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
