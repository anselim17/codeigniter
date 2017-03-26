<?php
include("../connection.php");
if ($_POST)
{


$searchroomtype=$_POST['searchroomtype']; 

if ($searchroomtype=="")
{
  echo "";
}
else
{


   $sql = "select tblcategories.CategoryName
                 FROM tblcategories INNER JOIN 
                tblrooms ON tblcategories.Category_ID=tblrooms.Category_ID
                where tblrooms.Room_ID='".$searchroomtype."'";

 $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
 $found=mysqli_num_rows($result);
  if ($found>0)
  {
    while($row=mysqli_fetch_array($result)){

       
    echo "<p><input type='text' name='promoname' class='text' value=".$row['CategoryName']." readonly></p>";
}
}
}
}
?>

