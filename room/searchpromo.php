
<?php
include("../connection.php");
if ($_POST)
{

$searchroomid=$_POST['searchroomid']; 

if ($searchroomid=="Show All Promo Room" )
{
    $sql = "select tblpromotion.Room_ID, tblpromotion.CategoryName, 
                tblpromotion.Promo_Rate,tblpromotion.Discount, tblpromotion.Description,tblpromotion.Status, 
                tblpromotion.Date_Start,tblpromotion.Date_End,tblrooms.Image 
                 FROM tblpromotion INNER JOIN 
                tblrooms ON tblpromotion.Room_ID=tblrooms.Room_ID";

   $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
 echo "<table><tr><th>Room_ID</th><th>RoomType</th><th>Promo_Rate</th><th>Discount</th><th>Description</th><th>Status</th><th>Date_Start</th><th>Date_End</th><th>Image</th><th>Delete</th><th>Edit</th></tr>";
    while($row=mysqli_fetch_array($result))
    {
           

  echo "<tr><td>" . $row["Room_ID"]. "</td><td> ".$row["CategoryName"]. "</td><td> ".$row["Promo_Rate"]. "</td><td> ".$row["Discount"]." '%'</td><td> ".$row["Description"]. "</td><td> ".$row["Status"]. "</td><td> ".$row["Date_Start"]. "</td><td> ".$row["Date_End"]. "</td><td><img id='imagelist' src=".$row["Image"]."></td><td><a href='deletepromo.php?promoid=".$row['Room_ID']."' </a><input type='submit'  value='Delete' onclick='return deleteconfig()'></td><td><button value=".$row["CategoryName"]."  class='editpromo'>Edit</button></td></td></tr>";
 
    }
    echo "</table>";

  
}

else
{

    $sql = "select tblpromotion.Room_ID, tblpromotion.CategoryName, 
                tblpromotion.Promo_Rate,tblpromotion.Discount, tblpromotion.Description,tblpromotion.Status, 
                tblpromotion.Date_Start,tblpromotion.Date_End,tblrooms.Image 
                 FROM tblpromotion INNER JOIN 
                tblrooms ON tblpromotion.Room_ID=tblrooms.Room_ID
                where tblpromotion.CategoryName='".$searchroomid."'";

   $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
 echo "<table><tr><th>Room_ID</th><th>RoomType</th><th>Promo_Rate</th><th>Discount</th><th>Description</th><th>Status</th><th>Date_Start</th><th>Date_End</th><th>Image</th><th>Delete</th><th>Edit</th></tr>";
    while($row=mysqli_fetch_array($result))
    {
           

  echo "<tr><td>" . $row["Room_ID"]. "</td><td> ".$row["CategoryName"]. "</td><td> ".$row["Promo_Rate"]. "</td><td> ".$row["Discount"]." '%'</td><td> ".$row["Description"]. "</td><td> ".$row["Status"]. "</td><td> ".$row["Date_Start"]. "</td><td> ".$row["Date_End"]. "</td><td><img id='imagelist' src=".$row["Image"]."></td><td><a href='deletepromo.php?promoid=".$row['Room_ID']."' </a><input type='submit'  value='Delete' onclick='return deleteconfig()'></td><td><button value=".$row["CategoryName"]."  class='editpromo'>Edit</button></td></td></tr>";
 
    }
    echo "</table>";

  
  }
 }

?>