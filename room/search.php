
<?php
include("../connection.php");
if ($_POST)
{

$search=$_POST['search']; 

if ($search=="Show All Room" )
{
    $sql = "select tblrooms.Room_ID, tblcategories.CategoryName, 
                tblrooms.Rate, tblrooms.Description, tblrooms.Status,tblrooms.No_adult,tblrooms.No_child,tblrooms.Image 
                 FROM tblrooms INNER JOIN 
                tblcategories ON tblrooms.Category_ID=tblcategories.Category_ID";

   $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

 echo "<table><tr> <th>ID</th><th>Type</th><th>Rate</th><th>Description</th><th>Status</th><th>No_Adult</th><th>No_child</th></th><th>Image</th><th>Delete</th><th>Edit</th></tr>";
    while($row=mysqli_fetch_array($result))
    {
           
 echo "<tr><td>" . $row["Room_ID"]. "</td><td> ".$row["CategoryName"]. "</td><td> ".$row["Rate"]. "</td><td> ".$row["Description"]. "</td><td> ".$row["Status"]. "</td><td> ".$row["No_adult"]. "</td><td> ".$row["No_child"]. "</td><td><a rel='facebox' href='editpic.php?id=". $row['Room_ID']."'><img id='imagelist' src=".$row["Image"]."></a></td><td><a href='delete.php?roomid=".$row['Room_ID']."' </a><input type='submit'  value='Delete' onclick='return deleteconfig()'></td><td></a><button value=".$row["Room_ID"]."  class='editroom'>Edit</button></td></tr>";
 
    }
    echo "</table>";
  }

else
{

   $sql = "select tblrooms.Room_ID, tblcategories.CategoryName, 
                tblrooms.Rate, tblrooms.Description, tblrooms.Status,tblrooms.No_adult,tblrooms.No_child,tblrooms.Image 
                 FROM tblrooms INNER JOIN 
                tblcategories ON tblrooms.Category_ID=tblcategories.Category_ID
                where tblcategories.CategoryName= '".$search.  "'";

   $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

 echo "<table><tr> <th>ID</th><th>Type</th><th>Rate</th><th>Description</th><th>Status</th><th>No_Adult</th><th>No_child</th></th><th>Image</th><th>Delete</th><th>Edit</th></tr>";
    while($row=mysqli_fetch_array($result))
    {
           
 echo "<tr><td>" . $row["Room_ID"]. "</td><td> ".$row["CategoryName"]. "</td><td> ".$row["Rate"]. "</td><td> ".$row["Description"]. "</td><td> ".$row["Status"]. "</td><td> ".$row["No_adult"]. "</td><td> ".$row["No_child"]. "</td><td><a rel='facebox' href='editpic.php?id=". $row['Room_ID']."'><img id='imagelist' src=".$row["Image"]."></a></td><td><a href='delete.php?roomid=".$row['Room_ID']."' </a><input type='submit'  value='Delete' onclick='return deleteconfig()'></td><td></a><button value=".$row["Room_ID"]."  class='editroom'>Edit</button></td></tr>";
 
    }
    echo "</table>";
  }
 }

?>