	
<?php
if ($_POST)
{
    include("../connection.php");
$searchdate=$_POST['searchstartdate'];


   $sql = "select * from tblreservation
                where Room_ID='".$searchdate."'";


   $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

   while($row=mysqli_fetch_array($result)){
    echo "$row[Arrival]";
    
 
  }
}
?>


