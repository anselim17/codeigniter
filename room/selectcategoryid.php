<?php
  include("../connection.php");
if ($_POST)
{
$searchcategoryid=$_POST['searchcategoryid'];


    $sql = "select * from tblcategories
                where Category_ID='".$searchcategoryid."'";


   $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

   while($row=mysqli_fetch_array($result)){

    echo "<div>"; 
    echo "<p><input type='text' name='cID' id='cID' class='text' value=".$row['Category_ID']." readonly></p>";
    echo "<p><input type='text' name='cName'  id='cName' class='text' value=".$row['CategoryName']. "></p>";
    echo "<p><input type='button' name='edit' class='button2'  value='Edit' onclick='valideditCategory()' ></p>";              
    echo "</div>";
  }
}
?>
