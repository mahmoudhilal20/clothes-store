<?php
session_start();
?>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
<body>
<button><a href="AddClothes.php">Add a new Clothes</a><br></button>
<br>
<br>
<?php
if(isset($_SESSION['isAdmin'])){
    if($_SESSION['isAdmin']==1){
    require('config.php');
    $sql = 'select * from clothes';
    $result = mysqli_query($con, $sql);

    if(!$result){
        die('Something went wrong!');
    }

    echo '<table border="1">';
    echo '<tr><th>Clothe ID</th><th>Name</th><th>Price</th><th>Image src</th><th>Remove</th></tr>';

    for($i=0; $i<mysqli_num_rows($result); $i++ ){
        $row = mysqli_fetch_assoc($result);
        $id = $row['ID'];
        echo '<tr>';
        echo '<td width="100">'.$row['ID'].'</td>';
        echo '<td width="300"><a href="edit.php?ID='.$id.'" >'.$row['Name'].'</a></td>';
        echo '<td width="100">'.$row['Price'].' L.L.</td>';
        echo '<td width="100"><img src ="Images/'.$row['imgsrc'].'"  width ="100px" height = "100px"/> </td>';
        echo '<td width="150"><a href="remove.php?ID='.$id.'&&imgsrc='.$row['imgsrc'].'">Remove</a></td>';
        echo '</tr>';}
    echo '</table>';
        echo'  <br> <button><a href="logout.php">logout</a></button><br><br>';}   }  else    header("refresh:0,url=login.php");
?>
 <h2>Search for Clothes:</h2>
      <div id="search_area">
    <input type="text" name="employee_search" id="employee_search" class="form-control input-lg" autocomplete="off" placeholder="Type Employee Name" />
    </div>
    <br />
    <br />
    <div id="employee_data"></div>
    </div>
    
    <script>
$(document).ready(function(){
 
 load_data('');
 
 function load_data(query, typehead_search = 'yes')
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{query:query, typehead_search:typehead_search},
   success:function(data)
   {
    $('#employee_data').html(data);
   }
  });
 }
 
 $('#employee_search').typeahead({
  source: function(query, result){
   $.ajax({
    url:"fetch.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data){
     result($.map(data, function(item){
      return item;
     }));
     load_data(query, 'yes');
    }
   });
  }
 });
 
 $(document).on('click', 'li', function(){
  var query = $(this).text();
  load_data(query);
 });
 
});
</script>