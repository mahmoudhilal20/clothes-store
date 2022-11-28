<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php session_start();
if(isset($_SESSION['isAdmin'])){
    if($_SESSION['isAdmin']==2){
        require('config.php');
        $sql = 'select * from clothes';
        $result = mysqli_query($con, $sql);
        if(!$result){
            die('Something went wrong!');
        }
        echo '<table border="1">';
        echo '<tr><th>Clothe ID</th><th>Name</th><th>Price</th><th>Image src</th><th></th></tr>';
        for($i=0; $i<mysqli_num_rows($result); $i++ ){
            $row = mysqli_fetch_assoc($result);
            $id = $row['ID'];
            echo '<tr>';
            echo '<td width="100">'.$row['ID'].'</td>';
            echo '<td width="300">'.$row['Name'].'</td>';
            echo '<td width="100">'.$row['Price'].' L.L.</td>';
            echo '<td width="100"><img src ="Images/'.$row['imgsrc'].'"  width ="100px" height = "100px"/> </td>';
            echo'<td width="100"><button onclick ="total($id)"  >Add to wishlist</button></td>';
            echo '</tr>';
        }
        echo '</table>';  
        echo'<button><a href="logout.php">logout</a></button>';
    }  }   else    header("refresh:0,url=login.php");

?>
</body>
</html>