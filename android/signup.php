<?php
require('config.php');
$str='';

$email=$_GET['email'];


$sql="select * from users where Email='$email'";
$result=mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
   
    $str='Email Already registered! ';
    
} else{
    $Firstname=mysqli_real_escape_string($con,$_GET['firstname']);
    $Familyname=mysqli_real_escape_string($con,$_GET['lastname']);
    
    $email1=mysqli_real_escape_string($con,$_GET['email']);
    $password=mysqli_real_escape_string($con,$_GET['password']);
    $hashedpassword=hash('sha256', $password);
    $sql = "insert into users(FirstName, FamilyName, Email,HashedPassword,IsAdmin ) values ('$Firstname','$Familyname','$email1','$hashedpassword','2')";
    $result=mysqli_query($con,$sql);
    if(!$result){
        $str="A Problem has happened Please try again later";

    }else{
        $str="SUCCESSFULLY ADDED!";
        
    }
    
}



echo json_encode($str);
?>


