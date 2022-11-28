<?php

session_start();
if(isset($_SESSION['isAdmin'])){
    if($_SESSION['isAdmin']==1)
        header("refresh:0,url=Admin.php");
    
    else if ($_SESSION['isAdmin']==2){
        header("refresh:0,url=UserClothes.php"); 
    }}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
</head>


<body>
<h2> MH Clothes Store</h2>
<br>
<?php

    if(isset($_POST['submit'])){
        require('config.php');
        if(empty($_POST['email'] || empty($_POST['password'])))
            die('email or password not entered!');

        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedpassword=hash('sha256',$password);
        $sql = "select * from users where Email='".$email."' and HashedPassword='".$hashedpassword."'";
        $result = mysqli_query($con, $sql);
        if(!$result)
            die('something went wrong');
            
        if(mysqli_num_rows($result)==0){
           header('refresh:3, url=login.php');
           echo '<p>Wrong credential</p>';
            
        }
        else{
            $row = mysqli_fetch_assoc($result);
            if($row['IsAdmin']=='1')
            {  $_SESSION["isAdmin"]="1";
                header('refresh:0;url=Admin.php');
              }
            else if($row['IsAdmin']!='0'){
                $_SESSION["isAdmin"]="2";
                    header('refresh:0;url=UserClothes.php');
                   }
        }
            
        
            
    }
    else{
        //  Show the form
        echo '
        <form action="login.php" id="p1" method="POST">
        email Address<input type="text" class="form-control" id="ex3" name="email">
            <br>
            
            password<input name="password" class="form-control" id="ex3" type="password">
           
           
            <a href="forgetpassword.php">Forget Password?</a>
            <br>
            <br>
            <input type="submit" value="login" class="btn btn-primary" id="p2"  name="submit">
            
        </form>';
    }
?>
</body>
</html>