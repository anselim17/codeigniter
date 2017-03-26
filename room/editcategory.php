
<?php

include('../Class/categories.php');
include("../../connection.php");

$CAtegoryid=$_GET['categoryid'] ;
$CAtegoryname = $_GET['categoryname'];


if ($CAtegoryname==''){
  echo "<script>
        alert('Categoy Name is required');
        window.location='../room/manageroom.php'
        </script>";
}
else
{



$Category= new Category($CAtegoryid,$CAtegoryname);

      if ($Category->UpdateCategory())
            {
       echo "<script>
            alert('Category successfully Updated');
            window.location='../room/manageroom.php'
            </script>";
      }
      else
      {
      echo "<script>
            alert('An error has occured during the operation','Wesviewhotel');
            window.location='../room/manageroom.php'
            </script>";
      }
  
}
?>