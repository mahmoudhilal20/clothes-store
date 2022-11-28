<?php
require("config.php");
$str="";
$email=$_GET['email'];
$sql="select * from users where Email='$email'";
$result=mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
    $six_digit_random_number = rand(100000, 999999);
    $msg="Dear ".$email."\n your new password is ".$six_digit_random_number."";
    $hashedpassword=hash('sha256',$six_digit_random_number);
    $sql = "update users set HashedPassword='".$hashedpassword."'where Email='".$email."'";
    $result=mysqli_query($con,$sql);
    $str="Password has been changed.Please check your email for the new password.";
    $msg="Dear ".$email."\n your new password is ".$six_digit_random_number."";
//    mail($email,"MH Clothes store Account Password Change",$msg);
}else{
    $str="Email is incorrect!";
}
echo json_encode($str);
?>