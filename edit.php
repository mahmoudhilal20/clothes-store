<?php
session_start();

?>

<html>
<body>
<p>Edit this item</p><br>
<?php
if(isset($_SESSION['isAdmin'])){
    if($_SESSION['isAdmin']==1){
       
    if(isset($_POST['submit'])){
        // connect to mySQL to insert data
        
        require('config.php');
        $id = $_POST['ID'];
        $Name = $_POST['Name'];
        $Price = $_POST['Price'];
        $imgsrc = $_FILES['imgsrc'];


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

      


        $sql = "update clothes set Name='".$Name."', Price='".$Price."', imgsrc='$imgsrc' where ID=".$id;
        $result = mysqli_query($con, $sql);
        if(!$result)
            die('something went wrong');
        else{
            header("refresh:3;url=AdminClothes.php");
            echo '<p>successful updated<p>';
            echo $sql;
        }
            
    }
    else{
        //  Show the form
        require('config.php');
        if(!isset($_GET['ID']))
            die('No ID provided');
        $sql = 'select * from clothes where ID='.$_GET['ID'];
        $result = mysqli_query($con, $sql);
        if(!$result){
            die('Something went wrong!');
        }
        if(mysqli_num_rows($result)==0)
            die('No clothe with this id');
        $row = mysqli_fetch_assoc($result);
        
        echo '
        <form action="edit.php" method="POST" enctype="multipart/form-data">
        <input name="ID" value="'.$row['ID'].'" hidden>
            Name<input type="text" name="Name" value="'.$row['Name'].'">
            <br>
            <br>
            Price<input type="text" name="Price" value="'.$row['Price'].'">
            <br>
            <br>
            Image <input type="file" name="imgsrc" value="'.$row['imgsrc'].'">
            
            <br>
            <br>
            <input type="submit" value="submit" name="submit">
        </form>';
        echo'   <button><a href="logout.php">logout</a></button>';
    }}}     else    header("refresh:0,url=login.php");

?>
</body>
</html>


    

   
    






