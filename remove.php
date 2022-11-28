<?php
session_start();

?>
<html>
<body>
<p>Remove this Clothe item</p>
<?php
if(isset($_SESSION['isAdmin'])){
    if($_SESSION['isAdmin']==1){
    if(isset($_POST['submit'])){
        // connect to mySQL to insert data
        
        require('config.php');
        $id = $_POST['ID'];
        $file = "Images/".$_POST['imgsrc'];

if (!unlink($file)) {
  echo ("Error deleting $file");
} else {
  echo ("Deleted $file");
}
        $sql = "Delete from clothes where ID=".$id;
        $result = mysqli_query($con, $sql);
        if(!$result)
            die('something went wrong');
        else{
            header("refresh:2;url=AdminClothes.php");
            echo '<p>successful Deleted<p>';
        }
            
    }
    else{
        if(!isset($_GET['ID']))
            die('No ID provided'); 
        echo '
        <form action="remove.php" method="POST">
            <input name="ID" value="'.$_GET['ID'].'" hidden>
            <input name="imgsrc" value="'.$_GET['imgsrc'].'"hidden>
            <p>Press delete to remove this item</p>
            <input type="submit" value="Delete" name="submit">
        </form>';
        echo'   <button><a href="logout.php">logout</a></button>';
    }}   }  else    header("refresh:0,url=login.php");

?>
</body>
</html>


    

   
    






