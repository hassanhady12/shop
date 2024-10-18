
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php getTitle()?></title>
<link rel="stylesheet" href="<?php echo $css ; ?>bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $css ; ?>solid.css">
<link rel="stylesheet" href="<?php echo $css ; ?>brands.css">
<link rel="stylesheet" href="<?php echo $css ; ?>fontawesome.css">
<link rel="stylesheet" href="<?php echo $css ; ?>hover.css">
<link rel="stylesheet" href="<?php echo $css ; ?>animate.css">
<link rel="stylesheet" href="<?php echo $css ; ?>style.css">
    
    
<!--[if lt IE 9]>
<script src="layout/js/html5shiv.min.js"></script>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYm
<script src="layout/js/respond.min.js"></script>  
<![endif]-->

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200&display=swap" rel="stylesheet">

</head>
<body>
<!--
<div class="upper-bar">
<div class="container">
<?php
//if(isset($_SESSION['user'])){  
//$alluser=getAllFrom('*','users','where RegStatus=1','','UserID');
?>
<div class="btn-group my-info">
<span class="btn btn-default dropdown-toggle" data-toggle="dropdown">
<?php //echo $sessionUser ?>
<span class="caret"></span>
</span>
<ul class="dropdown-menu">
<li><a href="profile.php">معلوماتي</a></li>
<li><a href="newad.php">بيع منتج</a></li>
<li><a href="profile.php#my-ads">منتجاتي </a></li>
<li><a href="logout.php">تسجيل خروج</a></li>
</ul>
</div>
<?php
//}else{
?>
<a href="login.php">
<span class="pull-right btn btn-primary">سجل لبيع منتجك</span>
</a>
<a class="btn btn-success" href="index.php">ألصفحة ألرئسية</a>
<?php //} ?>
</div>
</div> -->

<nav class="navbar  navbar-inverse navbar-fixed-top" role="navigation">

<div class="container">

<div class="navbar-header">

<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
data-target="#ournavbar" aria-expanded="false">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>

</div>

<div class="collapse navbar-collapse" id="ournavbar">
<ul class="nav navbar-nav navbar-right">
<li class="active"><a href="index.php">ألصفحة ألرئسية <span class="sr-only">(current)</span></a></li>
<?php
$allCat=getAllFrom("*","categories","where parent=0","","ID","ASC");
foreach( $allCat as $cat){ ?>
<li class="dropdown"> 
<?php echo '<a href="categories.php?pageid='.$cat['ID'].'" class="dropdown-toggle" 
data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$cat['Name'].' <span class="caret">
</span>
</a>';
?>

<ul class="dropdown-menu">
<?php
echo '<Li><a href="allcate.php?pageid='.$cat['ID'].'">ALL</a></Li>';
?>
<?php
$allCat=getAllFrom("*","categories","where parent={$cat['ID']}","","ID","ASC");
foreach($allCat as $chiled){
echo '<li role="separator" class="divider"></li>';
echo  '<li><a href="categories.php?pageid='.$chiled['ID'].'">'.$chiled['Name'].'</a></li>';  
}
?>

</ul>
<?php  }; ?>
</li>
</ul>
</div>

</div>
<!--end the contener-->
</nav>
<!--end navbar-->

<div id="myslid" class="carousel slide" data-ride="carousel">
<ol class="carousel-indicators ">
<li data-target="#myslid" data-slide-to="0" class="active"></li>
<li data-target="#myslid" data-slide-to="1"></li>
<li data-target="#myslid" data-slide-to="2"></li>
<li data-target="#myslid" data-slide-to="3"></li>
</ol>

<div class="carousel-inner" role="listbox">
<div class="item active">
<img src="layout/imags/a.jpg" width="1920" height="600" alt="pic1">
<div class=" carousel-caption">
<h2>مكتب ألمحترف</h2>
<p class="lead">عنوان شارع ألصناعه عمارة النعمان ألطابق ألاول<br> <b> رقم ألهاتف:07713399305</b></p>
</div>
</div>

<div class="item">
<img src="layout/imags/b.jpg" width="1920" height="600" alt="pic2">
<div class=" carousel-caption">
<h2>أختصاص بيع</h2>
<p class="lead">كافه ألاجهزه ألاكترونيه وتجميعات PC</p>
</div>
</div>

<div class="item">
<img src="layout/imags/c.jpg" width="1920" height="600" alt="pic3">
<div class=" carousel-caption">
<h2>أرخص ألاسعار</h2>
<p class="lead">كافه الاجهزه وقطع التجمعيه توجد لدينا وباسعار تنافسيه </p>

</div>
</div>

<div class="item">
<img src="layout/imags/d.jpg" width="1920" height="600" alt="pic4">
<div class=" carousel-caption">
<h2>أقسام البيع</h2>
<p class="lead">بيع جميع أنواع PC,LAB,MOUSE,KEYBORD,HADEPHONE</p>
</div>
</div>

</div>

<a class="left carousel-control" href="#myslid" role="button" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>

<a class="right carousel-control" href="#myslid" role="button" data-slide="next">
<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>
<!--end Carousel-->









