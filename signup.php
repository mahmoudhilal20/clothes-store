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
<style>
body{
    max-width:300px;
    align-content: center;
    margin: auto;
    background-size: 20cm;
    margin-top: 50px;
}
</style>
    <title>Document</title>
    
</head>
<body>
<?php
   if(isset($_POST['submit'])){
    require('config.php');
    if(empty($_POST['Firstname']) && empty($_POST['Familyname']) && empty($_POST['password1']) && empty($_POST['password2']) && empty($_POST['email1']) && empty($_POST['email2']))    {      
           header('refresh:3, url=signup.php');
          echo '<p>PLease Enter Valid inputs</p>';
     }
  else{
     $Firstname = $_POST['Firstname'];
     $Familyname = $_POST['Familyname'];
     $email1 = $_POST['email1'];
     $email2 = $_POST['email2'];
     if($email1!=$email2){
        header('refresh:3, url=signup.php');
        echo '<p> the Email should be the same</p>';
        
     }
     $sql1="select * from users where Email='".$email1."'";
     $result1 = mysqli_query($con, $sql1);
     if(mysqli_num_rows($result1)!=0)    // username is used by someone else
   {  header('refresh:3, url=signup.php');
     die ('<p>Email is already taken</p>');}
     $password1 = $_POST['password1'];
     $password2 = $_POST['password2'];
     if($password1!=$password2){
        header('refresh:3, url=signup.php');
        echo '<p>Password is not the same</p>';
        
     }
     $hashedpassword=hash('sha256',$password1);
     
      
     $sql = "insert into users(FirstName, FamilyName, Email,HashedPassword,IsAdmin ) values ('$Firstname','$Familyname','$email1','$hashedpassword','2')";
     $result = mysqli_query($con, $sql);
     if(!$result)
         die($sql);
        
     else{
         header("refresh:3;url=login.php");
         echo '<p>successful insertion<p>';
     }
}  
    
        
}
else{
        //  Show the form
        echo '
        <h4>Fill the following information to sign up</h4>
        <form action="signup.php" id="p1" method="POST">
             First Name <input type="text" class="form-control" id="ex3" name="Firstname">
            <br>
            Family Name <input type="text" class="form-control" id="ex3" name="Familyname">
            <br>
            Email<input type="text" class="form-control" id="ex3" name="email1">
            <br>
            Re-Enter Email<input type="text" class="form-control" id="ex3" name="email2">
            <br>
            password<input name="password1" class="form-control" id="ex3" type="password">
            <br>
            Re-Enter password<input name="password2" class="form-control" id="ex3" type="password">
            <br>
        
            <input type="submit" value="Signup" class="btn btn-primary" id="p2"  name="submit">
            
        </form>';}
    ?>
</body>
</html>