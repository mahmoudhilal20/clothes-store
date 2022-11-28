<?php
session_start();    
?>
<html>
<body>
<p>Add a new Clothe Item</p><br>
<?php
if(isset($_SESSION['isAdmin'])){
    if($_SESSION['isAdmin']==1){

    if(isset($_POST['submit'])){
        // connect to mySQL to insert data
        
        require('config.php');
        $Name = $_POST['Name'];
        $Price = $_POST['Price'];
      // $imgsrc=$_FILES['imgsrc'];

  if(isset($_FILES['imgsrc'])){

    $errors= array();
    $file_name = $_FILES['imgsrc']['name'];
    $file_size =$_FILES['imgsrc']['size'];
    $file_tmp =$_FILES['imgsrc']['tmp_name'];
    $file_type=$_FILES['imgsrc']['type'];
    $fileNameCmps = explode(".", $file_name);
    $file_ext = strtolower(end($fileNameCmps));
    
    $expensions= array("jpeg","jpg","png");
    
    if(in_array($file_ext,$expensions)=== false){
       $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if($file_size > 2097152){
       $errors[]='File size must be excately 2 MB';
    }
    
    if(empty($errors)==true){
       move_uploaded_file($file_tmp,"Images/".$Name.".jpg");

       echo "Success";
    }else{
       print_r($errors);
    }
 }

 $imgsrc= $Name.".".$file_ext;
 
        $sql = "insert into clothes (Name, Price, imgsrc) values ('$Name',$Price,'$imgsrc')";
        $result = mysqli_query($con, $sql);
    
        if(!$result)
            die('something went wrong');
        else{
            header("refresh:2;url=AdminClothes.php");
            echo '<p>successful insertion<p>';
        }   
        }
    else{
        //  Show the form
        echo '
        <form action="AddClothes.php" method="POST" enctype="multipart/form-data">
             Name <input type="text" name="Name">
            <br>
            <br>
            Price <input type="text" name="Price">
            <br>
            <br>
            image source<input type="file" value="imgsrc" name="imgsrc" id="imgsrc"  >
            <br>
            <br>
            <input type="submit" value="submit" name="submit">
        </form>';
        echo'   <button><a href="logout.php">logout</a></button>';
    }}   }  else    header("refresh:0,url=login.php");

?>
</body>
</html>



