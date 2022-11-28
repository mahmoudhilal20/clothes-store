<?php
session_start();

if(isset($_SESSION['isAdmin'])){
    if($_SESSION['isAdmin']==1){
require('config.php');
$id=$_GET['ID'];
$k=$_GET['k'];

$sql="select * from users where ID='".$id."'";
$result=mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
if($id!="0"){
if(!$result)
die('something went wrongs');
if(mysqli_num_rows($result)==0){
header('refresh:3, url=Accounts.php');
die ('<p>Wrong credential</p>');

}
else{
    if($row['IsAdmin']=='1')
    $sql = "update users set IsAdmin='0'where ID=".$row['ID']."";
    else
    $sql = "update users set IsAdmin='1'where ID=".$row['ID']."";
    $result = mysqli_query($con, $sql);
header('refresh:0,url=Accounts.php');
}
}
if($k!="0"){
    $six_digit_random_number =rand(100000, 999999);
    $hashedpassword=hash('sha256',$six_digit_random_number);
   
 
$sql2= "update users set HashedPassword='".$hashedpassword."' where ID=".$row['ID'];
 $result = mysqli_query($con, $sql2);
 if(!$result)
     die('something went wrong');
 else{
     
  //  $msg="Dear ".$row['FirstName']."\n your new password is ".$six_digit_random_number."";

    // mail($row['Email'],"FM Clothes store Password Change",$msg);
   
   
   header("refresh:3;url=Accounts.php");
   echo"Password has been reset.";

 }
}}     else    header("refresh:0,url=login.php");
}?>
