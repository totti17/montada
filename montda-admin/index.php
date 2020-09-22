<?php
  include "init.php";
  checkadminlogin();
?>
<div class="admin_logins container">
      <div class="col-md-4 col-md-offset-4">
        <div class="formcontct">
              <div class="heads col-md-12">
                  <h3>Admin Area</h3>
              </div>
              <form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group row">
                        <div class="col-md-8 text-left">
                          <input type="emails" name="login_user" class="login_fields" />
                        </div>
                        <div class="col-md-4">
                          <label for="login_name">Login: </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8 text-left">
                          <input type="password" name="login_password" class="login_fields" />
                        </div>
                        <div class="col-md-4">
                            <label for="login_password">Password:	</label>
                        </div>
                    </div>
                    <div class="form-group">
                      <input type="submit" name="loginadmins" title="log in Admin Area" class="btn btn-primary btn-block" value="log in" />
                    </div>
                    <div class="msgge_errors">
                        <?php
                        if(isset($_POST['loginadmins'])){
                          $login_user     = filterString(get_input('login_user'));
                          $login_password   = filterString(get_input('login_password'));
                          //
                          $password = sha1($login_password);
                          //
                          $user = fethuseradmins("name","passwords",$login_user,$password);
                          //
                          if(!empty($login_user) AND !empty($login_password)){
                            if($user['name'] == $login_user AND $user['passwords'] == $password){
                                //session
                                $_SESSION['adminsclients'] = $user['email'];
                                echo "<div class='alert alert-success'>you logged in successfully.</div>";
                                  refreshPage(1,'dashboard.php');
                              }else{
                                echo "<div class='alert alert-danger'>you enter wrong data</div>";
                              }
                          }else{
                            echo "<div class='alert alert-danger'>something worng, there are empty fields</div>";
                          }
                        }
                        ?>
                    </div>
              </form>
        </div>
      </div>
</div>
<?php include APP_PATH."/include/footer.php"; ?>
