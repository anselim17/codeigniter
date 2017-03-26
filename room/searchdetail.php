<?php
  include("../../connection.php");
  if ($_POST)
{
 
 $serchdetail=$_POST["detailroom"];
 
  
$sql="select * from tblrooms where Room_ID = '$serchdetail' ";
 $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

    while($row=mysqli_fetch_array($result)){
    	
echo "<br><p><span>Room Number: "." $row[Room_ID]</span></p>";
echo "<p><span>Rate/Price: ₱ "." $row[Rate].00</span></p>";
echo "<p><span>Max of Adult: <b>"." $row[No_adult]</b> person/s</span></p>";
echo "<p><span>Max of Child: <b>"." $row[No_child]</b> person/s</span></p>";





}
}
?>