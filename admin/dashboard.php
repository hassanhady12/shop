<?php
ob_start(); //output buffering start
session_start();
$pageTitle='Dashbord';
include 'init.php';

if (isset($_SESSION['Username'])) {
//start dashbord page
$numUsers=6; //number last user
$latestUsers=getLatest("*","users","UserID",$numUsers);
$numItems=6; //number last item
$latesItem=getLatest("*","items","Item_ID",$numItems);
$numcomment=4;
?>

<div class="home-stats">
<div class="container  text-center">
<h1>Dashbord</h1>
<div class="row">

<div class="col-md-3">
<div class="stat st-members">
<i class="fa fa-users"></i>
<div class="info">
Total Members
<span>
<a href="members.php"><?php echo countItems('UserID','users'); ?></a>
</span>
</div>
</div>
</div>

<div class="col-md-3">
<div class="stat st-pending">
<i class="fa fa-plus"></i>
<div class="info">   
Peding Members
<span>
<a href="members.php?do=Manage&page=Pending"><?php echo  checkItem('RegStatus','users',0); ?></a>
</span>
</div> 
</div>
</div>


<div class="col-md-3">
<div class="stat st-items">
<i class="fa fa-tag"></i>
<div class="info">    
Total Items
<span> 
<a href="items.php"><?php echo countItems('Item_ID','items'); ?></a>
</span>
</div>
</div>
</div>


<div class="col-md-3">
<div class="stat st-comments">
<i class="fa fa-comments"></i>
<div class="info">   
Total Comments
<span>
<a href="comments.php"><?php echo countItems('c_id','comments'); ?></a>
</span>
</div>
</div> 
</div>

<div class="col-md-3">
<div class="stat st-order">
<i class="fa fa-bell"></i>
<div class="info">   
Total orders
<span>
<a href="order.php"><?php echo countItems('id','orders'); ?></a>
</span>
</div>
</div> 
</div>

</div>
</div>
</div>

<div class="latest">
<div class="container">
<div class="row">

<div class="col-sm-6">
<div class="panel panel-default">

<div class="panel-heading">
<i class="fa fa-users"></i>Latest <?php echo $numUsers; ?> Registerd Users
<span class="toggle-info pull-right">
<i class="fa fa-plus fa-lg"></i>
</span>
</div>

<div class="panel-body">
<ul class="list-unstyled latest-users">
<?php
if(! empty($latestUsers)){
foreach($latestUsers as $user){
echo '<li>';
echo $user['Username'];
echo '<a href="members.php?do=Edit&userid='. $user['UserID'] .'">';
echo '<span class="btn btn-success pull-right">';
echo '<i class="fa fa-edit">Edit</i>';
if($user['RegStatus'] == 0) {
echo "<a href='members.php?do=Activate&userid=".$user['UserID']."'
class='btn btn-info pull-right activet'>
<i class='fa fa-check'></i>Activate</a>";
}  
echo '</span>';
echo '</a>';
echo '</li>';
}        
}else{
echo 'There\'s No users To Show';
}
?>
</ul>
</div>

</div>
</div>
        
<div class="col-sm-6">
<div class="panel panel-default">
<div class="panel-heading">
<i class="fa fa-tag"></i>Latest <?php echo $numItems; ?> Registerd Items
<span class="toggle-info pull-right">
<i class="fa fa-plus fa-lg"></i>
</span>
</div>

<div class="panel-body">
<ul class="list-unstyled latest-users">
<?php
if(! empty($latesItem)){
foreach($latesItem as $item){
echo '<li>';
echo $item['Name'];
echo '<a href="items.php?do=Edit&itemid='. $item['Item_ID'] .'">';
echo '<span class="btn btn-success pull-right">';
echo '<i class="fa fa-edit">Edit</i>';
if($item['Approve'] == 0) {
echo "<a href='items.php?do=Approve&itemid=".$item['Item_ID']."' 
class='btn btn-info pull-right activet'>
<i class='fa fa-check'></i>Approve</a>";
}  
echo '</span>';
echo '</a>';
echo '</li>';
}
}else{
echo 'There\'s No item To Show';
}
?>
</ul>
</div>

</div>
</div>
</div>

<!-- Start Latest Comments -->
<div class="row">
<div class="col-sm-6">
<div class="panel panel-default">

<div class="panel-heading">
<i class="fa fa-comments-o"></i> 
Latest <?php echo $numcomment ?> Comments 
<span class="toggle-info pull-right">
<i class="fa fa-plus fa-lg"></i>
</span>
</div>

<div class="panel-body">
<?php
$stmt = $con->prepare("SELECT 
comments.*, users.Username AS Member  
						   FROM 
							  comments
						   INNER JOIN 
							  users 
						   ON 
							  users.UserID = comments.user_id
						   ORDER BY 
							  c_id DESC
				    		LIMIT $numcomment");

$stmt->execute();
$comments = $stmt->fetchAll();

if (! empty($comments)) {
foreach ($comments as $comment) {
echo '<div class="comment-box">';
echo '<span class="member-n">
<a href="members.php?do=Edit&userid=' . $comment['user_id'] . '">
' . $comment['Member'] . '</a></span>';
echo '<p class="member-c">' . $comment['comment'] . '</p>';
echo '</div>';
}
} else {
echo 'There\'s No Comments To Show';
}
?>
</div>

</div>
</div>
</div>
<!-- End Latest Comments -->

</div>
</div>        
<?php

//end dashbord page

include $tpl . 'footer.php';
}else{
header('Location: index.php');
exit();
}
ob_end_flush();
?>