
<?php
   session_start();
    include("../../connection.php");
          $Numberofdays=$_SESSION['Numberofdays'];
        if (isset($_POST['searchroomid']))
        { 
        $searchroomid=$_POST['searchroomid']; 
        if ($searchroomid=="")
        {
       echo "<div>";   
        echo "<p><input class='form-control' type='text' name='roomtype' class='text' placeholder='CategoryName'></p>";
        echo "<p><input class='form-control' type='text' name='rate' id='rate' class='text'   placeholder='Rate' readonly></p>";
        echo "</div>";   
       }
      else
      {
        $sql="select tblcategories.CategoryName, 
        tblrooms.Rate,tblrooms.Discount, tblrooms.Description, tblrooms.Status,tblrooms.No_adult,tblrooms.No_child,tblrooms.Date_Start,tblrooms.Date_End, tblrooms.Image 
        FROM tblrooms Inner JOIN tblcategories on tblrooms.Category_ID=tblcategories.Category_ID
        where tblrooms.Room_ID='".$searchroomid."'";  

       $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

          while($row=mysqli_fetch_array($result)){

            $rate=$row['Rate'];
            $total=$rate *$Numberofdays;

      if ($row['Status']=="Available")
      {
          echo "<div>";   
          echo "<p><input class='form-control' type='text' name='categoryname' id='roomtype' class='text' value=".$row['CategoryName']."></p>";
          echo "<p><input class='form-control' type='text' name='rate' id='amount' class='text'   value=".$row['Rate']." readonly></p>";
        echo "</div>";
      }
      else
      {
           echo "<div>";   
          echo "<p><input class='form-control' type='text' name='roomtype' class='text' placeholder='CategoryName'></p>";
          echo "<p><input class='form-control' type='text' name='rate' id='rate' class='text'  placeholder='Rate' readonly></p>";
          echo "</div>";   
      }
    }
  }
}
?>

