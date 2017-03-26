<?php
  include("../../connection.php");
  if ($_POST)
{
 
 $searchaddonid=$_POST["searchaddonid"];
 
  
$sql="select * from tbladdons where addon_id = '$searchaddonid' ";
 $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

    while($row=mysqli_fetch_array($result)){
echo "<div>";    	
echo "<input type='text' name='additem'  class='form-control' value=".$row['item']." placeholder='Item'><br>";
echo "<input onkeypress='return isNumberKey(event)' class='form-control' name='addprice' id='addprice' type='text' placeholder='Price'>
<br>";
echo "<input onkeypress='return isNumberKey(event)' class='form-control' name='addquantity'id='addquantity' type='text' placeholder='Quantity'>";
echo "</div>";




}
}
?>