
<?php
include("../connection.php");
if ($_POST)
{


$searchroomimage=$_POST['searchroomimage']; 

if ($searchroomimage=="")
{
  echo "<img id='previewing' src='no-image.jpg' width='175' height='115' >";
   echo "<div>no image</div>";
}
else
{


   $sql = "select tblrooms.Image,tblrooms.Discount
                 FROM tblrooms INNER JOIN 
                tblcategories ON tblrooms.Category_ID=tblcategories.Category_ID
                where tblrooms.Discount='".$searchroomimage."'";

 $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
 $found=mysqli_num_rows($result);
  if ($found>0)
  {
    while($row=mysqli_fetch_array($result)){
    echo "<img  src=".$row["Image"]." width='175' height='115'>";

      echo "<div>$row[Image]</div>";
}
}
}
}
?>