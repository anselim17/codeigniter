<?php
  include("../../connection.php");
  if ($_POST)
{
 
 $serchdetail=$_POST["searchroomid"];
 
  
$sql="select * from tblcategories where Category_ID = '$serchdetail' ";
 $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

    while($row=mysqli_fetch_array($result)){
    	
echo "<input value=".$row['CategoryName']." class='form-control' name='cName' id='cName' type='text' placeholder='Category Name'>";


}
}
?>