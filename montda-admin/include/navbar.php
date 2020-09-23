  <?php
    $emails = $_SESSION['adminsclients'];
    $adminusers = fethusersinfo('email',$emails);
  ?>
    <div class="navbaradmins col-md-2 col-sm-4">
        <header id="headerSite" class="text-center">
            <a href="dashboard.php">
                <img src="layout/img/profile.png" width="150px" alt="" />
            </a>
            <p>
                <i class="fa fa-user"></i> الادمن : <?php echo $adminusers['name']; ?>
            </p>
        </header>
        <!-- start of navbar -->
        <nav class="navbar navbar-dashboard">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbarMenu">
              <ul class="nav navbar-nav">
                <li>
                  <a href="dashboard.php?do=posts" class="dropdown-toggle">المقالات<i class="fa fa-file-text-o"></i></a>
                </li>
                <li>
                  <a href="dashboard.php?do=categs" class="dropdown-toggle">الأقسام<i class="fa fa-tags"></i></a>
                </li>
                <li><a target="_blank">الصفحات <i class="fa fa-building-o"></i></a></li>
                <li><a href="members.php"><i class="fa fa-user"></i> الأعضاء</a></li>
                <li><a href="logout.php"><i class="fa fa-gear"></i> تسجيل الخروج</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </div>
