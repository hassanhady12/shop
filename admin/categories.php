<?php
ob_start(); //output buffer start
session_start();
$pageTitle='Categories';
if(isset($_SESSION['Username'])){
include 'init.php';

$do=isset($_GET['do']) ?$_GET['do'] : 'Manage';
if($do == 'Manage'){
  $sort='ASC';
  $sort_array=array('ASC','DESC');
  if(isset($_GET['sort']) && in_array($_GET['sort'],$sort_array)){
    $sort=$_GET['sort'];
  }

 $stmt2=$con->prepare("SELECT 
                            * 
                       FROM 
                            categories 
                       WHERE 
                             parent=0 
                       ORDER BY 
                             Orderning $sort");
 $stmt2->execute();
 $cats=$stmt2->fetchAll();
 if (! empty($cats)) {
 ?>  

<h1 class="text-center">Manage Categories</h1>
<div class="container categories">
<div class="panel panel-default">

<div class="panel-heading"><i class="fas fa-tasks"></i> Manage Categories
<div class="option pull-right">
<i class="fa fa-sort"></i> Ordering:[
<a class="<?php if($sort=='ASC') {echo 'active';} ?>" href="?sort=ASC">ASC</a>|
<a class="<?php if($sort=='DESC') {echo 'active';} ?>" href="?sort=DESC">Desc</a>]
<i class="fa fa-eye"></i> View: [
<span class="active" data-view="full">Full</span> |
<span data-view="classic">Classic</span>]
</div>
</div>

<div class="panel-body">
<?php
foreach($cats as $cat){
echo "<div class='cat'>";

echo "<div class='hidden-buttons'>";
echo "<a href='categories.php?do=Edit&catid=".$cat['ID']."' class='btn btn-xs btn-primary'>
<i class='fa fa-edit'></i>Edit</a>";
echo "<a href='categories.php?do=Delete&catid=".$cat['ID']."' class='confirm btn btn-xs btn-danger'>
<i class='fa fa-times-circle'></i>Delete</a>";
echo"</div>";

echo "<h3>".$cat['Name'].'</h3>';

echo "<div class='full-view'>";
echo "<p>"; if($cat['Description'] =='') {echo 'This Catogry has no description';}else{ echo $cat['Description'];}echo'</p>';
if($cat['Visibility']==1){echo '<span class="visibility"><i class="fa fa-eye"></i> Hiddin</span>';} 
if($cat['Allow_Comment']==1){echo '<span class="commenting"><i class="fa fa-times-circle"></i>Comment Disabled</span>';}
if($cat['Allow_Ads']==1){echo '<span class="advertises"><i class="fa fa-times-circle"></i>Ads Disabled</span>';}
echo "</div>";

//get child cat
$childCat=getAllFrom("*","categories","where parent={$cat['ID']}","","ID","ASC");
if(! empty($childCat)){
echo "<h4 class='child-head'>Child Categories</h4>";

echo "<ul class='list-unstyled child-cat'>";
foreach( $childCat as $c){
echo "<li class='child-link'>
<a href='categories.php?do=Edit&catid=" .$c['ID']. "'>".$c['Name']."</a>
<a href='categories.php?do=Delete&catid=".$c['ID']."' class='show-delete confirm'>Delete</a>
</li>";
}
echo "</ul>";
}
echo "</div>";

echo "<hr>";
}
?>

</div>
</div>
<a  class="add-category btn btn-primary" href="categories.php?do=Add"><i class="fa fa-plus"></i> Add New Category</a>
</div>
<?php } else {

echo '<div class="container">';
  echo '<div class="nice-massage">There\'s No Categories To Show</div>';
  echo '<a href="categories.php?do=Add" class="btn btn-primary">
      <i class="fa fa-plus"></i> New Category
    </a>';
echo '</div>';

} ?>  

<?php
}elseif($do == 'Add'){ ?>
<h1 class="text-center">Add New Category</h1>
<div class="container">
<form class="form-horizontal" action="?do=Insert" method="POST">

<!--name -->
<div class="form-group form-group-lg">
<label class="col-sm-2  control-label">Name</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="name" 
class=" form-control" 
required="required"  
autocomplete="off" 
placeholder="Name Of The Category" >
</div>
</div>
<!-- name -->

<!-- description -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Description</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="description" 
class="form-control"  
placeholder="Describe The Category">
</div>
</div>
<!--description-->

<!--ordering -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Ordering</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="ordering" 
class="form-control"  
placeholder="Number To Arrange The Cayogries" >
</div>
</div>
<!--ordering -->

<!--start type cat-->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Perant?</label>
<div class="col-sm-10 col-md-6">
<select class="form-control" name="parent">
<option value="0">None</option>
<?php
$allCats=getAllFrom("*","categories","where parent=0","","ID","ASC");
foreach($allCats as $c){
echo "<option value=".$c['ID']."'>".$c['Name']."</option>";
}
?>
</select>
</div>
</div>
<!--end type cat-->

 <!--Visible -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Visible</label>
<div class="col-sm-10 col-md-6">
<div>
<input id="vis-yes" type="radio" name="visibilite" value="0" checked>
<label for="vis-yes">Yes</label>
</div>
<div>
<input id="vis-no" type="radio" name="visibilite" value="1">
<label for="vis-no">No</label>
</div>
</div>
</div>
<!--visible -->

<!--comment -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Allow Commenting</label>
<div class="col-sm-10 col-md-6">
<div>
<input id="com-yes" type="radio" name="commenting" value="0" checked>
<label for="com-yes">Yes</label>
</div>
<div>
<input id="com-no" type="radio" name="commenting" value="1">
<label for="com-no">No</label>
</div>
</div>
</div>
<!--comment -->

<!--Ads -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Allow Ads</label>
<div class="col-sm-10 col-md-6">
<div>
<input id="ads-yes" type="radio" name="ads" value="0" checked>
<label for="ads-yes">Yes</label>
</div>
<div>
<input id="ads-no" type="radio" name="ads" value="1">
<label for="ads-no">No</label>
</div>
</div>
</div>
<!--Ads -->

<!--user submit -->
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<input type="submit" value="Add Catogry" class="btn btn-primary btn-lg">
</div>
</div>
<!--user submit -->

</form>
</div>
   
<?php
}elseif($do == 'Insert'){
if($_SERVER['REQUEST_METHOD'] == 'POST'){
echo "<h1 class='text-center'>Insert Catogry</h1>";
echo "<div class='container'>";

//Get var from in form
$name    =$_POST['name'];
$desc    =$_POST['description'];
$parent  =$_POST['parent'];
$order   =$_POST['ordering'];
$visible =$_POST['visibilite'];
$comment =$_POST['commenting'];
$ads     =$_POST['ads'];

//check category exist in databases
$check=checkItem("Name","categories",$name);
if($check == 1){
$theMsg='<div class="alert alert-danger">Sorry This Category Is Exest</div>';
redirectHome($theMsg,'back');
}else{

//Insert category
$stmt=$con->prepare("INSERT INTO 
                           categories(name,
                                      Description,
                                      parent,
                                      Orderning,
                                      Visibility,
                                      Allow_Comment,
                                      Allow_Ads) 
VALUES(:zname,:zdesc,:zparent,:zorder,:zvisibe,:zcomment,:zads)");
$stmt->execute(array(
'zname'   =>$name,
'zdesc'   =>$desc,
'zparent'  =>$parent,
'zorder'  =>$order,
'zvisibe' =>$visible,
'zcomment'=>$comment,
'zads'    =>$ads
));

//eho success massage
$theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record Insert</div>';
redirectHome($theMsg,'back');
}
}else{
echo "<div class='container'>";
$theMsg= '<div class="alert alert-danger">sorry you cant Brows This page direct</div>';
redirectHome($theMsg,'back');
echo "</div>";
}

echo "</div>";

}elseif ($do == 'Edit') {
// Check If Get Request catid Is Numeric & Get Its Integer Value
$catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

// Select All Data Depend On This ID
$stmt = $con->prepare("SELECT 
                            * 
                       FROM 
                             categories 
                       WHERE 
                              ID = ?");

// Execute Query
$stmt->execute(array($catid));

// Fetch The Data
$cat = $stmt->fetch();

// The Row Count
$count = $stmt->rowCount();

//if ID rlley Show Form
if($count > 0) { ?>
<h1 class="text-center">Edit Category</h1>
<div class="container">
<form class="form-horizontal" action="?do=Update" method="POST">
<input type="hidden" name="catid" value="<?php echo $catid ?>">

<!--name -->
<div class="form-group form-group-lg">
<label class="col-sm-2  control-label">Name</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="name" 
class=" form-control" 
required="required"  
placeholder="Name Of The Category" 
value="<?php echo $cat['Name']?>" >
</div>
</div>
<!-- name -->

<!-- description -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Description</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="description" 
class="form-control"  
placeholder="Describe The Category" 
value="<?php echo $cat['Description']?>">
</div>
</div>
<!--description-->

<!--ordering -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Ordering</label>
<div class="col-sm-10 col-md-6">
<input type="text" name="ordering" 
class="form-control"  
placeholder="Number To Arrange The Cayogries" 
value="<?php echo $cat['Orderning']?>" >
</div>
</div>
<!--ordering -->

<!--start type cat-->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Perant?</label>
<div class="col-sm-10 col-md-6">
<select class="form-control" name="parent">
<option value="0">None</option>
<?php
$allCats=getAllFrom("*","categories","where parent=0","","ID","ASC");
foreach($allCats as $c){
echo "<option value='".$c['ID']."'";
if($cat['parent'] == $c['ID']) {echo 'selected=select';}
echo ">".$c['Name']."</option>";
}
?>
</select>
</div>
</div>
<!--end type cat-->

<!--Visible -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Visible</label>
<div class="col-sm-10 col-md-6">
<div>
<input id="vis-yes" type="radio" name="visibilite" value="0" <?php if($cat['Visibility']==0){echo 'checked';} ?>>
<label for="vis-yes">Yes</label>
</div>
<div>
<input id="vis-no" type="radio" name="visibilite" value="1" <?php if($cat['Visibility']==1){echo 'checked';} ?>>
<label for="vis-no">No</label>
</div>
</div>
</div>
<!--visible -->

<!--comment -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Allow Commenting</label>
<div class="col-sm-10 col-md-6">
<div>
<input id="com-yes" type="radio" name="commenting" value="0" <?php if($cat['Allow_Comment']==0){echo 'checked';} ?>>
<label for="com-yes">Yes</label>
</div>
<div>
<input id="com-no" type="radio" name="commenting" value="1" <?php if($cat['Allow_Comment']==1){echo 'checked';} ?>>
<label for="com-no">No</label>
</div>
</div>
</div>
<!--comment -->

<!--Ads -->
<div class="form-group form-group-lg">
<label class="col-sm-2 control-label">Allow Ads</label>
<div class="col-sm-10 col-md-6">
<div>
<input id="ads-yes" type="radio" name="ads" value="0" <?php if($cat['Allow_Ads']==0){echo 'checked';} ?>>
<label for="ads-yes">Yes</label>
</div>
<div>
<input id="ads-no" type="radio" name="ads" value="1" <?php if($cat['Allow_Ads']==1){echo 'checked';} ?>>
<label for="ads-no">No</label>
</div>
</div>
</div>
<!--Ads -->

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

} elseif ($do == 'Update') {
echo "<h1 class='text-center'>Update Category</h1>";
echo "<div class='container'>";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Get Variables From The Form
$id 		  = $_POST['catid'];
$name 		= $_POST['name'];
$desc 		= $_POST['description'];
$order 		= $_POST['ordering'];
$parent		= $_POST['parent'];
$visible 	= $_POST['visibilite'];
$comment 	= $_POST['commenting'];
$ads 	  	= $_POST['ads'];

// Update The Database With This Info
$stmt = $con->prepare("UPDATE 
                         categories 
                    SET 
                         Name = ?, 
                         Description = ?, 
                         Orderning = ?,
                         parent=?,
                         Visibility = ?,
                         Allow_Comment = ?,
                         Allow_Ads = ? 
                    WHERE 
                         ID = ?");
$stmt->execute(array($name, $desc, $order, $parent, $visible, $comment, $ads, $id));

// Echo Success Message
$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';
redirectHome($theMsg, 'back');
} else {
$theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';
redirectHome($theMsg);
}

echo "</div>";
  
}elseif($do == 'Delete'){
echo "<h1 class='text-center'>Delete Category</h1>";
echo "<div class='container'>";

//cheack if catid is nuber & get int val
$catid=isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

//select databases depand ID
$check=checkItem("ID","categories",$catid);

//if ID rlley Show Form
if($check > 0) { 
$stmt=$con->prepare("DELETE FROM 
                            categories 
                     WHERE 
                             ID = :id");
$stmt->bindParam(":id",$catid);
$stmt->execute();
$theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record Deleted</div>';
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
