<?php
//manage member page
//can Add|Edit|Delete
ob_start();
session_start();
$pageTitle='Members';
if (isset($_SESSION['Username'])) {
include 'init.php';

$do=isset($_GET['do']) ? $_GET['do'] : 'Manage';

//start manage page
if($do == 'Manage'){ //manage member page
$query='';
if(isset($_GET['page']) && $_GET['page'] == 'Pending'){
$query='AND RegStatus=0';
}

//select user except Admin
$stmt=$con->prepare("SELECT * FROM users WHERE  GroupID !=1 $query ORDER BY UserID DESC");

//execute statment
$stmt->execute();

//assing to var
$rows=$stmt->fetchAll();
if(! empty($rows)){
?>

<h1 class="text-center">Manage Members</h1>
<div class="container">

<div class="table-responsive">
<table class="main-table manage-members text-center table table-bordered">
<tr>
<td>#ID</td>
<td>Avatar</td>
<td>username</td>
<td>Email</td>
<td>Full Name</td>
<td>Regsterd Date</td>
<td>Control</td>
</tr>
<tr>
      
<?php
foreach($rows as $row){
echo "<tr>";
echo "<td>".$row['UserID']."</td>";
echo "<td>";
if(empty($row['avatar'])){
echo 'No Image';
}else{
echo "<img src='uploads/avatar/".$row['avatar']."' alt=''>";
}
echo"</td>";
echo "<td>".$row['Username']."</td>";
echo "<td>".$row['Email']."</td>";
echo "<td>".$row['FullName']."</td>";
echo "<td>".$row['Date']."</td>";
echo "<td>
<a href='members.php?do=Edit&userid=".$row['UserID']."' class='btn btn-success'><i class='fa fa-edit'></i>Edit</a> 
<a href='members.php?do=Delete&userid=".$row['UserID']."' class='btn btn-danger confirm'><i class='fas fa-times-circle'></i>Delete</a>" ;
if($row['RegStatus'] == 0) {
echo "<a 
href='members.php?do=Activate&userid=".$row['UserID']."' 
class='btn btn-info activet'>
<i class='fas fa-check'></i>Activate</a>";
}      
echo "</td>";
echo "</tr>";
}
?>
<tr>
</table>
</div>

<a href="members.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i>  New Members</a>

</div>
    
<?php }else{
echo '<div class="container">';
echo '<div class="nice-massage alert alert-info">There\'s No Members To Show</div>';
echo '<a href="members.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i>  New Members</a>';
echo '</div>';
} 
?>

<?php }elseif($do == 'Add'){   //Add members page ?>
<h1 class="text-center">Add New Member</h1>
<div class="container">

<form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">

<!--user name -->
<div class="form-group form-group-lg">
<label class="col-sm-2  control-label">Username</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="username" 
class=" form-control" required="required"  
autocomplete="off" 
placeholder="Username To Login Shop" >
</div>
</div>
<!--user name -->

<!-- password -->
<div class="form-group form-group-lg"> 
<label class="col-sm-2 control-label">Password</label>
<div class="col-sm-10 col-md-6">
<input type="password" name="password" 
class="password form-control" required="required"  
autocomplete="new-password" 
placeholder="Password Must Be Hard & Complex">
<i class="show-pass fa fa-eye fa-2x"></i>
</div>
</div>
<!--password -->

<!--Email -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Email</label>
<div class="col-sm-10 col-md-6">
<input type="email" name="email" 
class="form-control" required="required" 
placeholder="Email Must Be Valed" >
</div>
</div>
<!--Email -->

<!--Full name -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Full Name</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="full" 
class="form-control" 
required="required" 
placeholder="Full Name In Your Profile Page" >
</div>
</div>
<!--Full name -->

<!--avatar -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">User Avatar</label>
<div class="col-sm-10 col-md-6">
<input type="file" name="avatar" 
class="form-control" 
required="required">
</div>
</div>
<!--avatar -->

<!--user submit -->
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<input type="submit" value="Add members" class="btn btn-primary btn-lg">
</div>
</div>
<!--user submit -->

</form>
</div>
           
<?php
}elseif($do =='Insert'){

//insert member page
if($_SERVER['REQUEST_METHOD'] == 'POST'){
echo "<h1 class='text-center'>Insert Member</h1>";
echo "<div class='container'>";

//Upload var
$avatarName  =$_FILES['avatar']['name'];
$avatarSize  =$_FILES['avatar']['size'];
$avatarTmp   =$_FILES['avatar']['tmp_name'];
$avatarType  =$_FILES['avatar']['type'];
$avatarerror =$_FILES['avatar']['error'];

//allow file type upload
$avatarAllowedExtension=array("jpeg","jpg","png","gif");

//get avatar extension
$avatarExtension=explode('.',$avatarName);
$dump=strtolower(end($avatarExtension));

//Get var from in form
$user =$_POST['username'];
$pass =$_POST['password'];
$email=$_POST['email'];
$name =$_POST['full'];
$hashPass=sha1($_POST['password']);

//validet the form
$forErrors=array();
if(strlen($user)<3){
$forErrors[] = 'Username Cant Be Less <strong>2 characters or empty</strong>';
}
if(strlen($user)>20){
$forErrors[] = 'Username Cant Be Less  <strong>20 characters or empty</strong> ';
}
if(empty($user)){
$forErrors[]= 'Username Cant Be <strong>Empty</strong>';
}
if(empty($pass)){
$forErrors[]= 'Password Cant Be <strong>Empty</strong>';
}
if(empty($name)){
$forErrors[]= 'Fullname Cant Be <strong>Empty</strong>';
}
if(empty($email)){
$forErrors[]= 'Email Cant Be <strong>Empty</strong>';
}
if(! empty($avatarName) && ! in_array($dump,$avatarAllowedExtension)){
$forErrors[]= 'This Extension Is Not <strong>Allowed</strong>';
}
if(empty($avatarName)){
$forErrors[]= 'Avatar Is  <strong>Required</strong>';
}
if($avatarSize > 4194304){
$forErrors[]= 'Avatar Is cant Be Larger Than <strong>4MB</strong>';
}
if($avatarerror == 4){
$forErrors[]= 'No Upload <strong>Image</strong>'; 
}

//loop echo error
foreach($forErrors as $error){
$theMsg= '<div class="alert alert-danger">'.$error.'</div>';
redirectHome($theMsg,'back');
}

//check if no error can update
if(empty($forErrors)){
$avatar=rand(0,100000) . '_' . $avatarName;
move_uploaded_file($avatarTmp,"uploads/avatar/" .$avatar);

//check user exist in databases
$check= checkItem("Username","users",$user);
if($check == 1){
$theMsg='<div class="alert alert-danger">Sorry This User Is Exest</div>';
redirectHome($theMsg,'back');
}else{

//insert user in databaeses
$stmt=$con->prepare("INSERT INTO 
                            users
                            (Username,
                             Password,
                             Email,
                             FullName,
                             RegStatus,
                             Date,
                             avatar)
VALUES(:zuser,:zpass,:zmail,:zname,1,now(),:zavatar)");
$stmt->execute(array(
'zuser'    =>$user,
'zpass'   =>$hashPass,
'zmail'   =>$email,
'zname'   =>$name,
'zavatar' =>$avatar
));

//eho success massage
$theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record Insert</div>';
redirectHome($theMsg,'back');
} 
}
}else{
echo "<div class='container'>";
$theMsg= '<div class="alert alert-danger">sorry you cant Brows This page direct</div>';
redirectHome($theMsg);
echo "</div>";
}

echo "</div>";

}elseif($do == 'Edit'){ //edit page

//cheack if userid is nuber & get int val
$userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

//select databases depand ID
$stmt=$con->prepare("SELECT 
                         * 
                     FROM 
                         users 
                     WHERE 
                         UserID=?  
                     LIMIT 1");

//execute qure
$stmt->execute(array($userid));

//fatch data
$row=$stmt->fetch();

//the row count
$count=$stmt->rowCount();

//if ID rlley Show Form
if($count > 0) { ?>
<h1 class="text-center">Edit Member</h1>
<div class="container">

<form class="form-horizontal" action="?do=Update" method="POST">
<input type="hidden" name="userid" value="<?php echo $userid ?>">

<!--user name -->
<div class="form-group form-group-lg">
<label class="col-sm-2  control-label">Username</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="username" 
class="form-control" 
value="<?php echo $row['Username'] ?>" 
autocomplete="off" 
required="required" >
</div>
</div>
<!--user name -->

<!-- password -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Password</label>
<div class="col-sm-10 col-md-6">
<input type="hidden" name="oldpassword" 
value="<?php echo $row['Password'] ?>">
<input type="password" name="newpassword" 
class="form-control" 
autocomplete="new-password" 
placeholder="Lave Blank If You Dont Want To Change">
</div>
</div>
<!--password -->

<!--Email -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Email</label>
<div class="col-sm-10 col-md-6">
<input type="email" name="email" 
value="<?php echo $row['Email'] ?>" 
class="form-control" 
required="required" >
</div>
</div>
<!--Email -->

<!--Full name -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Full Name</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="full" 
value="<?php echo $row['FullName'] ?>" 
class="form-control" 
required="required" >
</div>
</div>
<!--Full name -->

<!--user submit -->
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<input type="submit" value="Save" class="btn btn-primary btn-lg">
</div>
</div>
<!--user submit -->

</form>
</div>

<?php

//if error ID
}else{
echo "<div class='container'>";
$theMsg= '<div class="alert alert-danger">Theres no such ID</div>';
redirectHome($theMsg);
echo "</div>";
}

}elseif($do == 'Update'){  //Update page
echo "<h1 class='text-center'>Update Member</h1>";
echo "<div class='container'>";
if($_SERVER['REQUEST_METHOD'] == 'POST'){

//Get var from in form
$id     =$_POST['userid'];
$user   =$_POST['username'];
$email  =$_POST['email'];
$name   =$_POST['full'];

//password trick
$pass=empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

//validet the form
$forErrors=array();
if(strlen($user)<3){
$forErrors[] = 'Username Cant Be Less <strong>2 characters or empty</strong>';
}
if(strlen($user)>20){
$forErrors[] = 'Username Cant Be Less  <strong>20 characters or empty</strong> ';
}
if(empty($user)){
$forErrors[]= 'Username Cant Be <strong>Empty</strong>';
}
if(empty($name)){
$forErrors[]= 'Fullname Cant Be <strong>Empty</strong>';
}
if(empty($email)){
$forErrors[]= 'Email Cant Be <strong>Empty</strong>';
}

//loop echo error
foreach($forErrors as $error){
echo '<div class="alert alert-danger>'.$error.'</div>';
}

//check if no error can update
if(empty($forErrors)){
$stmt2=$con->prepare("SELECT
                           *
                      FROM
                           users
                      WHERE
                           Username=?
                      AND
                           UserID !=?");
$stmt2->execute(array($user,$id));
$count=$stmt2->rowCount();
if($count == 1){
$theMsg= '<div class="alert alert-danger">Sorry The User Is Exist</div>';
redirectHome($theMsg,'back');
}else{

//Update Databases with info
$stmt=$con->prepare("UPDATE 
                         users 
                     SET 
                         Username=?, 
                         Email=?, 
                         Fullname=?, 
                         Password=?
                      WHERE 
                         UserID=?");
$stmt->execute(array($user,$email,$name,$pass,$id));

//eho success massage
$theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record Update</div>';
redirectHome($theMsg,'back');
}
} 

}else{
$theMsg= '<div class="alert alert-danger">sorry you cant Brows This page direct</div>';
redirectHome($theMsg);
}

echo "</div>";

}elseif($do == 'Delete'){ //delete meber page
echo "<h1 class='text-center'>Delete Members</h1>";
echo "<div class='container'>";

//cheack if user id is nuber & get int val
$userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

//select databases depand ID
$check=checkItem("userid","users",$userid);

//if ID rlley Show Form
if($check > 0) { 
$stmt=$con->prepare("DELETE 
                     FROM 
                         users 
                     WHERE 
                         UserID = :zuser");
$stmt->bindParam(":zuser",$userid);
$stmt->execute();
$theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record Deleted</div>';
redirectHome($theMsg,'back');
}else{
$theMsg ='<div class="alert alert-danger">This ID Not Exist</div>';
redirectHome($theMsg);
}

echo "</div>";

}elseif($do =='Activate'){
echo "<h1 class='text-center'>Activate Members</h1>";
echo "<div class='container'>";

//cheack if user id is nuber & get int val
$userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

//select databases depand ID
$check=checkItem("userid","users",$userid);

//if ID rlley Show Form
if($check > 0) { 
$stmt=$con->prepare("UPDATE 
                         users 
                     SET 
                         RegStatus=1 
                     WHERE 
                          UserID=?");
$stmt->execute(array($userid));
$theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record Updated</div>';
redirectHome($theMsg);
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