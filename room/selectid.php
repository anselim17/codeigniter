<?php
  include("../connection.php");
if ($_POST)
{
$roomid=$_POST['searchroomid'];

$sql = "select tblrooms.Room_ID, tblcategories.CategoryName, 
                tblrooms.Rate, tblrooms.Description, tblrooms.Status,tblrooms.No_adult,tblrooms.No_child,tblrooms.Image,tblrooms.Date_Start,tblrooms.Date_End 
                 FROM tblrooms INNER JOIN 
                tblcategories ON tblrooms.Category_ID=tblcategories.Category_ID
                where tblrooms.Room_ID= '".$roomid.  "'";

   $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

   while($row=mysqli_fetch_array($result)){
    echo "<div><p><input text='type' name='roomid'  id='rmid' class='text' value=".$row['Room_ID']."></p>";
    echo"  <p><select  class='text'  name='categoryname' id='ctyname' >
            <option>$row[CategoryName]</option>
            </select></p>";
    echo "<p><input type='text'  name='discount'  id='discount'  class='text' placeholder='Discount'><p>";
    echo "<p><input type=''  class='text' name='rate' id='rate' value=".$row['Rate']."><p>";
    echo "<p><input text='type'  class='text' name='descript' id='descript' value=".$row['Description']."><p>";
    echo "<p><select name='status' id='status' class='text'>
          <option>Available</option>
          <option>Not Available</option></select></p>";
    echo "<p><input text='type' name='adult' id='adult'  class='text' value=".$row['No_adult']."><p>";
    echo "<p><input text='type' name='child' id='child' class='text' value=".$row['No_child']."><p>";
    echo "<p><input type='button' name='editroom'  class='button2' style='margin-top:120px;'  value='Add' onclick='validEditRoom()' ></p>"; 
  }
}
?>
