<?php
ob_start();
session_start();
$pageTitle='ألصفحه ألرئسية';
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
        <a id="cart-popover" class="btn" data-placement="bottom" title="كارت تسوق">
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
     <a href="order_process.php" class="wow animate__bounceIn btn btn-primary hvr-pop">
      <span class="glyphicon glyphicon-shopping-cart"></span><span>شراء</span> 
     </a>
     <a href="#" class="btn btn-danger hvr-pop wow animate__bounceIn"  id="clear_cart">
      <span class="glyphicon glyphicon-trash"></span><span>حذف كارت تسوق</span> 
     </a>
    </div>
   </div>

   <div id="display_item" class="row">

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

load_product();

load_cart_data();

function load_product()
{
 $.ajax({
  url:"fetch_item.php",
  method:"POST",
  success:function(data)
  {
   $('#display_item').html(data);
  }
 });
}

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