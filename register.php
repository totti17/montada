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
            <div class="regiser_page col-xs-12">
                <h3>New User registration</h3>
                <p>Registering on our site will allow you to be a full participant.
                    If you have a problems with registration on Buhta.WS, please contact with me:<a href="mailto:tottimilan2@gmail.com">E-Mail</a>.
                </p>
                <form class="form" method="post" action="register.php">
                    <div class="form-group">
                        <label>login: </label>
                        <input type="text" name="username"  />
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                          <label>password: </label>
                        </div>
                        <div class="col-md-8">
                          <input type="password" name="passwrd"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Retype password: </label>
                        <input type="password" name="passretyp"  />
                    </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-secondary" name="subma" value="register">
                    </div>
                </form>
            </div>
        </div>
        <?php include_once APP_PATH."/include/sidebar2.php"; ?>
    </div>
</section>

<?php
include APP_PATH."/include/footer.php";
