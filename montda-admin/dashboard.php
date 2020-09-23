<?php include "init.php"; ?>
<div id="dashboard" class="col-xs-12 dashboard_page">
  <?php
    require_once APP_PATH."/include/navbar.php";
    $do = isset($_GET['do']) ? $_GET['do'] : "default";
    if($do == "default"){
  ?>
      <div class="col-md-10 col-xs-12">
        <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title text-center">
                    <h2>جميع المقالات</h2>
                </div>
                <div class="x_content col-xs-12">
                  <table class="table" dir="rtl">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>العنوان</th>
                        <th>وصف</th>
                        <th>القسم</th>
                        <th>تاريخ</th>
                        <th>الامر</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        //
                        $stats = $connect->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT 10");
                        $stats->execute();
                        $i = 1;
                        $allposts = $stats->fetchAll();
                        //
                        foreach ($allposts as $posts){
                      ?>
                       <tr>
                          <th scope="row"><?php echo $i; ?></th>
                          <td><?php echo $posts['title']; ?></td>
                          <td><?php echo substr(strip_tags($posts['descrip']),0,150); ?></td>
                          <td><?php echo singCheck('category','id',$posts['cats_id'],'name') ?></td>
                          <td><?php echo $posts['datts']; ?></td>
                          <td>
                              <a class="btn btn-danger" href="dashboard.php?do=delpost&id=<?php echo $posts['id']; ?>">
                                  <i class="fa fa-times"></i>
                              </a>
                            </td>
                        </tr>
                    <?php
                          $i++;
                      }
                     ?>
                    </tbody>
                </table>
                </div>
            </div>
      </div>
  <?php
}elseif($do == "posts"){
?>
<div class="all_posts col-md-10 col-xs-12">
  <div class="x_panel tile fixed_height_320 overflow_hidden">
          <div class="x_title">
              <h2>جميع المقالات</h2>
              <a href="dashboard.php?do=addpost" class="btn btn-info pull-left">إضافة مقالة</a>
          </div>
          <div class="x_content col-xs-12">
            <table class="table" dir="rtl">
              <thead>
                <tr>
                  <th>#</th>
                  <th>العنوان</th>
                  <th>وصف</th>
                  <th>القسم</th>
                  <th>تاريخ</th>
                  <th>الامر</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  //
                  $stats = $connect->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT 10");
                  $stats->execute();
                  $i = 1;
                  $allposts = $stats->fetchAll();
                  //
                  foreach ($allposts as $posts){
                ?>
                 <tr>
                    <th scope="row"><?php echo $i; ?></th>
                    <td><?php echo $posts['title']; ?></td>
                    <td><?php echo substr(strip_tags($posts['descrip']),0,150); ?></td>
                    <td><?php echo singCheck('category','id',$posts['cats_id'],'name') ?></td>
                    <td><?php echo $posts['datts']; ?></td>
                    <td>
                        <a class="btn btn-danger" href="dashboard.php?do=delpost&id=<?php echo $posts['id']; ?>">
                            <i class="fa fa-times"></i>
                        </a>
                      </td>
                  </tr>
              <?php
                    $i++;
                }
               ?>
              </tbody>
          </table>
          </div>
      </div>
</div>
<?php
}elseif($do == "addpost"){
    $allcategorys = fetchtables("category");
?>
  <div class="add_post col-md-10 col-xs-12">
    <div class="x_panel tile fixed_height_320 overflow_hidden">
      <div class="x_title">
        <h3>إضافة مقالة</h3>
      </div>
      <div>
        <?php
        if(isset($_POST['add_post'])){
            $titles         = filterString(get_input('titles'));
            $contents       = post('contents');
            $category       = filterIntegar(get_input('category'));
            $vipstatus      = filterIntegar(get_input('vipstatus'));
            $products       = post('product');
            //
            $imgdirectory   = "../layout/img/posts";
            $thumbns        = $_FILES['thumbns']['name'];
            $thumbns_tmp    = $_FILES['thumbns']['tmp_name'];
            //
            $numbers = time();
            //
            $imgprofiles = preg_replace("#[^a-z.0-9]#",'',$thumbns);
            $expl1 = explode(".",$imgprofiles);
            $exe1 = end($expl1);
            $imgprofiles = time().rand().".".$exe1;

            $file_extension = pathinfo($_FILES["thumbns"]["name"], PATHINFO_EXTENSION);
            $allowedExts = array(
                 "png",
                 "jpg",
                 "jpeg"
             );
             //
             if(!empty($titles) AND !empty($contents) AND !empty($category) ){
                if(in_array($file_extension, $allowedExts)){
                    $addpost = addingpost($titles,$contents,$category,$vipstatus,$imgprofiles,$numbers);
                    if($addpost === true){
                          //
                          $_SESSION['numbers'] = 0;                         //
                          $_SESSION['messag'] = "";
                          foreach ((array)$products AS $data) {
                              global $connect;
                              $numburs    = $numbers;
                              $text        = filterString($data['text']);
                              $url        = filterString($data['url']);
                              if(!empty($text) AND  !empty($url)){
                                $statt2     = $connect->prepare("INSERT INTO post_links
                                (names,url,numbers)
                                VALUES
                                (:ztext,:zurl,:znumbs)
                                ");
                                $statt2->execute(array(
                                    "ztext"       => $text,
                                    "zurl"        => $url,
                                    "znumbs"       => $numburs
                                ));
                                if($statt2->rowCount() > 0){
                                  $_SESSION['numbers'] = 1;
                                }else{
                                    $_SESSION['numbers'] = 0;
                                }
                              }else{
                                $_SESSION['messag'] = "<div class='alert alert-danger'>لم يتم اضافة اي روابط</div>";
                              }
                         }
                         //
                         if($_SESSION['numbers'] == 0){
                            echo "<div class='alert alert-danger'>لم يتم الاضافة , حدثت مشكلة</div>";
                            echo $_SESSION['messag'];
                            refreshPage(1,'dashboard.php');
                         }else{
                          echo "<div class='alert alert-success'>تم اضافتها بنجاح</div>";
                          move_uploaded_file($thumbns_tmp,"$imgdirectory/$imgprofiles");
                          echo $_SESSION['messag'];
					                 refreshPage(1,'dashboard.php');
                         }
                      }else{
                          echo "<div class='alert alert-danger'>لم يتم الاضافة , حدثت مشكلة</div>";
                          refreshPage(1,'dashboard.php');
                      }
                }else{
                  echo "<div class='alert alert-danger'>صيغة الصورة غير مدعومة</div>";
                }
             }else{
               echo "<div class='alert alert-danger'>لا تترك اي حقل فارغا</div>";
             }
        }
        ?>
      </div>
      <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>?do=addpost" method="post" enctype="multipart/form-data">
            <div class="form-group">
                  <label>عنوان المقالة</label>
                  <input type="text" class="form-control" name="titles" value="">
            </div>
            <div class="form-group">
                    <label>القسم</label>
                    <select class="form-control" name="category">
                      <?php
                        foreach($allcategorys as $categs){
                      ?>
                          <option value="<?php echo $categs['id']; ?>"><?php echo $categs['name']; ?></option>
                      <?php
                        }
                      ?>
                    </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="vipstatus">
                    <option value="0">الاعضاء المسجلين</option>
                    <option value="1">أعضاء Vip</option>
                </select>
            </div>
            <div class="form-group">
                  <label>محتوى المقالة</label>
                  <textarea id="trumbowyg-posts" rows="15" class="col-xs-12" name="contents"></textarea>
            </div>
            <div class="form-group">
                <label>صورة المقالة</label>
                <input type="file" name="thumbns" />
            </div>
            <div class="form-group">
              <label for="">الروابط</label>
    					<table border="0" cellpadding="3" cellspacing="1" class="table table_add">
                    <thead>
                       <tr>
                          <td align="center">الرقم</td>
                          <td align="center">النص</td>
                          <td align="center">الرابط</td>
                          <td align="center">الاكشن</td>
                        </tr>
                    </thead>
                    <tbody>
            		<tr id="tr_1">
                        <input type="hidden" name="p_1" value="true" />
                        <td align="center" class="snn">1</td>
                        <td align="center">
                          <input name="product[1][text]" class="form-control" type="text" size="1" value="">
                        </td>
                        <td align="center">
                          <input name="product[1][url]" class="form-control" type="text" size="22">
                        </td>
                        <td align="center">
                          <input type="button" class="btn btn-danger" onclick="removepr(1)" value="حــذف">
                        </td>
                       </tr>
                  </tbody>
              </table>
              <div class="addnew text-center">
                <input type="button" onclick="addnew()" value="إضغط هنا لأضافة رابط جديد" class="btn btn-secondary">
              </div>
    				   <!-- end Start Product list -->
             </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-lg" name="add_post" value="اضافة المقالة">
            </div>
      </form>
    </div>
  </div>
<?php
}elseif ($do == "delpost") {
  $id = filterIntegar(intval($_GET['id']));
  if($id != ''){
      global $connect;
      //
      $stat = $connect->prepare("SELECT * FROM posts WHERE id = ?");
      $stat->execute(array($id));
      $posts =  $stat->fetch();
      //
      $numbers = $posts['numbers'];
      $images  = $posts['images'];
      //
      $statss = $connect->prepare("DELETE FROM posts WHERE id = ?");
      $statss->execute(array($id));
      //
      $statss2 = $connect->prepare("DELETE FROM post_links WHERE numbers = ?");
      $statss2->execute(array($numbers));
      //
      if($statss->rowCount() > 0 AND $statss2->rowCount() > 0){
        unlink("../layout/img/posts/".$images);
        echo "<script>alert('تم الحذف بنجاح');</script>";
          refreshPage(1,'dashboard.php');
      }else{
        echo "<script>alert('حدث خطأ في الحذف');</script>";
          refreshPage(1,'dashboard.php');
      }
  }else{
    refreshPage(1,'dashboard.php');
  }

}elseif($do == "categs"){
  $allcategorys = fetchtables("category");
?>
  <div class="allcategory col-md-10 col-xs-12">
    <div class="x_panel tile fixed_height_320 overflow_hidden">
      <div class="x_title">
        <h2>جميع الأقسام</h2>
        <a href="dashboard.php?do=addcateg" class="btn btn-info pull-left"><i class="fa fa-pencil"></i> إضافة قسم جديد</a>
      </div>
      <div class="contents">
          <ul class="nav">
            <?php
              foreach($allcategorys as $categs){
            ?>
              <li>
                <?php echo $categs['name']; ?>
                <a class="btn btn-danger pull-left" href="dashboard.php?do=delcateg&id=<?php echo $categs['id']; ?>">
                  <i class="fa fa-times"></i>
                </a>
              </li>
              <?php
            }
              ?>
          </ul>
    </div>
    </div>
  </div>
<?php
}elseif ($do == "addcateg") {
  if(isset($_POST['add_categs'])){
        $names = filterString(get_input('names'));
        if(!empty($names)){
          $addcategs =  addCategs($names);
          if($addcategs === true){
              echo "<div class='alert alert-success'>تم اضافة القسم بنجاح</div>";
          }else{
              echo "<div class='alert alert-danger'>حدث خطأ في اضافة القسم</div>";
          }
        }else{
          echo "<div class='alert alert-danger'>لا تترك اسم القسم فارغا</div>";
        }
  }
?>
<div class="allcategory col-md-10 col-xs-12">
  <div class="x_panel tile fixed_height_320 overflow_hidden">
    <div class="x_title">
      <h3>إضافة قسم</h3>
      <a href="dashboard.php?do=addcateg"><i class="fa fa-pencil"></i> إضافة قسم جديد</a>
    </div>
    <div class="contents">
      <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>?do=addcateg" method="post">
          <div class="form-group">
              <input type="text" class="form-control" name="names" placeholder="اسم القسم" />
          </div>
          <div class="form-group">
              <input type="submit" class="btn btn-primary" name="add_categs" value="إضافة" />
          </div>
      </form>
  </div>
  </div>
</div>
<?php
}elseif ($do == "delcateg") {
  // code...
}elseif ($do == "logout") {
  session_start();

  session_unset();

  session_destroy();
  header("Location: index.php");
  exit(0);
}else{

}
  ?>
</div>
<?php include APP_PATH."/include/footer.php"; ?>
