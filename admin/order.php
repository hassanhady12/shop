<?php
//manage comment page
//can Edit|Delete|approve
ob_start();
session_start();
$pageTitle='Orders';
if (isset($_SESSION['Username'])) {
  include 'init.php';

$do=isset($_GET['do']) ? $_GET['do'] : 'Manage';

//start manage page
if($do == 'Manage'){ //manage member page

//select user except Admin
$stmt=$con->prepare("SELECT * FROM orders");
//execute statment
$stmt->execute();

//assing to var
$comments=$stmt->fetchAll();
if(! empty($comments)){

?>
<h1 class="text-center">Manage Orders</h1>
<div class="container">
<div class="table-responsive">

<table class="main-table text-center table table-bordered">
<tr>
<td>#ID</td>
<td>name</td>
<td>email</td>
<td>phone</td>
<td>address</td>
<td>product</td>
<td>amount_paid</td>
<td>Control</td>
</tr>
<tr>
      
<?php
foreach($comments as $comment){
echo "<tr>";
echo "<td>".$comment['id']."</td>";
echo "<td>".$comment['name']."</td>";
echo "<td>".$comment['email']."</td>";
echo "<td>".$comment['phone']."</td>";
echo "<td>".$comment['address']."</td>";
echo "<td>".$comment['product']."</td>";
echo "<td>".$comment['amount_paid']."</td>";
echo "<td>
<a href='order.php?do=Delete&comid=".$comment['id']."' class='btn btn-danger confirm'>
<i class='fas fa-times-circle'></i>Delete</a>" ;    
echo "</td>";
echo "</tr>";
}
?>

<tr>
</table>

</div>
</div>

<?php }else{
echo '<div class="container">';
echo '<div class="nice-massage alert alert-info">There\'s No orders To Show</div>';
echo '</div>';
} 
}
?>

<?php

if($do == 'Delete'){ //delete com page
echo "<h1 class='text-center'>Delete Members</h1>";
echo "<div class='container'>";

//cheack if user id is nuber & get int val
$comid=isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;

//select databases depand ID
$check=checkItem("id","orders",$comid);

//if ID rlley Show Form
if($check > 0) { 
  $stmt=$con->prepare("DELETE FROM 
                              orders 
                       WHERE 
                              id = :zid");
$stmt->bindParam(":zid",$comid);
$stmt->execute();
$theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record Deleted</div>';
redirectHome($theMsg,'back');
}else{
$theMsg ='<div class="alert alert-danger">This ID Not Exist</div>';
redirectHome($theMsg);
}
echo "</div>";
}

    include $tpl . 'footer.php';
}else{
    header('Location: index.php');
    exit();
}
ob_end_flush();
?>