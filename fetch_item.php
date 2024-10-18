<?php
include './admin/connect.php';

include 'includes/fuctions/function.php';

//fetch_item.php

$result=getAllFrom("*","items","where Approve=1",""," Item_ID","");
 $output = '';
 foreach($result as $row)
 {
  $output .= '
  <div class="col-md-3" style="margin-top:12px;">  
            <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; height:410px;" align="center">
             <img src="./admin/uploads/image//'.$row["Image"].'" class="hvr-grow img-responsive" style="height:240px; width: 240px;" />
             <br />
             <h4 class="text-info"><a href="items.php?itemid='. $row['Item_ID'].'">'. $row['Name'].'</a></h4>
             <h4 class="text-danger"><b> $'.$row["Price"].'</b></h4>
             
             <input type="text" name="quantity" id="quantity'.$row["Item_ID"].'" class="form-control" value="'.$row['qty'].'" />
             <input type="hidden" name="hidden_name" id="name'.$row["Item_ID"].'" value="'.$row["Name"].'" />
             <input type="hidden" name="hidden_price" id="price'.$row["Item_ID"].'" value="'.$row["Price"].'" />
             <input type="button" name="add_to_cart" id="'.$row["Item_ID"].'" style="margin-top:5px;" 
             class="btn btn-success form-control add_to_cart" value="أضافه الى كارت تسوق" />
            </div>
        </div>
  ';
 }
 echo $output;



?>