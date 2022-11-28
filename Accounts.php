<?php

session_start();


?>
<html>
<body>

<?php
if(isset($_SESSION['isAdmin'])){
    if($_SESSION['isAdmin']==1){
     echo"   <p>Administrator's home page</p><br>";
    require('config.php');
    $sql = 'select * from users';

    // execute the above query on the $con connection
    $result = mysqli_query($con, $sql);

    //  in case the query is not valid or misspelled (problem in the execution)
    if(!$result){
        die('Something went wrong!');
    }

    echo '<table border="1">';
    echo '<tr><th>ID</th><th>First Name</th><th>Family Name</th><th>Email</th><th>Switch</th><th>Resest Password</th></tr>';

    //  List the retreived books
    for($i=0; $i<mysqli_num_rows($result); $i++ ){
        $row = mysqli_fetch_assoc($result);
        
        echo '<tr>';
        echo '<td width="100">'.$row['ID'].'</a></td>';
        echo '<td width="100">'.$row['FirstName'].'</td>';
        echo '<td width="100">'.$row['FamilyName'].'</td>';  
        echo '<td width="100">'.$row['Email'].'</td>';
        if ($row['IsAdmin']=='1')
        echo '<td><a href="SwitchUser.php?ID='.$row["ID"].'&&k=0">Admin</a></td>';
        else 
        echo '<td><a href="SwitchUser.php?ID='.$row["ID"].'&&k=0"> User</a></td>';
        echo '<td><a href="SwitchUser.php?ID='.$row["ID"].'&&k=1"> Reset Password</a></td>';
        echo '</tr>';

    }

    echo '</table>';
    echo'   <button><a href="logout.php">logout</a></button>';
    }}
    else

            header("refresh:0,url=login.php");
        






    
?>
</body>
</html>


    

   
    






