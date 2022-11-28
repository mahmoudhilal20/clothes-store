
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <title>Forget password</title>
</head>
<style>
body{
    max-width:300px;
    align-content: center;
    margin: auto;
    background-image: url('loginbackground.jpg');
    background-size: 20cm;
    margin-top: 50px;
}
#p1{
border: tomato;
}
#p2{
margin-left: 100px;
}</style>
<body>
<?php

if(isset($_POST['submit'])){
    require('config.php');
    if(empty($_POST['email'])){
    header('refresh:3, url=forgetpassword.php');
    echo '<p>Wrong credential</p>';}

    $email = $_POST['email'];
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
       die("Invalid email");
      


       $six_digit_random_number = rand(100000, 999999);
       $msg="Dear ".$email."\n your new password is ".$six_digit_random_number."";
       $hashedpassword=hash('sha256',$six_digit_random_number);
     $sql1="Select Email from users where Email ='".$email."'";
     $result = mysqli_query($con, $sql1);

    if(mysqli_num_rows($result)==0){
    header("refresh:2,url='forgetpassword.php'");
echo("This is not a registered Email");}
    else{
  $sql2 = "update users set HashedPassword='".$hashedpassword."'where Email='".$email."'";
  
    $result = mysqli_query($con, $sql2);
    if(!$result)
        die('something went wrongs');
    else{
      //  mail($email,"FM Clothes store Password Change",$msg);
      header("refresh:2,url='login.php'");
        echo"Password Changed. Please check your Email for the new password";
    }}
        
    
        
}
else{
    //  Show the form
    echo '

    <form action="forgetpassword.php" id="p1" method="POST">
        Enter your email Address <input type="text" class="form-control" id="ex3" name="email">
        <br>
        <br>

        <input type="submit" value="send" class="btn btn-primary" id="p2"  name="submit">
        
    </form>';
}
?>
</body>
</html>