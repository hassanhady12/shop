<?php
ob_start();
session_start();
$pageTitle='Homepage';
 include 'init.php';
?>
<?php
//order_process.php
$total_price = 0;

$order_details = '
<div class="table-responsive" id="order_table">
<table class="table table-bordered table-striped">
<tr>  
<th>أسم ألمنتج</th>  
<th>ألعدد</th>  
<th>ألسعر</th>  
<th>ألمجموع</th>  
</tr>
';

if(!empty($_SESSION["shopping_cart"]))
{
foreach($_SESSION["shopping_cart"] as $keys => $values)
{
$order_details .= '
<tr>
<td>'.$values["product_name"].'</td>
<td>'.$values["product_quantity"].'</td>
<td align="right">$'.$values["product_price"].'</td>
<td align="right">$'.number_format($values["product_quantity"] * $values["product_price"], 2).'</td>
</tr>
';
$total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
}
$order_details .= '
<tr>  
<td colspan="3" align="right">ألمبلغ الكلي</td>  
<td align="right">$'.number_format($total_price, 2).'</td>
</tr>
';
}
$order_details .= '</table>';

?>

<div class="container">

<br />
<div class="panel panel-default">
<div class="panel-heading">ألطلب</div>
<div class="panel-body">
<div class="row">
<div class="col-md-8" style="border-right:1px solid #ddd;">
<h4 align="center">تفاصيل ألزبون</h4>

<div class="row">

<div id="order">

<div class="jumbotron text-center">
<h6 class="lead"><b>المنتجات(s) :</b>  <?php if(!empty($_SESSION["shopping_cart"])){
foreach($_SESSION["shopping_cart"] as $keys => $values){      
$name = $values["product_name"];
$qty =$values["product_quantity"];
echo $allItem = $name.'('.$qty.')';        
}
}      
?></h6>
<h5 class="lead"><b>ألمجموع:</b><?= number_format($total_price,2).'$' ?></h5>
</div>

<form action="?do=Insert" method="POST" id="placeOrder">

<input type="hidden" name="products" value="<?php if(!empty($_SESSION["shopping_cart"])){
foreach($_SESSION["shopping_cart"] as $keys => $values){      
$name = $values["product_name"];
$qty =$values["product_quantity"];
echo $allItem = $name.'('.$qty.')';        
}
}      
?>">



<input type="hidden" name="grand_total" value="<?php echo $total_price ; ?>">



<div class="input-container">
<div class="form-group">
<input pattern=".{3,}"
title="أدخل أسم أكثر من حرفين"  type="text" name="name" class="form-control" placeholder="أدخل ألأسم" >
</div>
</div>

<div class="input-container">
<div class="form-group">
<input type="email" name="email" class="form-control" placeholder="  أدخل E-Mail ألصحيح" >
</div>
</div>

<div class="input-container">
<div class="form-group">
<input  minlength="11" type="tel" name="phone" class="form-control" placeholder="أدخل رقم ألهاتف" >
</div>
</div>

<div class="input-container">
<div class="form-group">
<textarea pattern=".{3,}"
title="أدخل عنوان أكثر من حرفين" name="address" class="form-control" cols="10" rows="3" 
placeholder="أكتب ألعنوان ألكامل... "></textarea>
</div>
</div>



<div class="form-group">
<input type="submit"  class=" btn btn-block btn btn-danger" value="Place Order">
</div>

</form>
</div>

<?php
$do=isset($_GET['do']) ? filter_var($_GET['do'],FILTER_SANITIZE_STRING): 'insert';

if($do =='Insert'){
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$name        =filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$email       =filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$phone       =filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
$address     =filter_var($_POST['address'], FILTER_SANITIZE_STRING);
$products    =$_POST['products'];
$grand_total =$_POST['grand_total'];

$forErrors=array();

if($grand_total == 0){
$forErrors[]= 'يجب ان تختر منتجات لشراء';
}

if(empty($name)){
$forErrors[]= 'لايمكن ترك حقل الاسم فارغ';
}
              
if(strlen($name)>20){
$forErrors[] = 'وصلت الحد الاعلى من ألاحرف';
}
if(strlen($name)<3){
$forErrors[] = 'لا يمكن ادخال أسم أقل من حرفين';
}
             
if(empty($phone)){
$forErrors[]= 'لايمكن ترك حقل ألموبايل فارغ';
}
if(empty($address)){
$forErrors[]= 'لايمكن ترك حقل ألعنوان فارغ';
}
               

foreach($forErrors as $error){
$theMsg= '<div class="alert alert-danger">'.$error.'</div>';
redirectHome($theMsg);
}

if(empty($forErrors)){

$stmt=$con->prepare("INSERT INTO 
orders
(name,
email,
phone,
address,
product,
amount_paid)
VALUES(:zname,:zemail,:zphone,:zaddress,:zproduct,:zamount_paid)");
$stmt->execute(array(
'zname'        =>$name,
'zemail'       =>$email,
'zphone'       =>$phone,
'zaddress'     =>$address,
'zproduct'     =>$products,
'zamount_paid' =>$grand_total
));

$theMsg= "
<h3 class='badge'>مشترياتك هي:".$products."</h3>
<h3 class='badge'>اسمك هو:".$name."</h3>
<h3 class='badge'>أيميل هو:".$email."</h3>
<h3 class='badge'> رقم موبايل هو:".$phone."</h3>
<h3 class='badge'> عنوانك هو:".$address."</h3>
<h3 class='text-success'>تم أرسال طلبك بنجاح شكرأ</h3>";
redirectHome($theMsg,'',5);

}
}

      
}
?>
    
</div>
</div>

<div class="col-md-4">
<h4 align="center">تفاصيل ألطلب</h4>
<?php
echo $order_details;
?>
</div>

</div>
<div>
</div>
</div>

<?php
include $tpl . 'footer.php';
ob_end_flush();
?> 

