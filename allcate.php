<?php
ob_start();
session_start();
$pageTitle='أقسام البيع';
 include 'init.php';
?>

  <div class="container">
   <br />
   <br />
   <nav class="navbar navbar-default" role="navigation">
    
     <div class="navbar-header">
   
      <a class="navbar-brand" href="index.php">أضغط على عربه تسوق</a>
     </div>
     
      <ul class="nav navbar-nav">
       <li>
        <a id="cart-popover" class="btn" data-placement="bottom" title="Shopping Cart">
         <span class="glyphicon glyphicon-shopping-cart"></span>
         <span class="badge"></span>
         <span class="total_price">$ 0.00</span>
        </a>
       </li>
      </ul>
  
   
   </nav>
   
   <div id="popover_content_wrapper" style="display: none">
    <span id="cart_details"></span>
    <div align="right">
     <a href="order_process.php" class="btn btn-primary">
      <span class="glyphicon glyphicon-shopping-cart"></span> شراء
     </a>
     <a href="#" class="btn btn-danger" id="clear_cart">
      <span class="glyphicon glyphicon-trash"></span> حذف كارت تسوق
     </a>
    </div>
   </div>

   <div id="display_item" class="row">

   <?php

if(isset($_GET['pageid']) && is_numeric($_GET['pageid'])){
      $category=intval($_GET['pageid']);
 
$stmt=$con->prepare("SELECT items.*,items.Name as item_name 
FROM items inner JOIN categories on items.Cat_ID = categories.ID AND categories.parent = {$category}
");

$stmt->execute();
$sql=$stmt->fetchAll();

       $output = '';
       foreach($sql as $row)
       {
  
    $output .= '
    <div class="col-md-3" style="margin-top:12px;">  
              <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; height:430px;" align="center">
               <img src="./admin/uploads/image//'.$row["Image"].'" class="img-responsive" style="height:240px; width: 240px;" />
               <br />
               <h4 class="text-info"><a href="items.php?itemid='. $row['Item_ID'].'">'. $row['item_name'].'</a></h4>
               <h4 class="text-danger"><b>$'.$row["Price"].'</b></h4>

               
               <input type="text" name="quantity" id="quantity'.$row["Item_ID"].'" class="form-control" value="'.$row['qty'].'" />
               <input type="hidden" name="hidden_name" id="name'.$row["Item_ID"].'" value="'.$row["item_name"].'" />
               <input type="hidden" name="hidden_price" id="price'.$row["Item_ID"].'" value="'.$row["Price"].'" />
               <input type="button" name="add_to_cart" id="'.$row["Item_ID"].'" style="margin-top:5px;" 
               class="btn btn-success form-control add_to_cart" value="أضافه ألى كارت تسوق" />
              </div>
          </div>
    ';
   }
   echo $output;
}else{
      echo "<div class='alert alert-danger'>ألقسم غير موجود</div>";
}
  


?>

   </div>

    
    <br />
    <br />
   </div>


 
<?php
 include $tpl . 'footer.php';
 ob_end_flush();
 ?> 
 <script>

$(document).ready(function(){



load_cart_data();


function load_cart_data()
{
 $.ajax({
  url:"fetch_cart.php",
  method:"POST",
  dataType:"json",
  success:function(data)
  {
   $('#cart_details').html(data.cart_details);
   $('.total_price').text(data.total_price);
   $('.badge').text(data.total_item);
  }
 });
}

$('#cart-popover').popover({
 html : true,
 container : 'body',
 content:function(){
  return $('#popover_content_wrapper').html();
 }
});

$(document).on('click', '.add_to_cart', function(){
 var product_id = $(this).attr('id');
 var product_name = $('#name'+product_id+'').val();
 var product_price = $('#price'+product_id+'').val();
 var product_quantity = $('#quantity'+product_id).val();
 var action = 'add';
 if(product_quantity > 0)
 {
  $.ajax({
   url:"action.php",
   method:"POST",
   data:{product_id:product_id,
         product_name:product_name, 
         product_price:product_price, 
         product_quantity:product_quantity, 
         action:action},
   success:function(data)
   {
    load_cart_data();

    alert("Item has been Added into Cart");
   }
  });
 }
 else
 {
  alert("Please Enter Number of Quantity");
 }
});

$(document).on('click','.delete',function(){
 var product_id = $(this).attr('id');
 var action='remove';
 if(confirm("Are you sure you want to remove this product?")){
$.ajax({
      url: "action.php",
      method: "POST",
      data: {product_id:product_id,action:action},
      success:function(data){
            load_cart_data();
            $('#cart-popover').popover('hide');
            alert("Item has been remove from cart");
      }
});
 }else{
       return false;
 }
});

$(document).on('click','#clear_cart',function(){
      var action = 'empty';
       
       $.ajax({
             url: "action.php",
             method: "POST",
             data:{action:action},
             success:function(){
                   load_cart_data();
                   $('#cart-popover').popover('hide');
                   alert("Your has been clear");
             }
       });
});
   
});

</script>


