<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    	<meta name="viewport" content="width=device-width, initial-scale=1" />
    	<title>Montada</title>
    	<!-- bootstrap css -->
		<link rel="stylesheet" type="text/css" href="layout/css/bootstrap.min.css" />
		<!-- font-aweasome css -->
		<link rel="stylesheet" type="text/css" href="layout/css/font-awesome.min.css">
		<!-- custom style -->
		<link rel="stylesheet" href="layout/css/trumbowyg.min.css" />
		<link rel="stylesheet" type="text/css" href="layout/css/style.css" />
		<!-- -->
	</head>
	<body>
      <section class="main_wrapper col-xs-12">
          <header class="headers col-xs-12">
              <div class="inners">
                  <div class="logos">
                      <a href="/montada"><img src="layout/img/logo.png" alt="" /></a>
                  </div>
                  <!-- end of logos -->
									<?php if(!isset($_SESSION['userlogin'])){ ?>
                  <div class="forms">
		                      <form class="form" method="post" action="login.php">
		                            <div class="form-group">
		                              <label for="login_name">Login: </label>
		                              <input type="emails" name="login_user" class="login_fields" />
		                            </div>
		                            <div class="form-group">
		                              <label for="login_password">Password:	</label>
		                              <input type="password" name="login_password" class="login_fields" />
		                            </div>
		                            <div class="form-group">
		                              <a class="lostpassword" href="/montada/lostpassword">Lost<br>password?</a>
		                              <button class="btn btn-info" name="loginsenter" type="submit" title="Enter" class="zbutton">Enter</button>
		                            </div>
		                            <div class="form-group">
		                            </div>
		                            <div class="form-group">
		                              <button onclick="location.href='/montada/register.php'" type="button" title="Signup" class="zbutton2 btn-block">Signup</button>
		                            </div>
		                      </form>
		                </div>
										<?php
											}else{
						            $emails  = $_SESSION['userlogin'];
						            $usersinf = fethuser1vals('email',$emails);
										?>
											<div class="headsprof row">
													<div class='img col-md-6'>
															<img src="<?php if(!empty($usersinf['images'] or $usersinf['images'] != '')){echo "layout/img/avatars/".$usersinf['images'];}else{ echo 'layout/img/user.png'; } ?>" alt="">
													</div>
													<div class="links col-md-5">
															<strong>Hi, <?php echo $usersinf['name']; ?></strong>
															<ul class="nav">
																	<li><a href="index.php?do=profile">Profile</a></li>
																	<li><a href="index.php?do=logout">Exit</a></li>
															</ul>
													</div>
											</div>

										<?php
											}
										?>
            </div>
          </header>
          <!-- end of headers -->
