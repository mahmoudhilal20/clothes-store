<?php
session_start();
require('config.php');
$email=$_GET['email'];
$password=$_GET['password'];
$email=mysqli_real_escape_string($con,$email);
$password=mysqli_real_escape_string($con,$password);
$hashedpassword= hash('sha256', $password);


$sql="Select * from users where Email='$email' and HashedPassword='$hashedpassword'";
$result=mysqli_query($con,$sql);
if(!$result){
    die("Something went wrong");
}
$user=array();

if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    $user['name']=$row['FirstName'];
    $user['isAdmin']=$row['IsAdmin'];
    
}else{
$user['name']="not Found";
$user['isAdmin']=0;
}
echo json_encode($user);

?>