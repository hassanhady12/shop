<?php
ob_start();
session_start();
$noNavbar='';
$pageTitle='Login';

if (isset($_SESSION['Username'])) {
    header('Location:dashboard.php'); //redirect to dashbord page
}

 include 'init.php';

//cheack requst HTTP post form
 if($_SERVER['REQUEST_METHOD']== 'POST'){
     $username=$_POST['user'];
     $password=$_POST['pass'];
     $hashedpass=sha1($password);

//check the user exit databases
$stmt=$con->prepare("SELECT
                          UserID, Username, Password 
                     FROM 
                          users 
                     WHERE 
                          Username=? 
                     AND 
                          Password=? 
                     AND 
                          GroupID=1 
                     LIMIT 1");
$stmt->execute(array($username,$hashedpass));
$row=$stmt->fetch();
$count=$stmt->rowCount();

//if count>0 data base exit username
if($count>0){
    $_SESSION['Username']=$username; //regster session name
    $_SESSION['ID']=$row['UserID']; //regster session ID
    header('Location:dashboard.php'); //redirect to dashbord page
    exit();
}

}

 ?>

<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

<h4 class="text-center">Admin Login</h4>
<input class="form-control input-lg" type="text" name="user" placeholder="Username" autocomplete="off">
<input class="form-control input-lg" type="password" name="pass" placeholder="Password" autocomplete="new-password">
<input class="btn btn-primary btn-block btn-lg" type="submit" value="Login">

</form>

<?php include $tpl . 'footer.php'; ob_end_flush(); ?> 