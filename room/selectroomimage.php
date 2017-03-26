
<?php
    include("../../connection.php");
    if (isset($_POST['searchroomimage']))
    { 
    $searchroomimage=$_POST['searchroomimage']; 
    if ($searchroomimage=="")
    {   
    echo "<div>
          <p><img class='img-responsive img-portfolio img-hover' src='../dist/src/no-image.jpg' alt=''></p>
          <label></label>
          </div>";  
     }
    else
    {

    $sql="select tblcategories.CategoryName, 
    tblrooms.Rate,tblrooms.Discount, tblrooms.Description, tblrooms.Status,tblrooms.No_adult,tblrooms.No_child,tblrooms.Date_Start,tblrooms.Date_End, tblrooms.Image 
    FROM tblrooms Inner JOIN tblcategories on tblrooms.Category_ID=tblcategories.Category_ID
    where tblrooms.Room_ID='".$searchroomimage."'";	

   $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

      while($row=mysqli_fetch_array($result)){
        if($row['Status']=="Available")
        {

      echo "<div>
            <p><img class='img-responsive img-portfolio img-hover' src='".$row['Image']."' alt=''></p>
            <label>Room Type: ".$row['CategoryName']."</label><br/>
            <label>Room Description: ".$row['Description']."</label><br/>
            <label>Room Rate: ".$row['Rate']."</label><br/>
            <label>No# of Adult: ".$row['No_adult']."</label><br/>
            <label>No# of Child: ".$row['No_child']."</label><br/>
            </div>";
        }
        else
        {
          echo "No Rooms Available Found";
        }
      }

    }
}
?>

