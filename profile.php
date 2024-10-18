<?php
ob_start();
session_start();
$pageTitle='Profile';
 include 'init.php';
 if(isset($_SESSION['user'])){
     $getUser=$con->prepare("SELECT * FROM users WHERE Username=? ");
     $getUser->execute(array($sessionUser));
     $info=$getUser->fetch();
     $userid=$info['UserID'];
 ?>
 <h1 class="text-center">معلومات لبيع منتجات</h1>
<div class="information block">
     <div class="container">
     <div class="panel panel-primary">
        <div class="panel-heading">معلوماتي</div>
            <div class="panel-body">
     <ul class="list-unstyled">
    <li>
        <i class="fa fa-unlock-alt fa-fw"></i>
        <span>أسم ألدخول :</span> <?php echo $info['Username'] ?>
    </li>
    <li>
        <i class="fa fa-envelope fa-fw"></i>
        <span> Email:</span> <?php echo $info['Email'] ?>
    </li> 
    <li>
        <i class="fa fa-user fa-fw"></i>
        <span> الاسم كامل :</span><?php echo $info['FullName'] ?>
    </li> 
    <li>
        <i class="fa fa-calendar fa-fw"></i>
        <span> وقت التسجيل :</span> <?php echo $info['Date'] ?>
    </li> 
     </ul>
          </div>
        </div>
    </div>
</div>

<div id="my-ads" class="my-ads block">
     <div class="container">
     <div class="panel panel-primary">
        <div class="panel-heading">منتجاتي</div>
            <div class="panel-body">
        
<?php
$myIteems=getAllFrom("*","items","where Member_ID=$userid","","Item_ID");
if(! empty($myIteems)){
    echo '<div class="row">';
foreach($myIteems as $items){
    echo '<div class="col-sm-6 col-md-3">';
    echo '<div class="thumbnail item-box">';
    if($items['Approve'] == 0) {echo '<span class="approve-status">أنتظر تفعيل الادارة</span>';}
    echo '<span class="price-tag">$'.$items['Price'] .'</span>';
    if(empty($items['Image'])){
        echo '<img src="layout/imags/emp.jpg" alt="">';
    }else{
    echo "<img class='img-responsive' src='./admin/uploads/image/".$items['Image']."' alt=''>";
    }
    echo '<div class="caption">';
    echo '<h3><a href="items.php?itemid='.$items['Item_ID'].'">'.$items['Name'].'</a></h3>';
    echo '<p>'.$items['Description'] .'</p>';
    echo '<div class="date">'.$items['Add_Date'] .'</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
    echo '</div>';
}else{
    echo 'لايوجد منتجات لعرضها<a href="newad.php">اضافه منتج</a>';
}
?>
</div>
          </div>
        </div>
    </div>
</div>

<div class="my-comments block">
     <div class="container">
     <div class="panel panel-primary">
        <div class="panel-heading">اخر تعليقات </div>
            <div class="panel-body">
      <?php
 $myComments=getAllFrom("comment","comments","where user_id = $userid","","c_id");     
if(! empty($myComments)){
foreach($myComments as $comment){
    echo '<p>'. $comment['comment'].'</p>';
}
}else{
    echo 'لايوجد تعليقات لعرضها';
}
      ?>
          </div>
        </div>
    </div>
</div>
<?php
 }else{
     header('Location:login.php');
     exit();
 }
 include $tpl . 'footer.php'; 
 ob_end_flush();
 ?> 