<?php
ob_start(); //output buffer start
session_start();
$pageTitle='Items';
if(isset($_SESSION['Username'])){
include 'init.php';

$do=isset($_GET['do']) ?$_GET['do'] : 'Manage';
if($do == 'Manage'){
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
                       ORDER BY
                             Item_ID DESC");

//execute statment
$stmt->execute();

//assing to var
$items=$stmt->fetchAll();
if(! empty($items)){
?>
<h1 class="text-center">Manage Items</h1>
<div class="container">

<div class="table-responsive">
<table class="main-table  manage-members text-center table table-bordered">
<tr>
<td>#ID</td>
<td>Image</td>
<td>Name</td>
<td>Description</td>
<td>Price</td>
<td>Add_Date</td>
<td>Country_Made</td>
<td>Category</td>
<td>Username</td>
<td>Quantity</td>
<td>Control</td>
</tr>
<tr>
  
<?php
foreach($items as $item){
echo "<tr>";
echo "<td>".$item['Item_ID']."</td>";
echo "<td>";
if(empty($item['Image'])){
echo 'No Image';
}else{
echo "<img src='uploads/image/".$item['Image']."' alt=''>";
}
echo"</td>";
echo "<td>".$item['Name']."</td>";
echo "<td>".$item['Description']."</td>";
echo "<td>".$item['Price']."</td>";
echo "<td>".$item['Add_Date']."</td>";
echo "<td>".$item['Country_Made']."</td>";
echo "<td>".$item['category_name']."</td>";
echo "<td>".$item['Username']."</td>";
echo "<td>".$item['qty']."</td>";
echo "<td>
<a href='items.php?do=Edit&itemid=".$item['Item_ID']."' class='btn btn-success'><i class='fa fa-edit'></i>Edit</a> 
<a href='items.php?do=Delete&itemid=".$item['Item_ID']."' class='btn btn-danger confirm'><i class='fas fa-times-circle'></i>Delete</a>" ;
if($item['Approve'] == 0) {
echo "<a 
href='items.php?do=Approve&itemid=".$item['Item_ID']."' 
class='btn btn-info activet'>
<i class='fas fa-check'></i>Approve</a>";
}    
echo "</td>";
echo "</tr>";
}
?>

</table>

</div>

<a href="items.php?do=Add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>  New Item</a>

</div>

<?php }else{
echo '<div class="container">';

echo '<div class="nice-massage alert alert-info">There\'s No items To Show</div>';
echo '<a href="items.php?do=Add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>  New Item</a>';
echo '</div>';
}

?>

<?php 
}elseif($do == 'Add'){ ?>
<h1 class="text-center">Add New Item</h1>
<div class="container">
<form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
    
<!--name -->
<div class="form-group form-group-lg">
<label class="col-sm-2  control-label">Name</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="name" 
class=" form-control" 
required="required"  
placeholder="Name Of The Item" >
</div>
</div>
<!-- name -->

<!-- description -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Description</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="description" 
class="form-control" 
required="required"   
placeholder="Describe The Item">
</div>
</div>
<!--description-->

<!-- price -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Price</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="price" 
class="form-control" 
required="required"   
placeholder="Price The Item">
</div>
</div>
<!--price-->

<!-- country made -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Country</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="country" 
class="form-control" 
required="required"  
placeholder="Country Of Made">
</div>
</div>
<!--country made-->

<!-- status -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Status</label>
<div class="col-sm-10 col-md-6">
<select class="form-control" name="status">
<option value="0">...</option>
<option value="جديد">New</option>
<option value="مستخدم قليل">Like New</option>
<option value="مستخدم">Used</option>
<option value="قديم">Very Old</option>
</select>
</div>
</div>
<!--status-->

<!-- member -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Members</label>
<div class="col-sm-10 col-md-6">
<select class="form-control" name="member">
<option value="0">...</option>
<?php
$allMember=getAllFrom("*","users","","","UserID");
foreach($allMember as $user){
echo "<option value='".$user['UserID']."'>".$user['Username']."</option>";
}
?>
</select>
</div>
</div>
<!--member-->

<!-- caegory -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Category</label>
<div class="col-sm-10 col-md-6">
<select class="form-control" name="category">
<option value="0">...</option>
<?php
$allCats=getAllFrom("*","categories","where parent=0","","ID");
foreach($allCats as $cat){
echo "<option value='".$cat['ID']."'>".$cat['Name']."</option>";
$childCats=getAllFrom("*","categories","where parent={$cat['ID']}","","ID");
foreach($childCats as $child){
echo "<option value='".$child['ID']."'>---".$child['Name']."</option>";
}
}
?>
</select>
</div>
</div>
<!--category-->

<!-- tags -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Tags</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="tags" class="form-control"  placeholder="Separate Tags With Comma (,)">
</div>
</div>
<!--tags-->

<!--image -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Item Image</label>
<div class="col-sm-10 col-md-6">
<input type="file" name="Image" 
class="form-control" 
required="required">
</div>
</div>
<!--image -->

<!--qty-->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Quantity :</label>
<div class="col-sm-10 col-md-6">
<input type="number" name="qty"
class="form-control" 
required="required">
</div>
</div>
<!--qty-->

<!--user submit -->
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<input type="submit" value="Add Item" class="btn btn-primary btn-sm">
</div>
</div>
<!--user submit -->

</form>
</div>

<?php

}elseif($do == 'Insert'){
if($_SERVER['REQUEST_METHOD'] == 'POST'){
echo "<h1 class='text-center'>Insert Iteam</h1>";
echo "<div class='container'>";


//Upload var
$imageName  =$_FILES['Image']['name'];
$imageSize  =$_FILES['Image']['size'];
$imageTmp   =$_FILES['Image']['tmp_name'];
$imageType  =$_FILES['Image']['type'];
$imageerror =$_FILES['Image']['error'];

//allow file type upload
$imageAllowedExtension=array("jpeg","jpg","png","gif");

//get avatar extension
$imageExtension=explode('.',$imageName);
$dump=strtolower(end($imageExtension));

//Get var from in form
$name    =$_POST['name'];
$desc    =$_POST['description'];
$price   =$_POST['price'];
$country =$_POST['country'];
$status  =$_POST['status'];
$cat     =$_POST['category'];
$member  =$_POST['member'];
$tags    =$_POST['tags'];
$qty     =$_POST['qty'];

   
//validet the form
$forErrors=array();
if(empty($name)){
$forErrors[] = 'Name Cant Be  <strong> empty</strong>';
}
if(empty($desc)){
$forErrors[] ='Description Cant Be  <strong> empty</strong>';
}
if(empty($price)){
$forErrors[]= 'Price Cant Be  <strong> empty</strong>';
}
if(empty($country)){
$forErrors[]= 'Country Cant Be  <strong> empty</strong>';
}
if($status === 0){
$forErrors[]= 'You Must Choose The  <strong>Status</strong>';
}
if($cat === 0){
$forErrors[]= 'You Must Choose The  <strong>Category</strong>';
}
if($member === 0){
$forErrors[]= 'You Must Choose The  <strong>Member</strong>';
}
if(! empty($imageName) && ! in_array($dump,$imageAllowedExtension)){
$forErrors[]= 'This Extension Is Not <strong>Allowed</strong>';
}
if(empty($imageName)){
$forErrors[]= 'image Is  <strong>Required</strong>';
}
if($imageSize > 4194304){
$forErrors[]= 'image Is cant Be Larger Than <strong>4MB</strong>';
}
if($imageerror == 4){
$forErrors[]= 'No Upload <strong>Image</strong>';
}

//loop echo error
foreach($forErrors as $error){
$theMsg= '<div class="alert alert-danger">'.$error.'</div>';
redirectHome($theMsg,'back');
}

//check if no error can update
if(empty($forErrors)){
$image=rand(0,100000) . '_' . $imageName;
move_uploaded_file($imageTmp,"uploads/image/" .$image);

//insert user in databaeses
$stmt=$con->prepare("INSERT INTO 
                            items(Name,
                                  Description,
                                  Price,
                                  Country_Made,
                                  Status,
                                  Add_Date,
                                  Cat_ID,
                                  Member_ID,
                                  tags,
                                  Image,
                                  qty)
VALUES(:zname,:zdesc,:zprice,:zcountry,:zstatus,now(),:zcat,:zmember,:ztags,:zimage,:zqty)");
$stmt->execute(array(
'zname'    =>$name,
'zdesc'    =>$desc,
'zprice'   =>$price,
'zcountry' =>$country,
'zstatus'  =>$status,
'zcat'     =>$cat,
'zmember'  =>$member,
'ztags'    =>$tags,
'zimage'   =>$image,
'zqty'     =>$qty
));

//eho success massage
$theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record Insert</div>';
redirectHome($theMsg,'back');    

}

}else{
echo "<div class='container'>";
$theMsg= '<div class="alert alert-danger">sorry you cant Brows This page direct</div>';
redirectHome($theMsg);
echo "</div>";
}

echo "</div>";

}elseif($do == 'Edit'){
//cheack if userid is nuber & get int val
$itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

//select databases depand ID
$stmt=$con->prepare("SELECT 
                          * 
                     FROM 
                          items 
                     WHERE 
                          Item_ID=? ");

//execute qure
$stmt->execute(array($itemid));

//fatch data
$item=$stmt->fetch();

//the row count
$count=$stmt->rowCount();

//if ID rlley Show Form
if($count > 0) { ?>
<h1 class="text-center">Edit Item</h1>
<div class="container">
<form class="form-horizontal" action="?do=Update" method="POST">
<input type="hidden" name="itemid" value="<?php echo $itemid ?>">

<!--name -->
<div class="form-group form-group-lg">
<label class="col-sm-2  control-label">Name</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="name" 
class=" form-control" 
required="required"  
placeholder="Name Of The Item" 
value="<?php echo $item['Name']?>" >
</div>
</div>
<!-- name -->

<!-- description -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Description</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="description" 
class="form-control" 
required="required"  
placeholder="Describe The Item"  
value="<?php echo $item['Description']?>">
</div>
</div>
<!--description-->

<!-- price -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Price</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="price" 
class="form-control" 
required="required"   
placeholder="Price The Item" 
value="<?php echo $item['Price']?>">
</div>
</div>
<!--price-->

<!-- country made -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Country</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="country" 
class="form-control" 
required="required"  
placeholder="Country Of Made" 
value="<?php echo $item['Country_Made']?>">
</div>
</div>
<!--country made-->

<!-- status -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Status</label>
<div class="col-sm-10 col-md-6">
<select class="form-control" name="status">
<option value="جديد" <?php if($item['Status']==1){echo 'selected';} ?>>New</option>
<option value="مستخدم قليل" <?php if($item['Status']==2){echo 'selected';} ?>>Like New</option>
<option value="مستخدم" <?php if($item['Status']==3){echo 'selected';} ?>>Used</option>
<option value="قديم" <?php if($item['Status']==4){echo 'selected';} ?>>Very Old</option>
</select>
</div>
</div>
<!--status-->

<!-- member -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Members</label>
<div class="col-sm-10 col-md-6">
<select class="form-control" name="member">
<?php
$stmt=$con->prepare("SELECT * FROM users");
$stmt->execute();
$users=$stmt->fetchAll();
foreach($users as $user){
echo "<option value='".$user['UserID']."'";
if($item['Member_ID']==$user['UserID']){echo 'selected';} 
echo ">".$user['Username']."</option>";
}
?>
</select>
</div>
</div>
<!--member-->

<!-- caegory -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Category</label>
<div class="col-sm-10 col-md-6">
<select class="form-control" name="category">
<?php
$stmt2=$con->prepare("SELECT 
                           * 
                      FROM  
                           categories");
$stmt2->execute();
$cats=$stmt2->fetchAll();
foreach($cats as $cat){
echo "<option value='".$cat['ID']."'";
if($item['Cat_ID']==$cat['ID']){echo 'selected';} 
echo ">".$cat['Name']."</option>";
}
?>
</select>
</div>
</div>
<!--category-->
      
<!-- tags -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Tags</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="tags" class="form-control"  placeholder="Separate Tags With Comma (,)" value="<?php echo $item['tags'] ?>">
</div>
</div>
<!--tags-->

<!-- qty -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Quantity</label>
<div class="col-sm-10 col-md-6">
<input type="number" name="qty" 
class="form-control" 
required="required"   
placeholder="Price The Item" 
value="<?php echo $item['qty']?>">
</div>
</div>
<!--qty-->

<!--user submit -->
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<input type="submit" value="save Item" class="btn btn-primary btn-sm">
</div>
</div>
<!--user submit -->

</form>

<?php

//select user except comment
$stmt=$con->prepare("SELECT 
                          comments.*,users.Username As Member 
                     FROM 
                          comments
                     INNER JOIN
                           users
                     ON
                           users.UserID=comments.user_id
                     WHERE 
                           item_id =?");

//execute statment
$stmt->execute(array($itemid));

//assing to var
$rows=$stmt->fetchAll();
if(! empty($rows)){
?>

<h1 class="text-center">Manage [<?php echo $item['Name'] ?>] Comment</h1>
<div class="table-responsive">
<table class="main-table text-center table table-bordered">

<tr>
<td>Comment</td>
<td>User Name</td>
<td>Added Date</td>
<td>Control</td>
</tr>
<tr>
      
<?php
foreach($rows as $row){
echo "<tr>";
echo "<td>".$row['comment']."</td>";
echo "<td>".$row['Member']."</td>";
echo "<td>".$row['comment_date']."</td>";
echo "<td>
<a href='comments.php?do=Edit&comid=".$row['c_id']."' class='btn btn-success'><i class='fa fa-edit'></i>Edit</a> 
<a href='comments.php?do=Delete&comid=".$row['c_id']."' class='btn btn-danger confirm'><i class='fas fa-times-circle'></i>Delete</a>" ;
if($row['status'] == 0) {
echo "<a 
href='comments.php?do=Approve&comid=".$row['c_id']."' 
class='btn btn-info activet'>
<i class='fas fa-check'></i>Approve</a>";
}      
echo "</td>";
echo "</tr>";
}
?>

<tr>
</table>

</div>
<?php } ?>

</div>

<?php

//if error ID
}else{
echo "<div class='container'>";
$theMsg= '<div class="alert alert-danger">Theres no such ID</div>';
redirectHome($theMsg);
echo "</div>";
}

}elseif($do == 'Update'){ 
echo "<h1 class='text-center'>Update Item</h1>";
echo "<div class='container'>";
if($_SERVER['REQUEST_METHOD'] == 'POST'){

//Get var from in form
$id      =$_POST['itemid'];
$name    =$_POST['name'];
$desc    =$_POST['description'];
$price   =$_POST['price'];
$country =$_POST['country'];
$status  =$_POST['status'];
$cat     =$_POST['category'];
$member  =$_POST['member'];
$tags    =$_POST['tags'];
$qty     =$_POST['qty'];

//validet the form
$forErrors=array();
if(empty($name)){
$forErrors[] = 'Name Cant Be  <strong> empty</strong>';
}
if(empty($desc)){
$forErrors[] ='Description Cant Be  <strong> empty</strong>';
}
if(empty($price)){
$forErrors[]= 'Price Cant Be  <strong> empty</strong>';
}
if(empty($country)){
$forErrors[]= 'Country Cant Be  <strong> empty</strong>';
}
if($status === 0){
$forErrors[]= 'You Must Choose The  <strong>Status</strong>';
}
if($cat === 0){
$forErrors[]= 'You Must Choose The  <strong>Category</strong>';
}
if($member === 0){
$forErrors[]= 'You Must Choose The  <strong>Member</strong>';
}

//loop echo error
foreach($forErrors as $error){
echo '<div class="alert alert-danger>'.$error.'</div>';
}

//check if no error can update
if(empty($forErrors)){

//Update Databases with info
$stmt=$con->prepare("UPDATE 
                          items 
                     SET 
                          Name=?, 
                          Description=?, 
                          Price=?, 
                          Country_Made=?,Status=?,
                          Member_ID=?,
                          Cat_ID=?,
                          tags=?,
                          qty=?
                      WHERE 
                          Item_ID=?");
$stmt->execute(array($name,$desc,$price,$country,$status,$member,$cat,$tags,$qty,$id));

//eho success massage
$theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record Update</div>';
redirectHome($theMsg,'back');
} 
  
}else{
$theMsg= '<div class="alert alert-danger">sorry you cant Brows This page direct</div>';
redirectHome($theMsg);
}

echo "</div>";

}elseif($do == 'Delete'){
echo "<h1 class='text-center'>Delete Iteam</h1>";
echo "<div class='container'>";

//cheack if user id is nuber & get int val
$itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

//select databases depand ID
$check=checkItem("Item_ID","items",$itemid);

//if ID rlley Show Form
if($check > 0) { 
$stmt=$con->prepare("DELETE 
                     FROM 
                          items 
                     WHERE 
                          Item_ID = :zid");
$stmt->bindParam(":zid",$itemid);
$stmt->execute();
$theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record Deleted</div>';
redirectHome($theMsg,'back');
}else{
$theMsg ='<div class="alert alert-danger">This ID Not Exist</div>';
redirectHome($theMsg);
}

echo "</div>";   

}elseif($do == 'Approve'){
echo "<h1 class='text-center'>Approve Item</h1>";
echo "<div class='container'>";

//cheack if itemid is nuber & get int val
$itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

//select databases depand ID
$check=checkItem("Item_ID","items",$itemid);

//if ID rlley Show Form
if($check > 0) { 
$stmt=$con->prepare("UPDATE 
                          items 
                     SET 
                          Approve=1 
                     WHERE 
                          Item_ID=?");
$stmt->execute(array($itemid));
$theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record Updated</div>';
redirectHome($theMsg,'back');
}else{
$theMsg ='<div class="alert alert-danger">This ID Not Exist</div>';
redirectHome($theMsg);
}

echo "</div>";

}

include $tpl .'footer.php';
}else{
header('Location:index.php');
exit();
}
ob_end_flush();
?>
