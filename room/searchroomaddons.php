<?php
  include("../../connection.php");
  if ($_POST)
{
 
 $serchdetail=$_POST["searchid"];
 
  
$sql="select * from tbladdons where addon_id = '$serchdetail' ";
 $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

    while($row=mysqli_fetch_array($result)){
    	
echo "<input value=".$row['item']." type='text' name='additem' id='additem' class='form-control' placeholder='Item'><br>";
echo "<input value=".$row['price']." onkeypress='return isNumberKey(event)' class='form-control' name='addprice' id='addprice' type='text' placeholder='Price'><br>";
echo "<input value=".$row['quantity']." onkeypress='return isNumberKey(event)' class='form-control' name='addquantity'id='addquantity' type='text' placeholder='Quantity'><br>"; 


}
}
?>