<?php
//get all Genral On Databased
function getAllFrom($filed,$table,$where=NULL,$and=NULL,$orderfield,$ordering="DESC"){
    global $con;
    $getAll=$con->prepare("SELECT $filed From  $table $where $and ORDER BY $orderfield $ordering");
    $getAll->execute();
    $all=$getAll->fetchAll();
    return $all;
}

//$pageTitle=>echo page title
//else echo Defult title
function getTitle(){
global $pageTitle;
if(isset($pageTitle)){
    echo $pageTitle;
}else{
    echo 'Defult';
}
}
//home redirect function 
//$theMsg=msseag
//$seconds=befor direct
//url=link redirect
function redirectHome($theMsg,$url=null,$seconds=3){
    if($url == null){
        $url='index.php';
        $link='Homepage';
    }else{
    if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){
     $url= $_SERVER['HTTP_REFERER'];
     $link='Previous Page';
    }else{
        $url='index.php';
        $link='HomePage';
    }
}
echo $theMsg;
echo "<div class='alert alert-info'>You Wil Be Redirected $link After $seconds second.</div>";
header("refresh:$seconds;url=$url");
exit();
}
//function check item databases
//$select=item
//$from=select table
//$value=val select
function checkItem($select,$from,$value){
    global $con;
    $statement=$con->prepare("SELECT $select FROM $from WHERE $select=?");
    $statement->execute(array($value));
    $count=$statement->rowCount();
    return $count;
}
//connt number items coloumn
//$item=item count
//$table=the table  select item
function countItems($item,$table){
    global $con;
$stmt2=$con->prepare("SELECT COUNT($item) FROM $table");
$stmt2->execute();
return $stmt2->fetchColumn();
}
//get lets record function
//get lets from databases
//$limit=number of record
function getLatest($select,$table,$order,$limit=5){
    global $con;
    $getStmt=$con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
    $getStmt->execute();
    $rows=$getStmt->fetchAll();
    return $rows;
}
?>