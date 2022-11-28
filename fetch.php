<?php
//fetch.php
if(isset($_POST["query"]))
{
    require('config.php');
    $request = mysqli_real_escape_string($con, $_POST["query"]);
 $sql = "
  SELECT * FROM clothes 
  where Name LIKE '%".$request."%'
 ";
 $result = mysqli_query($con, $sql);
 $data =array();
 $html = '';
 $html .= '
 <table border="1"><tr><th>Clothe ID</th><th>Name</th><th>Price</th><th>Image src</th><th>Remove</th></tr>';
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  { $id = $row['ID'];
   $data[] = $row["ID"];
   $data[] = $row['Name'];
   $data[] = $row['Price'];
   $data[] = $row['imgsrc'];
   $html .= '
   <tr>
    <td width="100">'.$row['ID'].'</td>;
    <td width="300"><a href="edit.php?ID='.$id.'" >'.$row['Name'].'</a></td>
    <td width="100">'.$row['Price'].' L.L.</td>
    <td width="100"><img src ="Images/'.$row['imgsrc'].'"  width ="100px" height = "100px"/> </td>
    <td width="150"><a href="remove.php?ID='.$id.'&&imgsrc='.$row['imgsrc'].'">Remove</a></td>
   </tr>
   ';
  }
 }
 else
 {
  $data = 'No Data Found';
  $html .= '
   <tr>
    <td colspan="5">No Data Found</td>
   </tr>
   ';
 }
 $html .= '</table>';
 if(isset($_POST['typehead_search']))
 {
  echo $html;
 }
 else
 {
  $data = array_unique($data);
  echo json_encode($data);
 }
}

?>