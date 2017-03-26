<?php
  include("../connection.php");
  if ($_POST)
{
 
 $limitadult=$_POST["searchadult"];
 
  
$sql="select No_adult from tblrooms where Discount = '$limitadult' ";
 $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

    while($row=mysqli_fetch_array($result)){
      
    for($x=0; $x<=$row["No_adult"]; $x++)
    {
        echo "<select>";
        echo "<option>$x</option>";
        echo "</select>";
    }   

}
}
?>

<?php
  include("../connection.php");
  if ($_POST)
{
 
 $limitchild=$_POST["searchchild"];
 
  
$sql="select No_child from tblrooms where Discount = '$limitchild' ";
 $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

    while($row=mysqli_fetch_array($result)){
    	
    for($x=0; $x<=$row["No_child"]; $x++)
    {
        echo "<select>";
        echo "<option>$x</option>";
        echo "</select>";
    }   

}
}
?>