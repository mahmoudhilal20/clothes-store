<?php
session_start();
require('config.php');

$sql='select * from clothes ';
$result=mysqli_query($con,$sql);




$items=array();
$item=array();
$j=0;
for($i=0;$i<mysqli_num_rows($result);$i++){
    $row=mysqli_fetch_assoc($result);
    $item['name']=$row["Name"];
    $item['price']=$row["Price"];
    $item['imagepath']=$row["imgsrc"];
    array_push($items,$item);
        }
        
echo json_encode($items);


?>