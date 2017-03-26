

<?php

include('../Class/categories.php');
include("../../connection.php");

$CAtegoryid=$_POST['categoryid'] ;
$CAtegoryname=$_POST['categoryname'] ;
$sql = "select * from tblcategories where CategoryName='$CAtegoryname'";
$result = mysqli_query($conn,$sql);

if (empty($CAtegoryname)){
  echo 'Room Name is required';
}
else if(mysqli_num_rows($result)>0){
  echo 'Category name is already exist';
} else {
$Category= new Category($CAtegoryid,$CAtegoryname);

      if ($Category->AddCategory()) {
       echo "true";
      } else {
      	echo 'error';
      }
  
}
?>