
<?php
if ($_POST)
{
    include("../connection.php");
$searchenddate=$_POST['searchenddate'];


   $sql = "select * from tblrooms
                where Room_ID='".$searchenddate."'";


   $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

   while($row=mysqli_fetch_array($result)){
    echo "$row[Date_End]";
 
  }
}
?>