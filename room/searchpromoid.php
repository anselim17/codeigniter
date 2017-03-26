<?php
  include("connection.php");
  session_start();
if ($_POST)
{
$searchpromoid=$_POST['searchpromoid'];


    $sql = "select * from tblpromotion 
                where Room_ID='".$searchpromoid."'";


   $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

   while($row=mysqli_fetch_array($result)){

    echo "<div>"; 
echo "<p><input type='hidden' name='categoryname' id='categoryname' value=".$row['CategoryName']."> </p>";
echo "<p><input type='hidden' name='roomid' id='roomid' value=".$row['Room_ID']." > </p>";
echo "<p><input type='hidden' name='start' id='arrival' value=" .$_SESSION["date"]["arrival"]."> </p>";
echo "<p><input type='hidden' name='end'  id='departure' value=" .$_SESSION["date"]["departure"]."></p>";
echo "<p><input type='hidden' name='numberofdays'  id='numberofdays' value=".$_SESSION["date"]["numberofdays"]."></p>";
echo "<p><input type='hidden' name='total' id='total' value=" .$_SESSION["total"]."></p>";
echo "<p><input type='checkbox' value='1' id='checkboxInp'  style='float:left;''></p>";
echo "<p><span class='remme'>I agree the terms and condition of this hotel</span></p>";
echo "<p><input type='button' name='reserve' class='button' value='Reserve'  onclick='validReservePromo()' ></p> ";              
echo "</div>";
  }
}
?>
