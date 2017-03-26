<?php
  include("../connection.php");
  if ($_POST)
{
 
 $serchdetailpromo=$_POST["detailpromoroom"];
 
  
$sql="select * from tblpromotion where Room_ID = '$serchdetailpromo' ";
 $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

    while($row=mysqli_fetch_array($result)){
    	
echo "<p><span>Room# "." $row[Room_ID]</span></p>";
echo "<p><span>Rate "." $row[Promo_Rate]</span></p>";
echo "<p><span>Room Type "." $row[CategoryName]</span></p>";
echo "<p><span>Discount "." $row[Discount]%</span></p>";
echo "<p><span>Arrival "." $row[Date_Start]</span></p>";
echo "<p><span>Departure "." $row[Date_End]</span></p>";






}
}
?>