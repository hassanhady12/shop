<?php
ob_start();
session_start();
$pageTitle='Show Items';
 include 'init.php';
  //cheack if userid is nuber & get int val
  $itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
  //select databases depand ID
  $stmt=$con->prepare("SELECT
                            items.*,
                            categories.Name AS category_name,
                            users.Username 
                       FROM 
                            items 
                       INNER JOIN 
                            categories
                       ON 
                            categories.ID=items.Cat_ID 
                       INNER JOIN 
                            users 
                       ON 
                            users.UserID=items.Member_ID
                       WHERE 
                            Item_ID=?
                       AND
                            Approve=1 ");
  //execute qure
  $stmt->execute(array($itemid));
  $count=$stmt->rowCount();
  if($count>0){
  //fatch data
  $item=$stmt->fetch();
 ?>
 <h1 class="text-center"><?php echo $item['Name'] ?></h1>
 <div class="container">
 <div class="row">
 <div class="col-md-3">
 <?php
  echo "<img 
  class='img-responsive img-thumbnail center-block'
   style='height:240px; width: 240px;' src='./admin/uploads/image/".$item['Image']."' alt=''>" ; 
   ?> 
 </div>
 <div class="col-md-9 item-info">
 <h2><?php echo $item['Name'] ?></h2>
<ul class="list-unstyled">

<li>
      <i class="fa fa-audio-description fa-fw"></i>
      <span>ألوصف</span> : <?php echo $item['Description'] ?>
     </li>
     
 <li>
      <i class="fa fa-tag fa-fw"></i>
      <span>ألسعر</span> : $<?php echo $item['Price'] ?>
     </li>

     <li>
      <i class="fa fa-store fa-fw"></i>
      <span>حاله المنتج</span> : <?php echo $item['Status'] ?>
     </li>

 <li>
      <i class="fa fa-cat"></i>
      <span>قسم</span> : <a href="categories.php?pageid=<?php echo $item['Cat_ID'] ?>"> <?php echo $item['category_name'] ?></a>
     </li>
 <li>
      <i class="fa fa-user fa-fw"></i>
      <span>أسم المضيف</span> : <a href="#"> <?php echo $item['Username'] ?></a>
     </li>
     <li class="tags-items">
      <i class="fa fa-user fa-fw"></i>
      <span>Tags</span> :
      <?php
       $allTags=explode(",",$item['tags']);
       foreach($allTags as $tag){
          $tag=str_replace(' ','',$tag);
          $lowertag=strtolower($tag);
          if(! empty($tag)){
               
            echo "<a href='tags.php?name={$lowertag}'>". $tag .'</a>';
       }
     }
      ?>
     </li>
 </ul>
 </div>
 </div>
 <hr class="custom-hr">
 <div class="row">
      <div class="col-md-offset-3">
           <?php if(isset($_SESSION['user'])){ ?>
           <!--start add comment-->
           <div class="add-comment">
           <h3>اضف تعليق</h3>
           <form action="<?php echo $_SERVER['PHP_SELF'] . '?itemid=' . $item['Item_ID'] ?>" method="POST">
                <textarea name="comment" required></textarea>
                <input class="btn btn-primary" type="submit" value="اضافه التعليق">
           </form>
           <?php
           if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $comment =filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
                $itemid  =$item['Item_ID'];
                $userid  =$_SESSION['uid'];
                if(! empty($comment)){
                     $stmt=$con->prepare("INSERT INTO 
                              comments(comment,status,comment_date,item_id,user_id)
                                         VALUES(:zcomment,0,NOW(),:zitemid,:zuserid)");
                    $stmt->execute(array(
                         'zcomment' =>$comment,
                         'zitemid' =>$itemid,
                         'zuserid' =>$userid
                    ));
                    if($stmt){
                         echo '<div class="alert alert-success">تمت اضافه تعليق</div>';
                    }
                }
           }
           ?>
           </div>
      </div>
 </div>
 <!--end add comment-->
           <?php }else{
                echo '<a href="login.php">أدخل</a> أو <a href="login.php">سجل</a> سجل لأضافه تعليق للمنتج';
           } ?>
 <hr class="custom-hr">
 <?php
         //select user except Admin
    $stmt=$con->prepare("SELECT 
                             comments.*,users.Username As Member ,
                                        users.avatar AS avatar
                         FROM 
                             comments
                         INNER JOIN
                              users
                         ON
                              users.UserID=comments.user_ID
                         WHERE
                              item_id=?
                         AND
                              status=1
                         ORDER BY
                              c_id DESC");
//execute statment
$stmt->execute(array($item['Item_ID']));
//assing to var
$comments=$stmt->fetchAll();
      ?>
 
<?php foreach($comments as $comment){ ?>
<div class="comment-box">
     <div class="row">
     <div class="col-sm-2 text-center">
     <?php 
     if(empty($comment['avatar'])){
          echo '<img class="img-responsive img-thumbnail img-circle center-block" src="layout/imags/emp.jpg" alt="">';
     }else{
     echo "<img class='img-responsive img-thumbnail img-circle center-block' src='./admin/uploads/avatar/".$comment['avatar']."' alt=''>";
     }
     ?>
     <?php echo $comment['Member'] ?></div>
     <div class="col-sm-10">
    <p class="lead"><?php echo $comment['comment'] ?></p>
     </div>
     </div>
     </div>
     <hr class="custom-hr" >
<?php } ?>
 </div>
<?php
  }else{
      echo '<div class="container">';
      echo '<div class="alert alert-danger">انتضر تفعيل او IDغير موجود</div>';
      echo '</div>';
  }
 include $tpl . 'footer.php'; 
 ob_end_flush();
  ?>  