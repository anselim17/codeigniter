


<?php
include("../connection.php");
$q = intval($_GET['q']);



    $sql = "select tblrooms.Room_ID, tblcategories.CategoryName, 
                tblrooms.Rate, tblrooms.Description, tblrooms.Quantity,tblrooms.Noadult,tblrooms.Nochild,Image 
                 FROM tblrooms INNER JOIN 
                tblcategories ON tblrooms.Category_ID
                WHERE tblcategories.CategoryName= '".$q.  "'";

   $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
 echo "<table><tr> <th>ID</th><tRoom Number</th><th>Type</th><th>Rate</th><th>Description</th><th>Quantity</th><th>Max_Adult</th><th>Max_child</th><th>Image</th><th>Delete</th><th>Edit</th></tr>";
    while($row=mysqli_fetch_array($result))
    {
           

     echo "<tr><td>" . $row["Room_ID"]. "</td><td> ".$row["CategoryName"]. "</td><td> ".$row["Rate"]. "</td><td> ".$row["Description"]. "</td><td> ".$row["Quantity"]. "</td><td> ".$row["Noadult"]. "</td><td> ".$row["Nochild"]. "</td><td><img id='imagelist' src=".$row["Image"]."></td><td><a href='delete.php?roomid=".$row['Room_ID']."' </a><input type='submit'  value='Delete' onclick='return deleteconfig()'></td><td><a href='editroom.php?roomid=".$row['Room_ID']."' </a><input type='submit'  value='Edit' ></td></tr>";
 
    }
    echo "</table>";
?>
</body>
</html>