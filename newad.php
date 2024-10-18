<?php
session_start();
$pageTitle='بيع المنتجات';
 include 'init.php';
 if(isset($_SESSION['user'])){
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
         $formErrors=array();
         $name     =filter_var( $_POST['name'],FILTER_SANITIZE_STRING);
         $desc     =filter_var($_POST['description'],FILTER_SANITIZE_STRING);
         $price    =filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_INT);
         $country  =filter_var($_POST['country'],FILTER_SANITIZE_STRING);
         $status   =filter_var($_POST['status'],FILTER_SANITIZE_NUMBER_INT);
         $category =filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
         $tags =filter_var($_POST['tags'],FILTER_SANITIZE_STRING);
         
         if(strlen($name)<3){
             $formErrors[]='أسم أكثر من ثلاث احرف';
         }
         if(strlen($desc)<10){
            $formErrors[]='وصف اكثرمن عشر احرف';
        }
        if(strlen($country)<2){
            $formErrors[]='اكثر من ثلاث احرف';
        }
        
        if(empty($price)){
            $formErrors[]='لايمكن ترك سعر فارغ';
        }
        if(empty($status)){
            $formErrors[]='لايمكن ترك حاله فارغ';
        }
        if(empty($category)){
            $formErrors[]='يجب ان تختارقسم';
        }
         //check if no error can update
    if(empty($forErrors)){
        //insert user in databaeses
      $stmt=$con->prepare("INSERT INTO items(Name,Description,Price,Country_Made,Status,Add_Date,Cat_ID,Member_ID,tags)
       VALUES(:zname,:zdesc,:zprice,:zcountry,:zstatus,now(),:zcat,:zmember,:ztags)");
        $stmt->execute(array(
          'zname'    =>$name,
          'zdesc'    =>$desc,
          'zprice'   =>$price,
          'zcountry' =>$country,
          'zstatus'  =>$status,
          'zcat'     =>$category,
          'zmember'  =>$_SESSION['uid'],
          'ztags'    =>$tags
        ));
        //eho success massage
       if($stmt){
           $succesMsg='تم اضافه منتجك انتظر الرد';
       }
          
        }
     }
 ?>
 <h1 class="text-center"><?php echo $pageTitle ?></h1>
<div class="create-ad block">
     <div class="container">
     <div class="panel panel-primary">
        <div class="panel-heading"><?php echo $pageTitle ?></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                    <form class="form-horizontal main-form" action=<?php echo $_SERVER['PHP_SELF'] ?> method="POST">
    <!--name -->
    <div class="form-group form-group-lg">
    <label class="col-sm-3  control-label">أسم المنتج</label>
    <div class="col-sm-10 col-md-9">
    <input 
    type="text" name="name" 
    class=" form-control live" 
    required="required"  
    placeholder="أسم المنتج الصريح" 
    data-class=".live-title">
    </div> 
    </div>
      <!-- name -->
   <!-- description -->
   <div class="form-group form-group-lg">
      <label class="col-sm-3 control-label">معلومات عنه</label>
      <div class="col-sm-10 col-md-9">
      <input 
      type="text" name="description" 
      class="form-control live" 
      required="required"   
      placeholder="وصفه الكامل"
      data-class=".live-desc">
      </div>
      </div>
        <!--description-->
          <!-- price -->
   <div class="form-group form-group-lg">
      <label class="col-sm-3 control-label">سعر البيع</label>
      <div class="col-sm-10 col-md-9">
      <input 
      type="text" name="price" 
      class="form-control live" 
      required="required"   
      placeholder="السعر بالدولار الامريكي"
      data-class=".live-price">
      </div>
      </div>
        <!--price-->
                <!-- country made -->
   <div class="form-group form-group-lg">
      <label class="col-sm-3 control-label">صناعته</label>
      <div class="col-sm-10 col-md-9">
      <input type="text" name="country" 
      class="form-control" 
      required="required"  
      placeholder="بلد الصنع">
      </div>
      </div>
        <!--country made-->
                   <!-- status -->
   <div class="form-group form-group-lg">
      <label class="col-sm-3 control-label">حاله</label>
      <div class="col-sm-10 col-md-9">
      <select class="form-control" name="status" required>
      <option value="0">...</option>
      <option value="1">New</option>
      <option value="2">Like New</option>
      <option value="3">Used</option>
      <option value="4">Very Old</option>
      </select>
      </div>
      </div>
        <!--status-->
                           <!-- caegory -->
   <div class="form-group form-group-lg">
      <label class="col-sm-3 control-label">اي قسم لبيعه</label>
      <div class="col-sm-10 col-md-9">
      <select class="form-control" name="category" required>
      <option value="0">...</option>
     <?php
        $cats=getAllFrom('*','categories','','','ID');
        foreach($cats as $cat){
            echo "<option value='".$cat['ID']."'>".$cat['Name']."</option>";
        }
     ?>
      </select>
      </div>
      </div>
        <!--category-->
                        <!-- tags -->
   <div class="form-group form-group-lg">
      <label class="col-sm-3 control-label">Tags</label>
      <div class="col-sm-10 col-md-9">
      <input type="text" name="tags" class="form-control"   placeholder="Separate Tags With Comma (,)">
      </div>
      </div>
        <!--tags-->
        <!--user submit -->
    <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
    <input type="submit" value="بيع منتج" class="btn btn-primary btn-sm">
    </div>
    </div>
      <!--user submit -->
    </form>
                    </div>
                    <div class="col-md-4">
    <div class="thumbnail item-box live-preview">
    <span class="price-tag">
        $ <span class="live-price">0</span>
    </span>
    <img class="img-responsive" src="layout/imags/emp.jpg" alt="">
    <div class="caption">
    <h3 class="live-title">أسم المنتج</h3>
    <p class="live-desc">ألوصف</p>
    </div>
    </div>
                    </div>
                </div>
                <!--start loop error-->
                <?php
                if(! empty($formErrors)){
                    foreach($formErrors as $error){
                        echo '<div class="alert alert-danger">'.$error.'</div>';
                    }
                }
                if(isset($succesMsg)){
                    echo '<div class="alert alert-success">'.$succesMsg.'</div>';
                }
                ?>
                <!--end loop error-->
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