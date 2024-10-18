<?php
session_start();
$pageTitle='Login';
if (isset($_SESSION['user'])) {
    header('Location:index.php'); //redirect to dashbord page
}
include 'init.php';

//cheack requst HTTP post form
if($_SERVER['REQUEST_METHOD']== 'POST'){
    if(isset($_POST['login'])){
    $user=$_POST['username'];
    $pass=$_POST['password'];
    $hashedpass=sha1($pass);
//check the user exit databases
$stmt=$con->prepare("SELECT UserID,Username, Password FROM users WHERE Username=? AND Password=? ");
$stmt->execute(array($user,$hashedpass));
$get=$stmt->fetch();
$count=$stmt->rowCount();
//if count>0 data base exit username
if($count>0){
   $_SESSION['user']=$user; //regster session name
   $_SESSION['uid']=$get['UserID']; //regster userid
   header('Location:index.php'); //redirect to dashbord page
   exit();
}
    }else{
    $formError=array();
    $username  =$_POST['username'];
    $password  =$_POST['password'];
    $password2 =$_POST['password2'];
    $email      =$_POST['email'];
    if(isset($username)){
        $filterdUser=filter_var($username,FILTER_SANITIZE_STRING);
        if(strlen($filterdUser)<3){
            $formError[]='أدخل أسم أكثر من حرفين';
        }
    }
    if(isset($password) && isset($password2)){
        if(empty($password)){
            $formError[]='لأيمكن ترك ألحقل فارغ';
        }
        
        if(sha1($password) !== sha1($password2)){
            $formError[]='كلمة السر غير متطابقة';
        }   
    }
    if(isset($emai)){
        $filterEmail=filter_var($emai,FILTER_SANITIZE_EMAIL);
        if(filter_var($filterEmail,FILTER_VALIDATE_EMAIL) !=true){
            $formError[]='E-Mail غير صحيح';
        }
    }
      //check if no error can add user
      if(empty($forErrors)){
        //check user exist in databases
        $check= checkItem("Username","users",$username);
        if($check == 1){
          $theMsg='<div class="alert alert-danger">ألمستخدم موجود غير ألاسم عذرا</div>';
          $formError[]='أسف ألأسم ألذي أدخلته غير موجود';
        }else{
      //insert user in databaeses
    $stmt=$con->prepare("INSERT INTO users(Username,Password,Email,RegStatus,Date)
     VALUES(:zuser,:zpass,:zmail,0,now())");
      $stmt->execute(array(
        'zuser' =>$username,
        'zpass' =>sha1($password),
        'zmail' =>$email
      ));
      //eho success massage
      $succesMag='سجل دخول بنفس المعلومات لدخول صفحه لبيع'; 
       } 
      }
    }
}
?>

<div class="container-fluid login-page">
<h1 class="text-center">
            <span class="selected" data-class="login">دخول</span> <i class="fas fa-exchange-alt"></i> 
            <span data-class="signup">تسجيل</span>
        </h1>
        <!--start login form-->
    <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="input-container">
        <input 
        class="form-control" 
        type="text" name="username" 
        autocomplete="off" 
        placeholder="أدخل أسمك ألمسجل" 
        required="required">
        </div>
        <input 
        class="form-control" 
        type="password" name="password" 
        autocomplete="new-password" 
        placeholder="أدخل كلمة السر ألمسجلة">
        <input class="btn btn-primary btn-block" name="login" type="submit" value="دخول">
    </form>
    <!--end login form-->
    <!--start signup form-->
    <form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <div class="input-container">
        <input 
        pattern=".{3,}"
        title="أدخل أسم أكثر من حرفين" 
        class="form-control" 
        type="text" name="username" 
        autocomplete="off" 
        placeholder="أدخل أسمك للتسجيل" 
        required="required">   
        </div>

        <div class="input-container">
        <input 
        minlength="4"
        class="form-control" 
        type="password" name="password" 
        autocomplete="new-password" 
        placeholder="أدخل كلمه سر قوية" 
        required="required">
       </div>
       <div class="input-container">
        <input 
        class="form-control" 
        type="password" name="password2" 
        autocomplete="new-password" 
        placeholder="أعدكلمة ألسر" 
        required="required">
        </div>
        <div class="input-container">
        <input 
        class="form-control" 
        type="email" name="email"  
        placeholder="أدخل E-Mail صحيح" 
        required="required">
       </div>
        <input class="btn btn-success btn-block" name="signup" type="submit" value="تسجيل">
    </form>
    <!--end signup form-->
    <div class="the-errors text-center">
    <?php 
    if(! empty($formError)){
        foreach($formError as $error){
            echo "<div class='msg'>$error<br></div>";
        }
    }
    if(isset($succesMag)){
        echo '<div class="nice-massage">'.$succesMag.'</div>';
    }
    
    ?>
    </div>
</div>


<?php
include $tpl.'footer.php';
?>