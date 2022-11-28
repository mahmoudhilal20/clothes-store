<?php
session_start();

if(isset($_SESSION['isAdmin'])){
    if($_SESSION['isAdmin']==1){
       


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
body{
    max-width:300px;
    align-content: center;
    margin: auto;
    background-image: url('loginbackground.jpg');
    background-size: 20cm;
    margin-top: 50px;
}</style>
<body>
<?Php

require('config.php');
  echo'  <button><a href="Accounts.php">Accounts</a></button>
    <button><a href="AdminClothes.php">Clothes</a></button>
<br>';
echo'<h2>Aministrator Home Page</h2>';
echo'   <button><a href="logout.php">logout</a></button>';
} }    else    header("refresh:0,url=login.php");
 ?>
</body>
</html>