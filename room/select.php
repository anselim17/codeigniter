<?php
  include("../../connection.php");
  if ($_POST)
{
 
 $roomid=$_POST["search"];
 
  
$sql="select * from tblrooms where Room_ID = '$roomid' ";
 $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));


    while($row=mysqli_fetch_array($result)){
    echo "<div ><img  src=".$row["Image"]." width='175' height='115'></div>";
  
}
}
?>
