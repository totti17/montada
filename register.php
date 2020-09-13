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
            <div class="regiser_page col-xs-12">
                <h3>New User registration</h3>
                <p>Registering on our site will allow you to be a full participant.
                    If you have a problems with registration on Buhta.WS, please contact with me:<a href="mailto:tottimilan2@gmail.com">E-Mail</a>.
                </p>
                <form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                      <div class="form-group">
                      <?php
                        if(isset($_POST['newusers'])){
                          $username  = filterString(get_input('username'));
                          $emails    = filterString(get_input('emails'));
                          $passwrd  = filterString(get_input('passwrd'));
                          $passretyp  = filterString(get_input('passretyp'));
                          //
                          $checkfoundusername = checkfounduser("name",$username);
                          $checkfoundusermail = checkfounduser("email",$emails);
                          //
                          if(!empty($username) AND !empty($passwrd) AND !empty($passretyp) AND !empty($emails)){
                            if($passwrd === $passretyp){
                              if($checkfoundusername == 1){
                                echo "<div class='alert alert-danger'>something worng, this login user is taken try another one</div>";
                                refreshPage('2','register.php');
                              }elseif($checkfoundusermail == 1){
                                echo "<div class='alert alert-danger'>something worng, this email is registerd you can login</div>";
                                refreshPage('2','index.php');
                              }else{
                                  $passwords = sha1($passwrd);
                                  $adding = addnewuser($username,$passwords,$emails);
                                  if($adding === true){
                                      echo "<div class='alert alert-success'>User has been registerd successfully.</div>";
                                      refreshPage('2','index.php');
                                  }else{
                                      echo "<div class='alert alert-danger'>something wrong, try again</div>";
                                      refreshPage('2','register.php');
                                  }
                                }
                            }else{
                                echo "<div class='alert alert-danger'>something worng, there are empty fields</div>";
                                refreshPage('2','register.php');
                            }
                          }else{
                            echo "<div class='alert alert-danger'>something worng, there are empty fields</div>";
                          }
                        }
                      ?>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-2">
                        <label>login: </label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" name="username"  />
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-2">
                        <label>emails: </label>
                      </div>
                      <div class="col-md-8">
                        <input type="email" name="emails"  />
                      </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                          <label>password: </label>
                        </div>
                        <div class="col-md-8">
                          <input type="password" name="passwrd"  />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label>Retype password: </label>
                        </div>
                        <div class="col-md-8">
                            <input type="password" name="passretyp"  />
                        </div>
                    </div>
                    <div class="form-group">
                      <input type="submit" name="newusers" class="btn btn-secondary" name="subma" value="register">
                    </div>
                </form>
            </div>
        </div>
        <?php include_once APP_PATH."/include/sidebar2.php"; ?>
    </div>
</section>

<?php
include APP_PATH."/include/footer.php";
